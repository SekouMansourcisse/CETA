<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'nom' => 'Durand',
            'prenom' => 'Jean',
            'adresse' => '123 rue de la Paix, 75001 Paris',
            'telephone' => '01.23.45.67.89',
            'email' => 'jean.durand@email.com',
            'type_client' => 'particulier',
        ]);

        Client::create([
            'nom' => 'Bernard',
            'prenom' => 'Claire',
            'adresse' => '456 avenue Victor Hugo, 69001 Lyon',
            'telephone' => '04.78.90.12.34',
            'email' => 'claire.bernard@email.com',
            'type_client' => 'particulier',
        ]);

        Client::create([
            'nom' => 'Innovtech',
            'prenom' => '',
            'adresse' => '789 boulevard Haussmann, 75008 Paris',
            'telephone' => '01.56.78.90.12',
            'email' => 'contact@innovtech.com',
            'type_client' => 'entreprise',
            'societe' => 'Innovtech Solutions',
        ]);
    }
}
