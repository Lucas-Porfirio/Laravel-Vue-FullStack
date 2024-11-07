<?php

namespace App\Enums;

enum PessoaTipoEnum: int
{
    case FISICA = 1;
    case JURIDICA = 2;

    public static function getValues(): array
    {
        return array_map(function ($enum) {
            return $enum->value;
        }, self::cases());
    }
}
