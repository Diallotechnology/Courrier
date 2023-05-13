<?php

namespace App\Enum;

enum CourrierInterneEnum: string
{
    case SEND = 'Envoyé';
    case RECU = 'Reçu';
    case READ = 'lu';
}
