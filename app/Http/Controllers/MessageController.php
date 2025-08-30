<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:conversations.create')->only(['store']);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'body' => 'required|string|max:65535',
            'conversation_id' => 'nullable|exists:conversations,id',
            'recipient_user_id' => 'nullable|exists:users,id',
        ]);

        $conversation = null;
        $isNewConversation = false;

        if ($request->filled('conversation_id')) {
            $conversation = Conversation::find($request->conversation_id);
            // Ensure current user is part of this conversation
            if (!$conversation || !$conversation->users->contains($user->id)) {
                return response()->json(['success' => false, 'message' => 'Conversation non trouvée ou accès non autorisé.'], 403);
            }
        } elseif ($request->filled('recipient_user_id')) {
            $recipient = User::find($request->recipient_user_id);
            if (!$recipient) {
                return response()->json(['success' => false, 'message' => 'Destinataire non trouvé.'], 404);
            }

            // Check if a conversation already exists between these two users
            $conversation = $user->conversations()
                                 ->whereHas('users', function ($query) use ($recipient) {
                                     $query->where('user_id', $recipient->id);
                                 })
                                 ->first();

            if (!$conversation) {
                // Create new conversation
                $conversation = Conversation::create([]); // No subject initially
                $conversation->users()->attach([$user->id, $recipient->id]);
                $isNewConversation = true;
            }
        } else {
            return response()->json(['success' => false, 'message' => 'ID de conversation ou destinataire manquant.'], 400);
        }

        // Create message
        $message = $conversation->messages()->create([
            'user_id' => $user->id,
            'body' => $request->body,
        ]);

        // Update conversation's updated_at timestamp
        $conversation->touch();

        // Mark conversation as unread for other participants
        $conversation->users()->where('user_id', '!=', $user->id)->update(['read_at' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Message envoyé.',
            'message_data' => $message, // Return message data for frontend display
            'conversation_id' => $conversation->id, // Return conversation ID
            'is_new_conversation' => $isNewConversation,
        ]);
    }
}