<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TestimonialStatus;

class Testimonial extends Model
{
    protected $fillable = [
        'resort_id',
        'customer_name',
        'customer_place',
        'customer_image',
        'title',
        'content',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => TestimonialStatus::class,
        ];
    }

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }
}
