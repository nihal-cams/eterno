<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ResortStatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resort extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'location',
        'title',
        'description',
        'image',
        'button_text',
        'button_url',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => ResortStatus::class,
        ];
    }
}
