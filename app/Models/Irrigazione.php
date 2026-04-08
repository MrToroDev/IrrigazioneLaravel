<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Irrigazione extends Model
{
    protected $table = "Irrigazioni";

    protected $fillable = ["Durata", "LitriAcquaConsumata", "DataOraIrrigazione"];

    public function getDurata(): Int {
        return $this->attributes["Durata"];
    }
    
    public function getLitriConsumati(): Int {
        return $this->attributes["LitriAcquaConsumata"];
    }
    
    /* format: YYYY-MM-DD hh:mm:ss */
    public function getDataOra(): String {
        return $this->attributes["DataOraIrrigazione"];
    }

    public function orto(): BelongsTo
    {
        return $this->belongsTo(Orto::class, "IdOrto", "IdSensore");
    }
}
