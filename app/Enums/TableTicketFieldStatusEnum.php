<?php

namespace App\Enums;

enum TableTicketFieldStatusEnum: string
{
    use EnumToArray;
    case OPEN = "open";
    case CLOSE = "close";


    public function title(): array|string|\Illuminate\Contracts\Translation\Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::OPEN => __("general.open"),
            self::CLOSE => __("general.close"),

        };
    }

}
