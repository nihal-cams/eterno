<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
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
            'status' => Status::class,
        ];
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
