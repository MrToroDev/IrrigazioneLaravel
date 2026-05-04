<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


enum RuoloUtente: String {
    case Admin = "Admin";
    case Utente = "User";
};

class Utente extends Authenticatable
{
    protected $table = "Utenti";
    protected $primaryKey = 'IdUtente';
    protected $authPasswordName = 'Pword';

    protected $fillable = ["Nome", "Cognome", "Email", "Pword", "Ruolo"];

    protected $hidden = ["Pword", "remember_token"];

    


    public function getNome(): String {
        return $this->attributes["Nome"];
    }

    public function getCognome(): String {
        return $this->attributes["Cognome"];
    }

    public function getEmail(): String {
        return $this->attributes["Email"];
    }

    public function getPassword(): String {
        return $this->attributes["Pword"];
    }

    public function getRuolo(): RuoloUtente {
        return RuoloUtente::from($this->attributes['Ruolo']);
    }

    public function orti(): HasMany
    {
        return $this->hasMany(Orto::class, "IdUtente");
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class, "IdUtente");
    }

    
}
