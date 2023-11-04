<?php

namespace App\Services\Sms;

use Str;

class Sms
{
    /**
     * process text sms
     *
     * @param string $text
     *
     * @return array
     */
    public static function processText(string $text): array
    {
        $page = null;
        $type = null;
        $text_length = Str::length($text);

        $regex = '/[آابپتسجچهابپتثجچحخدذرزژسشصضطظعغفقکگلمینوهءآاًهٔة۰۱۲۳۴۵۶۷۸۹]/';
        preg_match_all($regex, $text, $matches_persian, PREG_SET_ORDER, 0);
        if (!empty($matches_persian)) {
            $type = 'farsi';
            if ($text_length <= 70) {
                $page = 1;
            }

            if ($text_length > 70 && $text_length <= 134) {
                $page = 2;
            }

            if ($text_length > 134 && $text_length <= 201) {
                $page = 3;
            }

            if ($text_length > 201) {
                $page = round(($text_length - 201) / 67) + 4;
            }
        }

        if (!$page) {
            $type = 'latin';
            if ($text_length <= 160) {
                $page = 1;
            }

            if ($text_length > 160 && $text_length <= 306) {
                $page = 2;
            }

            if ($text_length > 306 && $text_length <= 459) {
                $page = 3;
            }

            if ($text_length > 459) {
                $page = round(($text_length - 459) / 153) + 4;
            }
        }

        return [
            'type' => $type,
            'page' => $page,
        ];
    }
}
