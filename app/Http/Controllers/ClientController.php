<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:clients.view')->only(['index', 'show']);
        $this->middleware('can:clients.create')->only(['create', 'store']);
        $this->middleware('can:clients.edit')->only(['edit', 'update']);
        $this->middleware('can:clients.delete')->only(['destroy']);
    }

    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:clients',
            'type_client' => 'required|in:particulier,entreprise,collectivite',
            'societe' => 'nullable|string|max:255',
        ];

        if ($request->type_client == 'particulier') {
            $rules['prenom'] = 'required|string|max:255';
        } else {
            $rules['prenom'] = 'nullable|string|max:255';
        }

        $validatedData = $request->validate($rules);

        if ($request->type_client != 'particulier') {
            $validatedData['prenom'] = null;
            $validatedData['societe'] = $validatedData['nom']; // Set societe from nom
        } else {
            $validatedData['societe'] = null; // Ensure societe is null for particuliers
        }

        Client::create($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:clients,email,' . $client->id,
            'type_client' => 'required|in:particulier,entreprise,collectivite',
            'societe' => 'nullable|string|max:255',
        ];

        if ($request->type_client == 'particulier') {
            $rules['prenom'] = 'required|string|max:255';
        } else {
            $rules['prenom'] = 'nullable|string|max:255';
        }

        $validatedData = $request->validate($rules);

        if ($request->type_client != 'particulier') {
            $validatedData['prenom'] = null;
            $validatedData['societe'] = $validatedData['nom']; // Set societe from nom
        } else {
            $validatedData['societe'] = null; // Ensure societe is null for particuliers
        }

        $client->update($validatedData);

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
