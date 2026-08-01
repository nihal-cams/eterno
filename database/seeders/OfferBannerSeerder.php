<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferBannerSeerder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::updateOrCreate(
            ['id' => 1],
            [
                'type' => 2,
                'title' => 'Exclusive Offers Await',
                'description' => 'Discover limited-time offers designed to make your getaway even more memorable',
                'image'  => 'offer-banner.jpg',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
