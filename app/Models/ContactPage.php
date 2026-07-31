<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPage extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'banner_title',
        'banner_description',
        'banner_image',
        'section_subtitle',
        'section_title',
        'section_description',
        'form_title',
        'form_description',
        'form_image',
        'phone',
        'email',
        'address',
        'map_iframe',
    ];
}
