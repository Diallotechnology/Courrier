<?php

namespace App\Enum;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case SUPERUSER = 'superuser';
    case SECRETAIRE = 'secretaire';
    case AGENT = 'agent';

}
