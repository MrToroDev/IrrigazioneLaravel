<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sensore extends Model
{
    protected $table = "Sensori";

    protected $fillable = ["TipoSensore", "PosizioneGPS"];

    public function getNome(): String {
        return $this->attributes["Nome"];
    }

    public function getPosizione(): String {
        return $this->attributes["PosizioneGPS"];
    }

    public function getTipo(): TipoOrto {
        return TipoOrto::from($this->attributes["Tipo"]);
    }

    public function orto(): BelongsTo
    {
        return $this->belongsTo(Orto::class, "IdOrto", "IdSensore");
    }
}
