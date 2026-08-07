@extends('front.layouts.app')

@section('content')
<!-- Hero Section -->
@if($banners->count() && $bannerText)
<section class="hero-section">
    @if($banners->count())
    @foreach($banners as $banner)
    <div class="hero-slideshow">
        <div class="hero-slide {{ $loop->first ? 'active' : '' }}"
            style="background-image: linear-gradient(rgba(0,0,0,.45), rgba(0,0,0,.45)), url('{{ asset('uploads/banners/'.$banner->image) }}');">
        </div>
    </div>
    @endforeach
    @endif
    @if($bannerText)
    <div class="container">
        <div class="hero-content reveal">
            <h1>{{ $bannerText->title }}</h1>
            <p>{{ $bannerText->description }}</p>
        </div>
    </div>
    @endif
</section>
@endif

<!-- Welcome Section -->
@if($welcome)
<section class="welcome-section">
    <div class="container">
        <div class="welcome-card-wrapper reveal">
            <div class="welcome-card">
                <div class="welcome-img-left reveal-left">
                    <img src="{{ asset('uploads/welcome-sections/'.$welcome->left_image) }}" alt="Resort View">
                </div>
                <div class="welcome-content">
                    <div class="section-label">{{ $welcome->sub_title }}</div>
                    <h2>{{ $welcome->title }}</h2>
                    <p class="subhead">{{ $welcome->description }}</p>
                    <div> <a href="{{ $welcome->button_url }}" class="btn-custom btn-outline-custom">{{ $welcome->button_text }}</a></div>
                </div>
                <div class="welcome-img-right d-none d-xl-block reveal-right">
                    <img src="{{ asset('uploads/welcome-sections/'.$welcome->right_image) }}" alt="Nature View">
                </div>
            </div>
        </div>
    </div>
</section>
@endif


<!-- Resorts Section -->
@if($resortIntro || $resorts->count())
<section class="resorts-section section-space" id="resortContainer">
    <div class="resorts-sticky-wrapper">
        <div class="container">
            <div class="mb-4 mb-md-5 reveal">
                <div class="section-label">{{ $resortIntro->sub_title }}</div>
                <h2>{{ $resortIntro->title }}</h2>
            </div>
            
            <div class="resort-tabs reveal-scale">
                @foreach($resorts as $resort)
                <button class="resort-tab {{ $loop->first ? 'active' : '' }}" data-target="resort-{{ $resort->id }}">{{ $resort->name }}</button>
                @endforeach
            </div>
        </div>

        <!-- Wrapper for swipeable panels on mobile/tablet -->
        <div class="resort-panels-wrapper">
            @foreach($resorts as $resort)
            <div class="resort-panel {{ $loop->first ? 'active' : '' }}" id="resort-{{ $resort->id }}">
                <div class="row align-items-center g-5 ">
                    <div class="col-lg-6 order-2 order-lg-1 resort-content-mt">
                        <div class="resort-content">
                            <h3>{{ $resort->name }} - {{ $resort->home_place }}</h3>
                            <span class="subtitle">{{ $resort->home_title }}</span>
                            <p>{{ $resort->home_description }}</p>
                            <a href="{{ $resort->home_button_url }}" class="btn-custom btn-outline-custom">{{ $resort->home_button_text }}</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 resort-img-mt">
                        <div class="resort-image">
                            <img src="{{ asset('uploads/resorts/'.$resort->home_image) }}" alt="{{ $resort->name }}" class="img-fluid">
                            <div class="swipe-indicator">
                                <span>Swipe</span>
                                <i class="bi bi-arrow-right-short"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

    <!-- Experiences Section -->
    <section class="experiences-section section-space-bottom">
        <div class="container">
            <div class="reveal">
                <div class="section-label">{{ $homeexperiencepage->banner_title }}</div>
                <h2>{{ $homeexperiencepage->intro_subtitle }}</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="experience-main-card reveal-left">
                        <h3>{{ $homeexperiencepage->intro_title }}</h3>
                        <p>{{ $homeexperiencepage->intro_description }}</p>
                        <a href="{{ $homeexperiencepage->button_url }}"
                            class="btn-custom btn-custom-white">{{ $homeexperiencepage->button_text }}</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row g-4">
                        @foreach ($homeexperiences as $key => $experience)
                            <div class="col-md-6">
                                <div class="experience-card reveal reveal-delay-{{ ($key % 2) + 1 }}">
                                    <div class="experience-icon">
                                        @if ($experience->image)
                                            <img src="{{ asset($experience->image) }}" alt="{{ $experience->title }}">
                                        @endif
                                    </div>
                                    <h4>{{ $experience->title }}</h4>
                                    <p>{{ $experience->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Video Section -->
@if($video)
<section class="video-section" style="background-image:
        linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.4)),
        url('{{ asset('uploads/video-sections/'.$video->thumbnail_image) }}');">
    <div class="d-flex flex-column align-items-center">
        <div class="play-button reveal-scale" data-bs-toggle="modal" data-bs-target="#videoModal">
            <i class="bi bi-play-fill"></i>
        </div>
        <h3 class="reveal">{{ $video->title }}</h3>
    </div>


    <!-- Video Modal -->
    <div class="modal fade video-modal-blur" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">

                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-body p-0">
                    <video id="popupVideo" class="w-100 rounded-3" controls>
                        <source
                            src="{{ asset('uploads/video-sections/'.$video->video) }}"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Offers Section -->
