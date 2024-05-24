<?php

namespace App\Enums;

enum LoggedStatus: string
{
    case LOGIN = 'logged_in';
    case LOGOUT = 'logged_out';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
