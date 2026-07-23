<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\WebinarStatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webinar extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'title',
        'platform',
        'date',
        'time',
        'duration',
        'capacity',
        'meeting_link',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'time' => 'datetime:H:i',
            'date' => 'date',
            'status' => WebinarStatus::class,
        ];
    }

}
