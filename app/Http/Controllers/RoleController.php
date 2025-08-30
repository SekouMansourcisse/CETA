<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        // Protège toutes les méthodes du contrôleur avec la permission de voir les rôles
        // Des permissions plus granulaires peuvent être ajoutées par méthode si nécessaire
        $this->middleware('can:roles.view')->only('index');
        $this->middleware('can:roles.create')->only(['create', 'store']);
        $this->middleware('can:roles.edit')->only(['edit', 'update']);
        $this->middleware('can:roles.delete')->only('destroy');
    }

    /**
     * Affiche la liste des rôles.
     */
    public function index()
    {
        $roles = Role::all();
        return view('settings.roles.index', compact('roles'));
    }

    /**
     * Affiche le formulaire de création de rôle.
     */
    public function create()
    {
        // On groupe les permissions par module (ex: 'projets')
        $permissions = Permission::all()->groupBy(function($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('settings.roles.create', compact('permissions'));
    }

    /**
     * Enregistre un nouveau rôle.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'present|array', // s'assurer que la clé permissions existe
            'permissions.*' => 'integer|exists:permissions,id', // valider chaque id
        ]);

        $role = Role::create(['name' => $request->name]);
        
        // On récupère les permissions depuis la base de données avant de les synchroniser
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('settings.index')->with('success', 'Rôle "' . $role->name . '" créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition du rôle spécifié.
     */
    public function edit(Role $role)
    {
        $role->load('permissions'); // Charge les permissions associées au rôle

        $permissions = Permission::all()->groupBy(function($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('settings.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Met à jour le rôle spécifié dans la base de données.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id, // Ignorer le rôle actuel
            'permissions' => 'present|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]); // Si aucune permission n'est cochée, toutes sont retirées
        }

        return redirect()->route('settings.index')->with('success', 'Rôle "' . $role->name . '" mis à jour avec succès.');
    }

    /**
     * Supprime le rôle spécifié de la base de données.
     */
    public function destroy(Role $role)
    {
        $roleName = $role->name;
        $role->delete();

        return redirect()->route('settings.index')->with('success', 'Rôle "' . $roleName . '" supprimé avec succès.');
    }
}

