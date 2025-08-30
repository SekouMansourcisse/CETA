<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Modules
        $modules = [
            'projets',
            'home',
            'clients',
            'activites',
            'depenses',
            'paiements',
            'documents',
            'users',
            'roles',
            'conversations',
            'notifications',
            'settings', // Nouvelle permission pour les paramètres
        ];

        // Define Actions
        $actions = [
            'view',
            'create',
            'edit',
            'delete',
        ];

        // Create permissions using updateOrCreate to avoid duplicates
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::updateOrCreate(['name' => $module . '.' . $action, 'guard_name' => 'web']);
            }
        }

        // Create Admin Role using updateOrCreate
        $adminRole = Role::updateOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Give all permissions to admin role
        $adminRole->givePermissionTo(Permission::all());

        // Create or update Admin User
        $adminUser = User::updateOrCreate(
            ['login' => 'admin'], // Find user by login
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'password' => Hash::make('password'), // Change this password!
                'actif' => true,
            ]
        );

        // Assign admin role to the admin user
        $adminUser->assignRole($adminRole);
    }
}
