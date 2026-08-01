<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\OfferIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferIntroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfferIntro::updateOrCreate(
            ['id' => 1],
            [
                'sub_title' => 'Special Offers',
                'title' => 'Exclusive Packages & Seasonal Deals',
                'description' => 'Discover special offers crafted to make your stay even more memorable. Enjoy exclusive benefits, seasonal discounts and curated experiences available for a limited time.',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
