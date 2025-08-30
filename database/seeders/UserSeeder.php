<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom' => 'Dubois',
            'prenom' => 'Marie',
            'email' => 'mdubois@archi.test',
            'role' => 'architecte',
            'login' => 'mdubois',
            'password' => Hash::make('password'),
            'actif' => true,
        ]);

        User::create([
            'nom' => 'Martin',
            'prenom' => 'Pierre',
            'email' => 'pmartin@archi.test',
            'role' => 'architecte',
            'login' => 'pmartin',
            'password' => Hash::make('password'),
            'actif' => true,
        ]);

        User::create([
            'nom' => 'Lemaire',
            'prenom' => 'Sophie',
            'email' => 'slemaire@archi.test',
            'role' => 'assistant',
            'login' => 'slemaire',
            'password' => Hash::make('password'),
            'actif' => true,
        ]);

        User::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@archi.test',
            'role' => 'admin',
            'login' => 'admin',
            'password' => Hash::make('password'),
            'actif' => true,
        ]);
    }
}
