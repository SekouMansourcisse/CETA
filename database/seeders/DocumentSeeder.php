<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::create([
            'type' => 'plan',
            'nom' => 'Plan_masse_v2.dwg',
            'chemin_acces' => '/documents/plans/plan_masse_v2.dwg',
            'projet_id' => 1,
            'uploade_par' => 1,
            'date_upload' => '2024-02-10',
            'taille' => '2.4 MB',
        ]);

        Document::create([
            'type' => 'devis',
            'nom' => 'Devis_gros_oeuvre.pdf',
            'chemin_acces' => '/documents/devis/devis_gros_oeuvre.pdf',
            'projet_id' => 1,
            'uploade_par' => 1,
            'date_upload' => '2024-02-15',
            'taille' => '1.2 MB',
        ]);

        Document::create([
            'type' => 'photo',
            'nom' => 'Photo_chantier_01.jpg',
            'chemin_acces' => '/documents/photos/photo_chantier_01.jpg',
            'projet_id' => 2,
            'activite_id' => 4,
            'uploade_par' => 2,
            'date_upload' => '2024-03-10',
            'taille' => '3.8 MB',
        ]);
    }
}
