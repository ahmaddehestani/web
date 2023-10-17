<?php

namespace App\Enums;

enum LoginTypeEnum :string
{
    use EnumToArray;

    case MOBILE = "mobile";
    case EMAIL = "email";
}
