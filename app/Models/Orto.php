<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

enum TipoOrto: String {
    case Garden = "Garden";
    case Greenhouse = "Greenhouse";
}

class Orto extends Model
{
    protected $table = "Orti";
    protected $primaryKey = 'IdOrto';

    protected $fillable = ["Nome", "PosizioneGPS", "Tipo"];

    public function getNome(): String {
        return $this->attributes["Nome"];
    }

    public function getPosizione(): String {
        return $this->attributes["PosizioneGPS"];
    }

    public function getTipo(): TipoOrto {
        return TipoOrto::from($this->attributes["Tipo"]);
    }

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class, "IdUtente");
    }

    public function sensori(): HasMany
    {
        return $this->hasMany(Sensore::class, "IdOrto");
    }

    public function irrigazioni(): HasMany
    {
        return $this->hasMany(Irrigazione::class, "IdOrto");
    }
}
