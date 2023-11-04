<?php

namespace App\Enums;

enum TableTicketFieldPriorityEnum:string
{
    use EnumToArray;
    case NORMAL = "normal";
    case IMPORTANT = "important";


    public function title(): array|string|\Illuminate\Contracts\Translation\Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::NORMAL => __("general.normal"),
            self::IMPORTANT => __("general.important"),

        };
    }
}