@if($offerIntro || $offers->count())
<section class="offers-section section-space">
    <div class="container">
        @if($offerIntro)
        <div class="d-flex flex-column align-items-center reveal">
            <div class="section-label">{{ $offerIntro->sub_title }}</div>
            <h2 class="mb-3 text-center">{{ $offerIntro->title }}</h2>
            <p class="subhead max-910 text-center">
                {{ $offerIntro->description }}
            </p>
        </div>
        @endif

        @if($offers->count())
        <div class="row g-4 justify-content-center">
            @foreach($offers as $offer)
            <div class="col-lg-6 reveal {{ $loop->odd ? 'reveal-left' : 'reveal-right' }}">
                <div class="offer-card mb-2">
                    <img src="{{ asset('uploads/offers/'.$offer->image) }}" class="img-fluid w-100" alt="Offer">
                    <a href="{{ $offer->button_url }}" class="btn-custom btn-custom-white">{{ $offer->button_text }}</a>
                </div>
                <div class="gallery-slide gallery-slide-short">
                    <img src="images/gallery-1.jpg" alt="Gallery 2">
                </div>
                <div class="gallery-slide gallery-slide-tall">
                    <img src="images/gallery-3.jpg" alt="Gallery 3">
                </div>
                <div class="gallery-slide gallery-slide-short">
                    <img src="images/gallery-4.jpg" alt="Gallery 4">
                </div>
                <div class="gallery-slide gallery-slide-tall">
                    <img src="images/gallery-5.jpg" alt="Gallery 5">
                </div>

                <!-- Duplicate Set for seamless loop -->
                <div class="gallery-slide gallery-slide-short">
                    <img src="images/gallery-2.jpg" alt="Gallery 1">
                </div>
                <div class="gallery-slide gallery-slide-tall">
                    <img src="images/gallery-1.jpg" alt="Gallery 2">
                </div>
                <div class="gallery-slide gallery-slide-short">
                    <img src="images/gallery-3.jpg" alt="Gallery 3">
                </div>
                <div class="gallery-slide gallery-slide-tall">
                    <img src="images/gallery-4.jpg" alt="Gallery 4">
                </div>
                <div class="gallery-slide gallery-slide-short">
                    <img src="images/gallery-5.jpg" alt="Gallery 5">
                </div>

            </div>
            @endforeach
        </div>

        @if($offersType2Count)
        <div class="text-center mt-5">
            <a href="{{ route('offers') }}" class="btn-custom btn-outline-custom">Find More Offers</a>
        </div>
        @endif
        @endif

    </div>
</section>
@endif

<!-- Gallery Section -->
@if($galleryIntro || $galleries->count())
<section class="gallery-section">
    @if($galleryIntro)
    <div class="container">
        <div class="gallery-header mb-5 reveal">

            <div class="section-label">{{ $galleryIntro->sub_title }}</div>
            <h2 class="mb-3">{{ $galleryIntro->title }}</h2>
            <p class="subhead max-910">
                {{ $galleryIntro->description }}
            </p>

        </div>
    </div>
    @endif

    @if($galleries->count())
    <div class="gallery-slider-wrapper reveal">
        <div class="gallery-track">
            @foreach($galleries as $gallery)
            <div class="gallery-slide {{ $loop->odd ? 'gallery-slide-tall' : 'gallery-slide-short' }}">
                <img src="{{ asset('uploads/galleries/'.$gallery->image) }}" alt="Gallery Image">
            </div>
            @endforeach
        </div>
    </div>

    @if($galleryType2Count)
    <div class="text-center mt-5">
        <a href="{{ route('gallery') }}" class="btn-custom btn-outline-custom">View Our Gallery</a>
    </div>
    @endif
    @endif
</section>
@endif

<!-- Testimonials Section -->
@if($testimonialIntro || $testimonials->count())
<section class="testimonials-section section-space">
    @if($testimonialIntro)
    <div class=" container">
        <div class="text-center reveal d-flex flex-column align-items-center reveal">
            <div class="section-label">{{ $testimonialIntro->sub_title }}</div>
            <h2 class="mb-3">{{ $testimonialIntro->title }}</h2>
            <p class="subhead max-910 text-center">
                {{ $testimonialIntro->description }}
            </p>
        </div>
    </div>
    @endif

    @if($testimonials->count())
    @php
        $tagClasses = ['tag-green', 'tag-brown', 'tag-blue'];
        $tagIndex = 0;
    @endphp
    <div class="testimonial-slider-wrapper reveal">
        <div class="testimonial-track">
            @foreach($testimonials->chunk(2) as $column)
            <div class="testimonial-slide">
                @foreach($column as $testimonial)
                <div class="testimonial-card {{ !$loop->first ? 'testimonial-card-offset' : '' }}">
                    <span class="testimonial-tag {{ $tagClasses[$tagIndex % count($tagClasses)] }}">{{ $testimonial->resort?->name }}</span>
                    <h5>"{{ $testimonial->title }}"</h5>
                    <p>"{{ $testimonial->content }}"</p>
                    <div class="testimonial-author">
                        <img src="{{ asset('uploads/testimonials/'.$testimonial->customer_image) }}"
                                    alt="{{ $testimonial->customer_name }}" class="author-img">
                        <span class="author-name">— {{ $testimonial->customer_name }}, {{ $testimonial->customer_place }}</span>
                    </div>
                </div>
                @php $tagIndex++; @endphp
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endif
@endsection
