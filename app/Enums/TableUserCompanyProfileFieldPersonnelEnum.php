<?php

namespace App\Enums;

enum TableUserCompanyProfileFieldPersonnelEnum: string
{
    use EnumToArray;

    case SMALL = "small";
    case MEDIUM = "medium";
    case LARGE = "large";
    case NULL = 'null';

    public function title(): string
    {
        return match ($this) {
            self::SMALL  => __("general.small"),
            self::MEDIUM => __("general.medium"),
            self::LARGE  => __("general.large"),
            self::NULL  => __("general.null"),
        };
    }
}
