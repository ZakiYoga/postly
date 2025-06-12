<?php

namespace App\Helpers;

class ColorHelper
{
    public static function hexToRgba(string $hex, float $alpha = 1.0): string
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) === 3) {
            $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
        } elseif (strlen($hex) === 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        } else {
            // fallback jika hex tidak valid
            return 'rgba(0,0,0,' . $alpha . ')';
        }

        return "rgba($r, $g, $b, $alpha)";
    }
}
