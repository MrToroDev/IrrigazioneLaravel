<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Enums\TipoSensore;

class Sensore extends Model
{
    protected $table = "Sensori";
    protected $primaryKey = 'IdSensore';

    protected $fillable = ["TipoSensore", "Latitudine", "Longitudine", "Nome", "deleted", "IdOrto"];

    public function getPosizione(): String {
        return $this->attributes["Latitudine"] . "," . $this->attributes["Longitudine"];
    }
    
    public function getLatitudine(): Float {
        return $this->attributes['Latitudine'];
    }

    public function getLongitudine(): Float {
        return $this->attributes['Longitudine'];
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
