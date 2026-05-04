<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Misurazione extends Model
{
    protected $table = "Misurazioni";
    protected $primaryKey = 'IdMisurazione';

    protected $fillable = ["Valore", "DataOraMisurazione"];

    public function getValore(): Float {
        return $this->attributes["Valore"];
    }

    public function getDataOra(): String {
        return $this->attributes["DataOraMisurazione"];
    }

    public function sensore(): BelongsTo
    {
        return $this->belongsTo(Orto::class, "IdSensore");
    }
}
