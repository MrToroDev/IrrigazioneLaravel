<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

enum RuoloUtente: String {
    case Admin = "Admin";
    case Utente = "Utente";
};

class Utente extends Model
{
    protected $table = "Utenti";

    protected $fillable = ["Nome", "Cognome", "Email", "Pword", "Ruolo"];

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
        return $this->hasMany(Orto::class, "IdOrto", "IdUtente");
    }
}
