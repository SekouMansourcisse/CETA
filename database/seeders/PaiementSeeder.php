<?php

namespace Database\Seeders;

use App\Models\Paiement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paiement::create([
            'client_id' => 1,
            'projet_id' => 1,
            'activite_id' => 1,
            'montant' => 8000,
            'date' => '2024-03-05',
            'moyen_paiement' => 'virement',
            'reference_paiement' => 'VIR-2024-001',
        ]);

        Paiement::create([
            'client_id' => 2,
            'projet_id' => 2,
            'activite_id' => 3,
            'montant' => 6000,
            'date' => '2024-03-20',
            'moyen_paiement' => 'cheque',
            'reference_paiement' => 'CHQ-2024-002',
        ]);
    }
}
