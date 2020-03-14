<?php

namespace App\Library;

class Format
{
    public static function formatCoin($value)
    {
        return "R$" . number_format($value, 2, ',', '.');
    }

    public static function extractNumbers($value)
    {
        return preg_replace('[\D]', '', $value);
    }
}
