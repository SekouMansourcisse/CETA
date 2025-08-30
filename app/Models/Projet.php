<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHistorique;

class Projet extends Model
{
    use HasFactory, HasHistorique;

    protected $fillable = [
        'titre',
        'description',
        'etat',
        'client_id',
        'date_debut',
        'date_fin',
        'responsable_id',
        'budget_prevu',
        'budget_realise',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
