<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

enum TipoSensore: String
{
    case Temperatura = "Temperatura";
    case Umidita = "Umidita";
    case UV = "UV";
}

class Sensore extends Model
{
    protected $table = "Sensori";

    protected $fillable = ["TipoSensore", "PosizioneGPS"];

    public function getPosizione(): String {
        return $this->attributes["PosizioneGPS"];
    }

    public function getTipo(): TipoSensore {
        return TipoSensore::from($this->attributes["Tipo"]);
    }

    public function orto(): BelongsTo
    {
        return $this->belongsTo(Orto::class, "IdOrto", "IdSensore");
    }

    public function misurazioni(): HasMany
    {
        return $this->hasMany(Misurazione::class, "IdMisurazione", "IdSensore");
    }
}
