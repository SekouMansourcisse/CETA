<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHistorique;

class Depense extends Model
{
    use HasFactory, HasHistorique;

    protected $fillable = [
        'projet_id',
        'activite_id',
        'montant',
        'description',
        'date',
        'categorie',
        'saisi_par',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function saisiPar()
    {
        return $this->belongsTo(User::class, 'saisi_par');
    }
}
