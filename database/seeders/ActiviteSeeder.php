<?php

namespace Database\Seeders;

use App\Models\Activite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActiviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activite::create([
            'projet_id' => 1,
            'type' => 'etude',
            'date_debut' => '2024-01-15',
            'date_fin' => '2024-03-01',
            'statut' => 'termine',
            'montant_prevu' => 8000,
            'montant_realise' => 8000,
            'responsable_id' => 1,
            'description' => 'Étude de faisabilité et esquisse',
        ]);

        Activite::create([
            'projet_id' => 1,
            'type' => 'autorisation',
            'date_debut' => '2024-03-01',
            'date_fin' => '2024-05-15',
            'statut' => 'en_cours',
            'montant_prevu' => 12000,
            'montant_realise' => 7500,
            'responsable_id' => 1,
            'description' => 'Dépôt permis de construire',
        ]);

        Activite::create([
            'projet_id' => 2,
            'type' => 'etude',
            'date_debut' => '2024-02-01',
            'date_fin' => '2024-03-15',
            'statut' => 'termine',
            'montant_prevu' => 6000,
            'montant_realise' => 6000,
            'responsable_id' => 2,
            'description' => 'Étude de rénovation',
        ]);

        Activite::create([
            'projet_id' => 2,
            'type' => 'realisation',
            'date_debut' => '2024-03-15',
            'date_fin' => '2024-08-15',
            'statut' => 'en_cours',
            'montant_prevu' => 22000,
            'montant_realise' => 9600,
            'responsable_id' => 2,
            'description' => 'Travaux de rénovation',
        ]);
    }
}
