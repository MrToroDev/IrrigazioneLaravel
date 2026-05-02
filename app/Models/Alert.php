<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

enum TipoAlert: String
{
    case INFO = "INFO";
    case WARNING = "WARNING";
    case ERROR = "ERROR";
}

class Alert extends Model
{
    protected $table = "Alert";
    protected $primaryKey = 'IdAlert';

    protected $fillable = ["Tipo", "Descrizione", "DataOraAlert"];

    public function getTipo(): TipoAlert {
        return TipoAlert::from($this->attributes["Tipo"]);
    }
    
    public function getDescrizione(): Int {
        return $this->attributes["Descrizione"];
    }
    
    /* format: YYYY-MM-DD hh:mm:ss */
    public function getDataOra(): String {
        return $this->attributes["DataOraAlert"];
    }

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class, "IdUtente", "IdAlert");
    }
}
