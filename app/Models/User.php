<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasHistorique;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasHistorique, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'login',
        'actif',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'actif' => 'boolean',
        ];
    }

    // Relationships
    public function projets()
    {
        return $this->hasMany(Projet::class, 'responsable_id');
    }

    public function activites()
    {
        return $this->hasMany(Activite::class, 'responsable_id');
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class, 'saisi_par');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'uploade_par');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'utilisateur_id');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class)->withPivot('read_at')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }
}