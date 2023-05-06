<?php

namespace App\Enum;

enum CourrierEnum: string
{
    case SAVE = 'Enregistré';
    case IMPUTE = 'Imputé';
    case SEND = 'Envoyé';
    case VALID = 'Validé';
    case PROCESS = 'En traitement';
    case TERMINE = 'Terminé';
    case ARCHIVE = 'Archivé';
}
