<?php

namespace App\Enums;

enum TableTicketFieldDepartmentEnum:string
{
    use EnumToArray;
    case SUPPORT = "support";
    case CRM = "crm";


    public function title(): array|string|\Illuminate\Contracts\Translation\Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::SUPPORT => __("general.support"),
            self::CRM => __("general.crm"),

        };
    }
}
