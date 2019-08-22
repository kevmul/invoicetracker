<?php

namespace App\Helper;

class USDFormatter {
    public static function handle($amount)
    {
        return '$'. number_format(($amount / 100), 2, '.', ',');
    }
}
