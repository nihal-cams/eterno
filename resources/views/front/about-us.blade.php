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
            <a href="{{ route('home') }}">Home</a>
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
                <img src="{{ asset('images/core-value-img1.jpg') }}" alt="Lush green forest landscape">
            </div>
            {{--  <div class="core-values-accordions reveal-right">
                @foreach ($aboutcorevalues as $key => $value)

                    <div class="accordion-item {{ $key === 0 ? 'active' : '' }}">

                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <h4>{{ $value->title }}</h4>

                            <span class="accordion-toggle"></span>
                        </div>

                        <div class="accordion-body">
                            <p>{{ $value->description }}</p>
                        </div>

                    </div>
                @endforeach
            </div>  --}}
            {{--  <div class="core-values-accordions reveal-right">
                @foreach ($aboutcorevalues as $key => $value)
                    <div class="accordion-item">
                        <input type="radio" name="core-values" id="core-value-{{ $key }}"
                            class="core-value-radio" {{ $key === 0 ? 'checked' : '' }}>
                        <label for="core-value-{{ $key }}" class="accordion-header">
                            <h4>{{ $value->title }}</h4>
                            <span class="accordion-toggle"></span>
                        </label>
                        <div class="accordion-body">
                            <p>{{ $value->description }}</p>
                        </div>
                    </div>
                @endforeach

            </div>  --}}

            <div class="core-values-accordions reveal-right">
                @foreach ($aboutcorevalues as $key => $value)
                    <div class="accordion-item">

                        <input type="radio" name="core-values" id="core-value-{{ $key }}"
                            class="core-value-radio" {{ $key === 0 ? 'checked' : '' }}>

                        <div class="accordion-header">
                            <h4>{{ $value->title }}</h4>
                            <span class="accordion-toggle"></span>
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
@push('scripts')
    <script>
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', function() {
                const radio = this.closest('.accordion-item')
                    .querySelector('.core-value-radio');

                radio.checked = true;
            });
        });
    </script>
@endpush

{{-- ========================================================= --}}
{{--  @push('styles')
    <style>
        /* =========================================
       RADIO ACCORDION
       Keeps designer's original classes/design
    ========================================= */

        /* Hide radio */

        .core-values-accordions .core-value-radio {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }


        /* Keep designer header */

        .core-values-accordions .accordion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }


        /* Keep designer toggle size */

        .core-values-accordions .accordion-toggle {
            font-size: 2.5rem;
            color: var(--color-primary);
            font-weight: 300;

            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            line-height: 1;
        }


        /* =========================================
       BODY CLOSED
    ========================================= */

        .core-values-accordions .accordion-body {
            max-height: 0;
            overflow: hidden;

            padding-top: 0;

            transition:
                max-height 0.4s ease,
                padding-top 0.4s ease;
        }


        /* =========================================
       BODY OPEN
    ========================================= */

        .core-values-accordions .core-value-radio:checked~.accordion-body {
            max-height: 1000px;
            padding-top: 14px;
        }


        /* =========================================
       PLUS / MINUS
    ========================================= */

        .core-values-accordions .accordion-minus {
            display: none;
        }

        .core-values-accordions .accordion-plus {
            display: inline;
        }


        /* Checked = MINUS */

        .core-values-accordions .core-value-radio:checked~.accordion-header .accordion-plus {
            display: none;
        }

        .core-values-accordions .core-value-radio:checked~.accordion-header .accordion-minus {
            display: inline;
        }
    </style>
@endpush  --}}
{{--  @push('scripts')
    <script>
        function toggleAccordion(header) {

            const currentItem = header.closest('.accordion-item');

            if (!currentItem) {
                return;
            }

            const container = header.closest('.core-values-accordions');

            if (!container) {
                return;
            }

            const allItems = container.querySelectorAll('.accordion-item');

            const wasActive = currentItem.classList.contains('active');

            // Close all
            allItems.forEach(function(item) {

                item.classList.remove('active');

                const toggle = item.querySelector('.accordion-toggle');

                if (toggle) {
                    toggle.textContent = '+';
                }

            });

            // Open clicked item
            if (!wasActive) {

                currentItem.classList.add('active');

                const toggle = currentItem.querySelector('.accordion-toggle');

                if (toggle) {
                    toggle.textContent = '−';
                }
            }
        }
    </script>
@endpush  --}}
@push('styles')
    <style>
        /* =========================================
                                   CORE VALUES ACCORDION
                                ========================================= */

        .core-values-accordions {
            width: 100%;
        }

        .core-values-accordions .accordion-item {
            width: 100%;
            border-bottom: 1px solid #ddd;
        }


        /* =========================================
                                   HIDE RADIO
                                ========================================= */

        .core-values-accordions .core-value-radio {
            position: absolute !important;
            opacity: 0 !important;
            width: 1px !important;
            height: 1px !important;
            pointer-events: none !important;
        }


        /* =========================================
                                   HEADER
                                ========================================= */

        .core-values-accordions .accordion-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            width: 100%;

            padding: 25px 0;

            cursor: pointer;
        }

        .core-values-accordions .accordion-header h4 {
            margin: 0;
            padding: 0;

            flex: 1;
        }


        /* =========================================
                                   TOGGLE
                                ========================================= */

        .core-values-accordions .accordion-toggle {
            position: relative !important;

            width: 24px !important;
            height: 24px !important;
            min-width: 24px !important;

            margin-left: 20px !important;

            flex-shrink: 0 !important;

            display: flex !important;
            align-items: center !important;
            justify-content: center !important;

            font-size: 0 !important;

            background: transparent !important;
            border: 0 !important;
        }


        /* Remove any old pseudo-elements */

        .core-values-accordions .accordion-toggle::after {
            display: none !important;
        }


        /* =========================================
                                   PLUS / MINUS
                                ========================================= */

        .core-values-accordions .accordion-toggle::before {
            content: "+" !important;

            display: block !important;

            color: #8b7350 !important;

            font-size: 30px !important;
            font-weight: 300 !important;

            line-height: 24px !important;
        }


        /* OPEN = MINUS */

        .core-values-accordions .core-value-radio:checked~.accordion-header .accordion-toggle::before {

            content: "−" !important;
        }


        /* =========================================
                                   BODY
                                ========================================= */

        .core-values-accordions .accordion-body {
            display: none !important;

            width: 100%;

            padding: 0 0 25px 0;
        }

        .core-values-accordions .accordion-body p {
            margin: 0;
        }


        /* =========================================
                                   OPEN BODY
                                ========================================= */

        .core-values-accordions .core-value-radio:checked~.accordion-body {

            display: block !important;
        }


        /* =========================================
                                   MOBILE
                                ========================================= */

        @media (max-width: 767px) {

            .core-values-accordions .accordion-header {
                padding: 20px 0;
            }

            .core-values-accordions .accordion-toggle {
                width: 22px !important;
                height: 22px !important;
                min-width: 22px !important;

                margin-left: 15px !important;
            }

        }
    </style>
@endpush
