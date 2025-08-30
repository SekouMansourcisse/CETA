<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHistorique;

class Paiement extends Model
{
    use HasFactory, HasHistorique;

    protected $fillable = [
        'client_id',
        'projet_id',
        'activite_id',
        'montant',
        'date',
        'moyen_paiement',
        'reference_paiement',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}
