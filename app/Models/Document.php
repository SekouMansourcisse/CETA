<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHistorique;

class Document extends Model
{
    use HasFactory, HasHistorique;

    protected $fillable = [
        'type',
        'nom',
        'chemin_acces',
        'projet_id',
        'activite_id',
        'uploade_par',
        'date_upload',
        'taille',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function uploadePar()
    {
        return $this->belongsTo(User::class, 'uploade_par');
    }
}
