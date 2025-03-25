<?php

namespace App\Enums;

enum CustomerStatus : int
{
    case CALL = 0;
    case VISIT = 1;
    case FOLLOW_UP = 2;

    public function label(): string
    {
        return match($this) {
            self::CALL => 'Call',
            self::VISIT => 'Visit',
            self::FOLLOW_UP => 'Follow Up',
        };
    }
}
