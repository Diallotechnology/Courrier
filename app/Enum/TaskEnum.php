<?php

namespace App\Enum;

enum TaskEnum: string
{
    case EN_ATTENTE = 'En attente';
    case EN_COURS = 'En cours';
    case TERMINE = 'Terminé';
    case NON_TERMINE = 'Non terminé';
}
