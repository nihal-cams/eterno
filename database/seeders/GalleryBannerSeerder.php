<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryBannerSeerder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::updateOrCreate(
            ['id' => 2],
            [
                'type' => 3,
                'title' => 'Every Picture Tells a Story',
                'description' => 'Explore breathtaking moments from our resorts through carefully curated imagery',
                'image'  => 'gallery-banner.jpg',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
