<?php

namespace Database\Seeders;

use App\Models\Projet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Projet::create([
            'titre' => 'Maison individuelle - Famille Durand',
            'description' => 'Construction d\'une maison contemporaine de 150m²',
            'etat' => 'en_cours',
            'client_id' => 1,
            'date_debut' => '2024-01-15',
            'date_fin' => '2024-12-30',
            'responsable_id' => 1,
            'budget_prevu' => 45000,
            'budget_realise' => 23500,
        ]);

        Projet::create([
            'titre' => 'Rénovation appartement - Mme Bernard',
            'description' => 'Rénovation complète d\'un appartement de 80m²',
            'etat' => 'en_cours',
            'client_id' => 2,
            'date_debut' => '2024-02-01',
            'date_fin' => '2024-08-15',
            'responsable_id' => 2,
            'budget_prevu' => 28000,
            'budget_realise' => 15600,
        ]);

        Projet::create([
            'titre' => 'Bureaux Innovtech',
            'description' => 'Aménagement d\'espaces de bureaux modernes',
            'etat' => 'planifie',
            'client_id' => 3,
            'date_debut' => '2024-04-01',
            'date_fin' => '2025-02-28',
            'responsable_id' => 1,
            'budget_prevu' => 85000,
            'budget_realise' => 0,
        ]);
    }
}
