<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

enum TipoSensore: String
{
    case Temperature = "Temperature";
    case Umidity = "Umidity";
    case UV = "UV";
    case Lux = "Lux";
}

class Sensore extends Model
{
    protected $table = "Sensori";
    protected $primaryKey = 'IdSensore';

    protected $fillable = ["TipoSensore", "PosizioneGPS", "Nome"];

    public function getPosizione(): String {
        return $this->attributes["PosizioneGPS"];
    }

    public function getTipo(): TipoSensore {
        return TipoSensore::from($this->attributes["TipoSensore"]);
    }

    public function getNome(): String {
        return $this->attributes['Nome'];
    }

    public function orto(): BelongsTo
    {
        return $this->belongsTo(Orto::class, "IdOrto");
    }

    public function misurazioni(): HasMany
    {
        return $this->hasMany(Misurazione::class, "IdSensore");
    }
}
