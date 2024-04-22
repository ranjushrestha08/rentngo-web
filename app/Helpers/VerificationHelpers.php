<?php

namespace App\Helpers;

class VerificationHelpers
{
    public static function generateVerificationCode()
    {
        return 12345;
        return rand(10000, 99999);
    }
}
