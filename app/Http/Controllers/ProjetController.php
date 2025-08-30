<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:projets.view')->only(['index', 'show']);
        $this->middleware('can:projets.create')->only(['create', 'store']);
        $this->middleware('can:projets.edit')->only(['edit', 'update']);
        $this->middleware('can:projets.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $query = Projet::with('client', 'responsable');

        // Filtre par année
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('etat', $request->status);
        }

        // Filtre par client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Filtre par responsable
        if ($request->filled('responsable_id')) {
            $query->where('responsable_id', $request->responsable_id);
        }

        // Filtre par budget minimum
        if ($request->filled('budget_min')) {
            $query->where('budget_prevu', '>=', $request->budget_min);
        }

        // Filtre par budget maximum
        if ($request->filled('budget_max')) {
            $query->where('budget_prevu', '<=', $request->budget_max);
        }

        // Filtre par date de début
        if ($request->filled('date_debut')) {
            $query->where('date_debut', '>=', $request->date_debut);
        }

        // Filtre par date de fin
        if ($request->filled('date_fin')) {
            $query->where('date_fin', '<=', $request->date_fin);
        }

        // Filtre par priorité (si le champ existe)
        if ($request->filled('priorite') && $this->hasColumn('projets', 'priorite')) {
            $query->where('priorite', $request->priorite);
        }

        // Filtre par type de projet (si le champ existe)
        if ($request->filled('type') && $this->hasColumn('projets', 'type')) {
            $query->where('type', $request->type);
        }

        // Recherche globale (si fournie)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('titre', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('id', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('client', function ($clientQuery) use ($searchTerm) {
                      $clientQuery->where('nom', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('prenom', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('societe', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('responsable', function ($respQuery) use ($searchTerm) {
                      $respQuery->where('nom', 'like', '%' . $searchTerm . '%')
                               ->orWhere('prenom', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        $projets = $query->latest()->paginate(15);

        // Récupérer les listes pour les filtres
        $clients = Client::orderBy('societe')->get();
        $responsables = User::orderBy('prenom')->get();

        // Statistiques des projets
        $stats = [
            'total' => Projet::count(),
            'en_attente' => Projet::where('etat', 'en_attente')->count(),
            'en_cours' => Projet::where('etat', 'en_cours')->count(),
            'termine' => Projet::where('etat', 'termine')->count(),
            'suspendu' => Projet::where('etat', 'suspendu')->count(),
            'planifie' => Projet::where('etat', 'planifie')->count(),
        ];

        return view('projets.index', compact('projets', 'clients', 'responsables', 'stats'));
    }

    public function create()
    {
        $clients = Client::all();
        $responsables = User::all();
        return view('projets.create', compact('clients', 'responsables'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'etat' => 'required|in:en_attente,en_cours,termine,suspendu,planifie',
            'client_id' => 'required|exists:clients,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'responsable_id' => 'required|exists:users,id',
            'budget_prevu' => 'required|numeric|min:0',
        ]);
        $validatedData['budget_realise'] = 0; // Default value

        Projet::create($validatedData);

        return redirect()->route('projets.index')->with('success', 'Projet créé avec succès.');
    }

    public function show(Projet $projet)
    {
        $projet->load(['client', 'responsable', 'activites.documents']);

        $activitesByType = $projet->activites->groupBy('type');

        return view('projets.show', compact('projet', 'activitesByType'));
    }

    public function edit(Projet $projet)
    {
        $clients = Client::all();
        $responsables = User::where('role', 'architecte')->get();
        return view('projets.edit', compact('projet', 'clients', 'responsables'));
    }

    public function update(Request $request, Projet $projet)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'etat' => 'required|in:en_attente,en_cours,termine,suspendu,planifie',
            'client_id' => 'required|exists:clients,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'responsable_id' => 'required|exists:users,id',
            'budget_prevu' => 'required|numeric|min:0',
            'budget_realise' => 'required|numeric|min:0',
        ]);

        $projet->update($validatedData);

        return redirect()->route('projets.index')->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Projet $projet)
    {
        $projet->delete();
        return redirect()->route('projets.index')->with('success', 'Projet supprimé avec succès.');
    }

    /**
     * Vérifie si une colonne existe dans une table
     */
    private function hasColumn($table, $column)
    {
        return \Schema::hasColumn($table, $column);
    }
}
