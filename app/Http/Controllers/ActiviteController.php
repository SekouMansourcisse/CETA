<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Activite::with('projet', 'responsable');

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->input('type'));
        }

        $activites = $query->latest()->paginate(10);
        $types = ['etude', 'expertise', 'realisation', 'autorisation'];

        return view('activites.index', compact('activites', 'types'));
    }

    public function show(Activite $activite)
    {
        $activite->load('documents.uploadePar', 'depenses.saisiPar'); // Eager load documents and expenses
        $totalDepenses = $activite->depenses->sum('montant');

        return view('activites.show', compact('activite', 'totalDepenses'));
    }

    public function create()
    {
        $projets = Projet::all();
        $responsables = User::all();
        return view('activites.create', compact('projets', 'responsables'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'type' => 'required|in:etude,expertise,realisation,autorisation',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:planifie,en_cours,termine,retard',
            'montant_prevu' => 'required|numeric|min:0',
            'description' => 'required|string',
            'responsable_id' => 'required|exists:users,id',
        ]);
        $validatedData['montant_realise'] = 0;

        $activite = Activite::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Activité créée avec succès.',
            'activite' => $activite
        ]);
    }

    public function edit(Activite $activite)
    {
        $projets = Projet::all();
        $responsables = User::where('role', 'architecte')->get();
        return view('activites.edit', compact('activite', 'projets', 'responsables'));
    }

    public function update(Request $request, Activite $activite)
    {
        $validatedData = $request->validate([
            'projet_id' => 'required|exists:projets,id',
            'type' => 'required|in:etude,expertise,realisation,autorisation',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:planifie,en_cours,termine,retard',
            'montant_prevu' => 'required|numeric|min:0',
            'montant_realise' => 'required|numeric|min:0',
            'description' => 'required|string',
            'responsable_id' => 'required|exists:users,id',
        ]);

        $activite->update($validatedData);
        $redirectRoute = $this->getRedirectRouteForType($activite->type);

        return redirect()->route($redirectRoute)->with('success', 'Activité mise à jour avec succès.');
    }

    public function destroy(Activite $activite)
    {
        $type = $activite->type; // Get type before deleting
        $activite->delete();
        $redirectRoute = $this->getRedirectRouteForType($type);

        return redirect()->route($redirectRoute)->with('success', 'Activité supprimée avec succès.');
    }

    public function getRedirectRouteForType(string $type): string
    {
        $routeMap = [
            'realisation' => 'realisations.index',
            'etude' => 'etudes.index',
            'expertise' => 'expertises.index',
            'autorisation' => 'autorisations.index',
        ];

        return $routeMap[$type] ?? 'activites.index';
    }

    public function indexRealisations()
    {
        $realisations = Activite::where('type', 'realisation')->with('projet', 'responsable')->latest()->get();
        $projets = Projet::all();
        $responsables = User::where('role', 'architecte')->get();
        return view('realisations.index', compact('realisations', 'projets', 'responsables'));
    }

    public function indexEtudes()
    {
        $etudes = Activite::where('type', 'etude')->with('projet', 'responsable')->latest()->get();
        $projets = Projet::all();
        $responsables = User::where('role', 'architecte')->get();
        return view('etudes.index', compact('etudes', 'projets', 'responsables'));
    }

    public function indexExpertises()
    {
        $expertises = Activite::where('type', 'expertise')->with('projet', 'responsable')->latest()->get();
        $projets = Projet::all();
        $responsables = User::where('role', 'architecte')->get();
        return view('expertises.index', compact('expertises', 'projets', 'responsables'));
    }

    public function indexAutorisations()
    {
        $autorisations = Activite::where('type', 'autorisation')->with('projet', 'responsable')->latest()->get();
        $projets = Projet::all();
        $responsables = User::where('role', 'architecte')->get();
        return view('autorisations.index', compact('autorisations', 'projets', 'responsables'));
    }
}