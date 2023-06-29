<?php

namespace App\Enum;

enum ImputationEnum: string
{
    case EN_ATTENTE = 'En attente';
    case EN_COURS = 'En cours';
    case EXPIRE = 'Expiré';
    case TERMINE = 'Traitée';
}
