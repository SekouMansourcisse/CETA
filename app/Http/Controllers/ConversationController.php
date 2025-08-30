<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:conversations.view')->only(['index', 'show', 'getMessages', 'findOrCreateConversation']);
        $this->middleware('can:conversations.create')->only(['create', 'store', 'startConversation']);
        // No edit/update/destroy methods in this controller, so no need to protect them here
    }

    public function index()
    {
        $user = Auth::user();
        $conversations = $user->conversations()
                              ->with(['users', 'messages' => function($query) {
                                  $query->latest()->take(1); // Get only the latest message
                              }])
                              ->latest('updated_at') // Order by latest message/update
                              ->get();
        $allUsers = User::where('id', '!=', $user->id)->get(); // Get all users except current

        return view('conversations.index', compact('conversations', 'allUsers'));
    }

    public function show(Conversation $conversation)
    {
        // Ensure the authenticated user is a participant of this conversation
        if (!$conversation->users->contains(Auth::id())) {
            abort(403, 'Unauthorized action.');
        }

        $conversation->load('messages.sender', 'users'); // Load messages and their senders, and all participants

        // Mark conversation as read for the current user
        $conversation->users()->updateExistingPivot(Auth::id(), ['read_at' => now()]);

        return view('conversations.show', compact('conversation'));
    }

    public function getMessages(Conversation $conversation)
    {
        // Ensure the authenticated user is a participant of this conversation
        if (!$conversation->users->contains(Auth::id())) {
            abort(403, 'Unauthorized action.');
        }

        $messages = $conversation->messages()->with('sender')->latest()->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'conversation' => $conversation, // Return conversation details too
        ]);
    }

    public function findOrCreateConversation(User $user)
    {
        $authUser = Auth::user();

        // Check if a conversation already exists between these two users
        $conversation = $authUser->conversations()
                                 ->whereHas('users', function ($query) use ($user) {
                                     $query->where('user_id', $user->id);
                                 })
                                 ->first();

        if (!$conversation) {
            // If no conversation exists, create a new one
            $conversation = Conversation::create([]); // No subject initially
            // Attach both users to the new conversation
            $conversation->users()->attach([$authUser->id, $user->id]);
            // Mark conversation as read for the current user
            $conversation->users()->updateExistingPivot($authUser->id, ['read_at' => now()]);
        }

        // Return conversation details as JSON
        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->id,
            'conversation_subject' => $conversation->subject,
            'participants' => $conversation->users->map(function($u) {
                return ['id' => $u->id, 'prenom' => $u->prenom, 'nom' => $u->nom];
            }),
        ]);
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Get all users except the current one
        return view('conversations.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Case 1: Reply to an existing conversation
        if ($request->has('conversation_id')) {
            $request->validate([
                'conversation_id' => ['required', 'exists:conversations,id', Rule::exists('conversation_user')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })], // Ensure user is part of this conversation
                'body' => 'required|string|max:65535',
            ]);

            $conversation = Conversation::findOrFail($request->conversation_id);

            // Create message
            $message = $conversation->messages()->create([
                'user_id' => $user->id,
                'body' => $request->body,
            ]);

            // Update conversation's updated_at timestamp
            $conversation->touch();

            // Mark conversation as unread for other participants
            $conversation->users()->where('user_id', '!=', $user->id)->update(['read_at' => null]);

            return redirect()->route('conversations.show', $conversation)->with('success', 'Message envoyé.');

        } else { // Case 2: Start a new conversation
            $request->validate([
                'recipient_ids' => 'required|array',
                'recipient_ids.*' => ['required', 'exists:users,id', Rule::notIn([Auth::id()])], // Ensure recipients exist and are not current user
                'subject' => 'nullable|string|max:255',
                'body' => 'required|string|max:65535',
            ]);

            // Create new conversation
            $conversation = Conversation::create([
                'subject' => $request->subject,
            ]);

            // Attach participants (current user + recipients) - also mark current user's as read
            $participants = array_merge($request->recipient_ids, [Auth::id()]);
            $conversation->users()->attach($participants);

            // Create first message
            $message = $conversation->messages()->create([
                'user_id' => $user->id,
                'body' => $request->body,
            ]);

            // Mark conversation as read for the current user
            $conversation->users()->updateExistingPivot(Auth::id(), ['read_at' => now()]);

            return redirect()->route('conversations.show', $conversation)->with('success', 'Conversation démarrée.');
        }
    }

    public function startConversation(User $user)
    {
        $authUser = Auth::user();

        // Check if a conversation already exists between these two users
        $conversation = $authUser->conversations()
                                 ->whereHas('users', function ($query) use ($user) {
                                     $query->where('user_id', $user->id);
                                 })
                                 ->first();

        if ($conversation) {
            // If conversation exists, redirect to it
            return redirect()->route('conversations.show', $conversation);
        }

        // If no conversation exists, create a new one
        $conversation = Conversation::create([
            // No subject initially, it can be added with the first message
        ]);

        // Attach both users to the new conversation
        $conversation->users()->attach([$authUser->id, $user->id]);

        // Mark conversation as read for the current user
        $conversation->users()->updateExistingPivot($authUser->id, ['read_at' => now()]);

        // Redirect to the new conversation
        return redirect()->route('conversations.show', $conversation);
    }
}