<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Client;
use App\Models\Projet;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:paiements.view')->only(['index', 'show']);
        $this->middleware('can:paiements.create')->only(['create', 'store']);
        $this->middleware('can:paiements.edit')->only(['edit', 'update']);
        $this->middleware('can:paiements.delete')->only(['destroy']);
    }

    public function index()
    {
        $paiements = Paiement::with('client', 'projet')->latest()->paginate(15);
        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        $clients = Client::all();
        $projets = Projet::all();
        return view('paiements.create', compact('clients', 'projets'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'projet_id' => 'required|exists:projets,id',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'moyen_paiement' => 'required|in:virement,cheque,especes,carte,autre',
            'reference_paiement' => 'nullable|string|max:255',
        ]);

        Paiement::create($validatedData);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function edit(Paiement $paiement)
    {
        $clients = Client::all();
        $projets = Projet::all();
        return view('paiements.edit', compact('paiement', 'clients', 'projets'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'projet_id' => 'required|exists:projets,id',
            'montant' => 'required|numeric|min:0',
            'date' => 'required|date',
            'moyen_paiement' => 'required|in:virement,cheque,especes,carte,autre',
            'reference_paiement' => 'nullable|string|max:255',
        ]);

        $paiement->update($validatedData);

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
