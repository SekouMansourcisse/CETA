<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHistorique;

class Activite extends Model
{
    use HasFactory, HasHistorique;

    protected $fillable = [
        'projet_id',
        'type',
        'date_debut',
        'date_fin',
        'statut',
        'montant_prevu',
        'montant_realise',
        'responsable_id',
        'description',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }
}