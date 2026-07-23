<?php

namespace App\Enums;

enum WebinarStatus: string
{
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
    case REGISTRATION_CLOSED = 'registration_closed';
    case LIVE = 'live';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::SCHEDULED => 'Scheduled',
            self::REGISTRATION_CLOSED => 'Registration Closed',
            self::LIVE => 'Live',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }
}
