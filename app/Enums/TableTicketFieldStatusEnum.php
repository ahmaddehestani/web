<?php

namespace App\Enums;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

enum TableTicketFieldStatusEnum: string
{
    use EnumToArray;
    case OPEN = "open";
    case CLOSE = "close";


    public function title(): string
    {
        return match ($this) {
            self::OPEN => __("general.open"),
            self::CLOSE => __("general.close"),
        };
    }

}
