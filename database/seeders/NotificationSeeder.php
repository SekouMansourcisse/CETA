<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'utilisateur_id' => 1,
            'message' => 'Nouveau document uploadé pour le projet Maison Durand',
            'type' => 'info',
            'lu' => false,
            'date_envoi' => '2024-02-15 14:30:00',
        ]);

        Notification::create([
            'utilisateur_id' => 1,
            'message' => 'Échéance permis de construire dans 7 jours',
            'type' => 'warning',
            'lu' => false,
            'date_envoi' => '2024-02-14 09:00:00',
        ]);

        Notification::create([
            'utilisateur_id' => 2,
            'message' => 'Paiement reçu pour le projet Rénovation Bernard',
            'type' => 'success',
            'lu' => true,
            'date_envoi' => '2024-03-20 16:45:00',
        ]);
    }
}
