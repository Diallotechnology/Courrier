<?php
declare(strict_types=1);
namespace App\Enum;

enum CourrierInterneEnum: string
{
    case SEND = 'Envoyé';
    case RECU = 'Reçu';
    case READ = 'lu';
}
