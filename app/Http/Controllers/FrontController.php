<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\GalleryIntro;
use App\Models\Offer;
use App\Models\OfferIntro;
use App\Models\Resort;
use App\Models\Testimonial;
use App\Models\TestimonialIntro;
use App\Models\VideoSection;
use App\Models\WelcomeSection;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $bannerText = Banner::where('type', 1)
            ->where('status', Status::ACTIVE)
            ->first();

        $banners = Banner::where('type', 2)
            ->where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();
        
        $welcome = WelcomeSection::where('status', Status::ACTIVE)
            ->first();

        $resorts = Resort::where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();

        $video = VideoSection::where('status', Status::ACTIVE)
            ->first();

        $offerIntro = OfferIntro::where('type', 1)
            ->where('status', Status::ACTIVE)
            ->first();
        
        $offers = Offer::where('type', 1)
            ->where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->take(2)
            ->get();
        
        $offersType2Count = Offer::where('type', 2)
            ->where('status', Status::ACTIVE)
            ->count();
        
        $galleryIntro = GalleryIntro::where('type', 1)
            ->where('status', Status::ACTIVE)
            ->first();
        
        $galleries = Gallery::with('resort')
            ->where('type', 1)
            ->where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $galleryType2Count = Gallery::where('type', 2)
            ->where('status', Status::ACTIVE)
            ->count();

        $testimonialIntro = TestimonialIntro::where('status', Status::ACTIVE)
            ->first();
        
        $testimonials = Testimonial::where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->take(8)
            ->get();

        return view('front.home', compact(
            'bannerText',
            'banners',
            'welcome',
            'resorts',
            'video',
            'offerIntro',
            'offers',
            'offersType2Count',
            'galleryIntro',
            'galleries',
            'testimonialIntro',
            'testimonials',
            'galleryType2Count'
        ));
    }

    public function gallery()
    {
        $galleryIntro = GalleryIntro::where('type', 2)
            ->where('status', Status::ACTIVE)
            ->first();

        $resorts = Resort::where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();

        $categories = GalleryCategory::where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();

        $galleries = Gallery::with('galleryCategory')
            ->where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();

        return view('front.gallery', compact(
            'galleryIntro',
            'resorts',
            'categories',
            'galleries'
        ));
    }

    public function offers()
    {
        $offerIntro = OfferIntro::where('type', 2)
            ->where('status', Status::ACTIVE)
            ->first();

        $resorts = Resort::where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();

        $offers = Offer::where('status', Status::ACTIVE)
            ->orderByDesc('id')
            ->get();

        return view('front.offers', compact(
            'offerIntro',
            'resorts',
            'offers'
        ));
    }
}
