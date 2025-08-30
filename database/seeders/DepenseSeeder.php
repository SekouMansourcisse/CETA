<?php

namespace Database\Seeders;

use App\Models\Depense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Depense::create([
            'projet_id' => 1,
            'activite_id' => 1,
            'montant' => 450,
            'description' => 'Logiciel de modélisation 3D',
            'date' => '2024-01-20',
            'categorie' => 'logiciel',
            'saisi_par' => 1,
        ]);

        Depense::create([
            'projet_id' => 1,
            'montant' => 180,
            'description' => 'Déplacement site client',
            'date' => '2024-02-05',
            'categorie' => 'deplacement',
            'saisi_par' => 1,
        ]);

        Depense::create([
            'projet_id' => 2,
            'activite_id' => 3,
            'montant' => 320,
            'description' => 'Matériel de mesure',
            'date' => '2024-02-10',
            'categorie' => 'materiel',
            'saisi_par' => 2,
        ]);

        Depense::create([
            'projet_id' => 2,
            'montant' => 95,
            'description' => 'Formation réglementation',
            'date' => '2024-02-20',
            'categorie' => 'formation',
            'saisi_par' => 2,
        ]);
    }
}
