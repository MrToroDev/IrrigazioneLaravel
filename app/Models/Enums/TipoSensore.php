<?php

namespace App\Models\Enums;

enum TipoSensore: String
{
    case Temperature = "Temperature";
    case Umidity = "Umidity";
    case UV = "UV";
    case Lux = "Lux";
}
