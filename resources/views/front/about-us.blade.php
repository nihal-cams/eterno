@extends('front.layouts.app')
@section('title', 'About Us | ')

@section('content')
    <!-- ========== HERO BANNER ========== -->

    <section class="hero-banner"
        style="background-image:
        linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
        url('{{ $aboutpage?->banner_image ? asset($aboutpage->banner_image) : asset('images/contact-hero-bg.jpg') }}');">


        <div class="hero-inner-content px-2 reveal">
            <h1>{{ $aboutpage->banner_title }}</h1>
            <p>{{ $aboutpage->banner_description }}</p>
        </div>

        <div class="breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>&rsaquo;</span>
            About Us
        </div>

    </section>

    <!-- ========== INTRO SECTION ========== -->
    <section class="intro-section">
        <div class="intro-image reveal-left">
            <img src="{{ $aboutpage->intro_image ? asset($aboutpage->intro_image) : asset('images/about-intro.jpg') }}"
                alt="Eterno resort nestled in lush greenery" class="img-fluid">
        </div>
        <div class="intro-text reveal-right">
            <h2>{{ $aboutpage->intro_title }}</h2>
            <p>{!! $aboutpage->intro_description !!}</p>
        </div>
    </section>

    <!-- ========== PHILOSOPHY SECTION ========== -->
    <section class="philosophy-section reveal">
        <h2>Our Philosophy</h2>
        <div class="philosophy-cards">

            @foreach ($aboutphilosophy as $philosophy)
                <div class="philosophy-card">

                    <div class="icon">
                        <div class="icon">
                            @if ($philosophy->icon_image)
                                <img src="{{ asset($philosophy->icon_image) }}" alt="{{ $philosophy->title }}"
                                    class="img-fluid">
                            @endif
                        </div>
                    </div>

                    <h4>{{ $philosophy->title }}</h4>

                    <p>{{ $philosophy->description }}</p>

                </div>
            @endforeach
        </div>
    </section>


    <!-- ========== CORE VALUES SECTION ========== -->
    <section class="core-values-section">
        <div class="core-values-header reveal">
            <h2>Core Values</h2>
            <p>The values that shape every stay and every experience.</p>
        </div>
        <div class="core-values-content ">
            <div class="core-values-image reveal-left">
                <img src="images/core-value-img1.jpg" alt="Lush green forest landscape">
            </div>
            <div class="core-values-accordions reveal-right">
                @foreach ($aboutcorevalues as $key => $value)
                    <div class="accordion-item {{ $key === 0 ? 'active' : '' }}">

                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <h4>{{ $value->title }}</h4>

                            <span class="accordion-toggle">
                                {{ $key === 0 ? '−' : '+' }}
                            </span>
                        </div>

                        <div class="accordion-body">
                            <p>{{ $value->description }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========== MOUNTAIN EDGE SVG ========== -->


    <!-- ========== CTA SECTION ========== -->
    <div class="element-top position-relative ">
        <div class="element-bg-2">
            <img src="images/element-bg-top.png" alt="" class="img-fluid">
        </div>
    </div>


    <section class="cta-section"
        style="
        background:
            url('{{ $aboutpage?->cta_background_image ? asset($aboutpage->cta_background_image) : asset('images/contact-hero-bg.jpg') }}')
            center/cover no-repeat;
    ">

        <div class="cta-content reveal">
            <h2>{{ $aboutpage->cta_title }}</h2>

            <div class="cta-divider">
                <svg viewBox="0 0 200 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 15 Q30 5 50 15 Q70 25 90 15 Q110 5 130 15 Q150 25 170 15 Q190 5 200 15" stroke="#b89a5e"
                        stroke-width="1.5" fill="none" />
                    <circle cx="100" cy="15" r="4" fill="#b89a5e" />
                    <circle cx="100" cy="15" r="2" fill="#0a1a2e" />
                    <path d="M60 15 L80 15" stroke="#b89a5e" stroke-width="0.8" />
                    <path d="M120 15 L140 15" stroke="#b89a5e" stroke-width="0.8" />
                    <circle cx="40" cy="15" r="2" fill="#b89a5e" opacity="0.5" />
                    <circle cx="160" cy="15" r="2" fill="#b89a5e" opacity="0.5" />
                </svg>
            </div>

            <p class="desc">{{ $aboutpage->cta_description }}</p>

            <p class="tagline">Discover a place that feels like yours</p>

            <a href="{{ $aboutpage->cta_button_link }}" class="btn-custom btn-primary-custom">
                {{ $aboutpage->cta_button_text }}
            </a>


        </div>

    </section>
@endsection
