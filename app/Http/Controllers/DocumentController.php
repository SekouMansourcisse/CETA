<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Projet;
use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:documents.view')->only(['index', 'show', 'download']);
        $this->middleware('can:documents.create')->only(['create', 'store', 'store2', 'storeForActivity']);
        $this->middleware('can:documents.delete')->only(['destroy']);
    }

    public function index()
    {
        $documents = Document::with('projet')->latest()->where('type', 'cabinet')->paginate(10);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $projets = Projet::all();
        return view('documents.create', compact('projets'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'projet_id' => 'required|exists:projets,id',
            'type' => 'required|in:plan,devis,contrat,photo,rapport,autre',
            'fichier' => 'required|file|max:102400', // Max 10MB
        ]);

        $file = $request->file('fichier');
        $originalExtension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $originalExtension;
        $path = $file->storeAs('documents', $filename, 'public');

        Document::create([
            'nom' => $validatedData['nom'],
            'projet_id' => $validatedData['projet_id'],
            'type' => $validatedData['type'],
            'chemin_acces' => $path,
            'taille' => $this->formatBytes($file->getSize()),
            'uploade_par' => Auth::id(),
            'date_upload' => now(),
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploadé avec succès.');
    }

    public function storeForActivity(Request $request, Activite $activite)
    {
        Log::info('Début de l\'upload de document pour une activité.', ['activite_id' => $activite->id]);

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:plan,devis,contrat,photo,rapport,autre,cabinet',
            'fichier' => 'required|file|max:102400', // Max 100MB
        ]);

        Log::info('Validation des données storeForActivity réussie.', ['validatedData' => $validatedData]);

        $file = $request->file('fichier');
        $originalName = $file->getClientOriginalName();
        $originalExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        $filename = Str::random(40) . '.' . $originalExtension;
        $path = $file->storeAs('documents', $filename, 'public');

        Log::info('Fichier stocké avec succès storeForActivity.', ['path' => $path]);

        Document::create([
            'nom' => $validatedData['nom'],
            'projet_id' => $activite->projet_id, // Use the projet_id from the activity
            'activite_id' => $activite->id, // Set the activity ID
            'type' => $validatedData['type'],
            'chemin_acces' => $path,
            'taille' => $this->formatBytes($file->getSize()),
            'uploade_par' => Auth::id(),
            'date_upload' => now(),
        ]);

        Log::info('Document créé avec succès storeForActivity.', [
            'nom' => $validatedData['nom'],
            'type' => $validatedData['type'],
            'chemin_acces' => $path,
        ]);

        return redirect()->route('activites.show', $activite)->with('success', 'Document uploadé avec succès.');
    }
    


    public function store2(Request $request)
    {
        Log::info('Début de l\'upload de document pour store2.');

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:plan,devis,contrat,photo,rapport,autre,cabinet',
            'fichier' => 'required|file|max:102400', // Max 10MB
        ]);

        Log::info('Validation des données store2 réussie.', ['validatedData' => $validatedData]);

        $file = $request->file('fichier');
        $originalExtension = $file->getClientOriginalExtension();
        $filename = Str::random(40) . '.' . $originalExtension;
        $path = $file->storeAs('documents', $filename, 'public');

        Log::info('Fichier stocké avec succès store2.', ['path' => $path]);

        Document::create([
            'nom' => $validatedData['nom'],
            'projet_id' => null, // Set projet_id to null as requested
            'activite_id' => null, // Assuming activite_id should also be null
            'type' => 'cabinet', // Set type to 'cabinet' as requested
            'chemin_acces' => $path,
            'taille' => $this->formatBytes($file->getSize()),
            'uploade_par' => Auth::id(),
            'date_upload' => now(),
        ]);

        Log::info('Document créé avec succès store2.', [
            'nom' => $validatedData['nom'],
            'type' => 'cabinet',
            'chemin_acces' => $path,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document de cabinet uploadé avec succès.');
    }

    public function destroy(Request $request, Document $document)
    {
        Storage::disk('public')->delete($document->chemin_acces);
        $document->delete();

        $redirect_to = $request->input('_redirect_to');

        if ($redirect_to === 'activites.show') {
            $activite_id = $request->input('_activite_id');
            if ($activite_id) {
                return redirect()->route('activites.show', $activite_id)->with('success', 'Document supprimé avec succès.');
            }
        }

        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès.');
    }

    public function download(Document $document)
    {
        // Ensure the file exists before attempting to download
        if (!Storage::disk('public')->exists($document->chemin_acces)) {
            abort(404, 'Fichier non trouvé.');
        }

        // Get the original file extension from the stored path
        $extension = pathinfo($document->chemin_acces, PATHINFO_EXTENSION);
        // Construct a user-friendly filename
        $filename = Str::slug($document->nom) . '.' . $extension;

        return Storage::disk('public')->download($document->chemin_acces, $filename);
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}