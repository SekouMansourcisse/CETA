<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Projet;
use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $depenses = Depense::with('projet')->latest()->paginate(10);
        return view('depenses.index', compact('depenses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'montant' => 'required|numeric|min:0',
            'description' => 'required|string',
            'date' => 'required|date',
            'categorie' => 'required|in:materiel,deplacement,formation,logiciel,autre',
        ]);

        $validatedData['saisi_par'] = Auth::id();

        Depense::create($validatedData);

        return redirect()->route('depenses.index')->with('success', 'Dépense ajoutée avec succès.');
    }

    public function storeForActivity(Request $request, Activite $activite)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric|min:0',
            'description' => 'required|string|max:65535',
            'date' => 'required|date',
            'categorie' => 'required|in:materiel,deplacement,formation,logiciel,autre',
        ]);

        $activite->depenses()->create([
            'projet_id' => $activite->projet_id,
            'montant' => $validatedData['montant'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'categorie' => $validatedData['categorie'],
            'saisi_par' => Auth::id(),
        ]);

        return redirect()->route('activites.show', $activite)->with('success', 'Dépense ajoutée avec succès.');
    }

    // Other methods like create, edit, update, destroy can be added here

    public function destroy(Request $request, Depense $depense)
    {
        $depense->delete();

        $redirect_to = $request->input('_redirect_to');

        if ($redirect_to === 'activites.show') {
            $activite_id = $request->input('_activite_id');
            if ($activite_id) {
                return redirect()->route('activites.show', $activite_id)->with('success', 'Dépense supprimée avec succès.');
            }
        }

        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès.');
    }
}