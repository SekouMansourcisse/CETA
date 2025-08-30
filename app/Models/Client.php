<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHistorique;

class Client extends Model
{
    use HasFactory, HasHistorique;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'telephone',
        'email',
        'type_client',
        'societe',
    ];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
