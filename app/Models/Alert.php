<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

enum TipoAlert: String
{
    case INFO = "INFO";
    case WARNING = "WARNING";
    case DANGER = "DANGER";
}

class Alert extends Model
{
    protected $table = "Alert";
    protected $primaryKey = 'IdAlert';
    public $timestamps = false;

    protected $fillable = ["Tipo", "Descrizione", "DataOraAlert", "Visualizzato", "Deleted"];

    public function getTipo(): TipoAlert {
        return TipoAlert::from($this->attributes["Tipo"]);
    }
    
    public function getDescrizione(): String {
        return $this->attributes["Descrizione"];
    }
    
    /* format: YYYY-MM-DD hh:mm:ss */
    public function getDataOra(): String {
        return $this->attributes["DataOraAlert"];
    }

    /* format: YYYY-MM-DD hh:mm:ss */
    public function getDataVisualizzazione(): String {
        if (!isset($this->attributes["Visualizzato"])) return "new";
        
        return $this->attributes["Visualizzato"];
    }

    public function isDeleted(): bool {
        return $this->attributes['Deleted'] == 1;
    }

    public function utente(): BelongsTo
    {
        return $this->belongsTo(Utente::class, "IdUtente");
    }
}
