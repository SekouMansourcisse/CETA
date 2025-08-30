<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users.view')->only(['index', 'show']);
        $this->middleware('can:users.create')->only(['create', 'store']);
        $this->middleware('can:users.edit')->only(['edit', 'update']);
        $this->middleware('can:users.delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Début de la création d\'utilisateur.', ['login' => $request->login]);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_name' => 'required|string|exists:roles,name', // Validation pour le nom du rôle
        ]);

        Log::info('Validation de l\'utilisateur réussie.', ['login' => $request->login]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'actif' => true, // Default to active
        ]);

        Log::info('Utilisateur créé avec succès.', ['user_id' => $user->id, 'login' => $user->login]);

        $user->assignRole($request->role_name); // Assigner le rôle via Spatie

        Log::info('Rôle assigné à l\'utilisateur.', ['user_id' => $user->id, 'role' => $request->role_name]);

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles'); // Charger les rôles de l'utilisateur
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login,' . $user->id,
            'role_name' => 'required|string|exists:roles,name',
            'password' => 'nullable|string|min:8|confirmed',
            'actif' => 'boolean',
        ]);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->actif = $request->has('actif');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles([$request->role_name]); // Synchroniser le rôle via Spatie

        return redirect()->route('settings.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        $redirect_to = $request->input('_redirect_to');

        if ($redirect_to === 'settings.index') {
            return redirect()->route('settings.index')->with('success', 'Utilisateur supprimé avec succès.');
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
