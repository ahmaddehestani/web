<?php

namespace App\Enums;

enum RoleEnum: string
{
    use EnumToArray;
    case ADMIN = "admin";
    case USER = "user";
}
