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

        // Apply filters
        if ($request->filled('year')) {
            $query->whereYear('date_debut', $request->year);
        }

        if ($request->filled('client_name')) {
            $clientName = $request->client_name;
            $query->whereHas('client', function ($q) use ($clientName) {
                $q->where('nom', 'like', '%' . $clientName . '%')
                  ->orWhere('prenom', 'like', '%' . $clientName . '%')
                  ->orWhere('societe', 'like', '%' . $clientName . '%');
            });
        }

        $projets = $query->latest()->paginate(10);

        // Pass filter values back to the view
        $filters = $request->only('year', 'client_name');

        return view('projets.index', compact('projets', 'filters'));
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
}
