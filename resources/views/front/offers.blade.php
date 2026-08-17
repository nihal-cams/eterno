@extends('front.layouts.app')
@section('title', 'Offers | ')

@section('content')
    <!-- ========== HERO BANNER ========== -->
    @if ($offerIntro)
        <section class="hero-banner"
            style="background-image:url('{{ asset('uploads/offer-intros/' . $offerIntro->banner_image) }}')">
            <div class="hero-inner-content px-2">
                <h1>{{ $offerIntro->banner_title }}</h1>
                <p>{{ $offerIntro->banner_description }}</p>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>&rsaquo;</span>
                Offers
            </div>
        </section>
    @endif

    <!-- ========== offers section ========== -->
    @if ($offers->count())
        <section class="section-space">
            <div class="container">

                <!-- Resort Select Dropdown -->
                <div class="offer-resort-select-wrapper">
                    <select class="offer-resort-select" id="resortFilter" aria-label="Select your resort">
                        <option value="all">
                            All Resorts
                        </option>
                        @foreach ($resorts as $resort)
                            <option value="{{ $resort->id }}">
                                {{ $resort->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Info -->
                <div class="filter-info" id="filterInfo">
                    Showing packages for <strong id="selectedResortName">All Resorts</strong>
                </div>

                <div class="row" id="packageGrid">

                    @foreach ($offers as $offer)
                        <div class="col-md-6 col-lg-4 package-col" data-resort="{{ $offer->resort_id }}">
                            <div class="package-card">
                                <div class="package-card-img-wrapper">
                                    <img src="{{ asset('uploads/offers/' . $offer->image) }}" alt="{{ $offer->title }}">
                                </div>
                                <h4 class="package-card-title">
                                    {{ $offer->title }}
                                </h4>
                                <p class="package-card-text">
                                    {{ Str::limit($offer->description, 100) }}
                                </p>
                                {{--  <a href="{{ $offer->button_url }}"
                                        class="btn-custom btn-outline-custom"
                                        target="_blank">
                                        {{ $offer->button_text }}
                                    </a>  --}}


                                <a href="javascript:void(0);" class="btn-custom btn-outline-custom" data-bs-toggle="modal"
                                    data-bs-target="#offerModal{{ $offer->id }}">
                                    {{ $offer->button_text }}
                                </a>
                            </div>
                        </div>


                        {{-- Offer Modal --}}

                        <div class="modal fade" id="offerModal{{ $offer->id }}" tabindex="-1"
                            aria-labelledby="offerModalLabel{{ $offer->id }}" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-lg">

                                <div class="modal-content offer-modal-content">

                                    {{-- Header --}}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="offerModalLabel{{ $offer->id }}">
                                            {{ $offer->title }}
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>


                                    {{-- SCROLLABLE CONTENT --}}
                                    <div class="modal-body offer-modal-body">

                                        @if ($offer->image)
                                            <div class="text-center mb-4">
                                                <img src="{{ asset('uploads/offers/' . $offer->image) }}"
                                                    alt="{{ $offer->title }}" class="img-fluid rounded" width="100%">
                                            </div>
                                        @endif

                                        <div class="offer-content">

                                            <p>
                                                Escape to a relaxing and memorable stay with our exclusive
                                                resort offer. Enjoy comfortable accommodation, delicious
                                                dining options and access to selected resort facilities
                                                during your stay.
                                            </p>

                                            <h5>Offer Includes</h5>

                                            <ul>
                                                <li>Comfortable accommodation in a premium room</li>
                                                <li>Daily breakfast for all registered guests</li>
                                                <li>Complimentary Wi-Fi access</li>
                                                <li>Welcome drink on arrival</li>
                                                <li>Access to selected resort facilities</li>
                                            </ul>

                                            <h5>Experience More</h5>

                                            <p>
                                                Whether you are travelling with family, friends or as a
                                                couple, this package is designed to give you a comfortable
                                                and enjoyable resort experience.
                                            </p>

                                            <p>
                                                Relax, unwind and make the most of your stay with our
                                                specially curated offer. Enjoy premium hospitality,
                                                beautiful surroundings and a memorable experience.
                                            </p>


                                        </div>

                                    </div>


                                    {{-- Footer --}}
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>


                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- No Results Message -->
                <div class="no-results" id="noResults">
                    <h3>No packages available</h3>
                    <p>Please select a different resort to view available packages.</p>
                </div>

            </div>
        </section>
    @else
        <section class="section-space">
            <div class="container">
                <div class="col-12 text-center">
                    No offers available.
                </div>
            </div>
        </section>
    @endif
@endsection

@push('styles')
    <style>
        /* =========================================================
                   OFFER MODAL
                   ========================================================= */

        .offer-modal-content {

            height: 90vh;
            max-height: 90vh;

            display: flex;
            flex-direction: column;

            overflow: hidden;
        }


        /* =========================================================
                   MODAL HEADER
                   ========================================================= */

        .offer-modal-content .modal-header {

            flex: 0 0 auto;

        }


        /* =========================================================
                   MODAL BODY - SCROLLABLE
                   ========================================================= */

        .offer-modal-body {

            flex: 1 1 auto;

            min-height: 0;

            overflow-y: auto !important;
            overflow-x: hidden !important;

            /*
                     * Prevent scroll from being transferred
                     * to the page behind the modal.
                     */
            overscroll-behavior: contain;

            /*
                     * Smooth scrolling on iOS.
                     */
            -webkit-overflow-scrolling: touch;

            /*
                     * Make sure the body itself can receive
                     * touch scrolling.
                     */
            touch-action: pan-y;
        }


        /* =========================================================
                   MODAL FOOTER
                   ========================================================= */

        .offer-modal-content .modal-footer {

            flex: 0 0 auto;

        }


        /* =========================================================
                   PREVENT BACKGROUND PAGE SCROLL
                   ========================================================= */

        body.modal-open {

            overflow: hidden !important;

        }


        /*
                 * Additional class used by our JavaScript.
                 */
        html.modal-is-open,
        body.modal-is-open {

            overflow: hidden !important;

            height: 100% !important;

        }


        /* =========================================================
                   MODAL IMAGE
                   ========================================================= */

        .offer-modal-image {

            max-width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;

        }


        /* =========================================================
                   OFFER CONTENT
                   ========================================================= */

        .offer-content {

            font-size: 16px;

            line-height: 1.7;

        }


        /* Headings */

        .offer-content h5 {

            margin-top: 25px;

            margin-bottom: 12px;

        }


        /* Paragraphs */

        .offer-content p {

            margin-bottom: 18px;

        }


        /* Lists */

        .offer-content ul {

            padding-left: 25px;

            margin-bottom: 20px;

        }


        /* List items */

        .offer-content li {

            margin-bottom: 8px;

        }


        /* =========================================================
                   MOBILE
                   ========================================================= */

        @media (max-width: 767px) {

            .offer-modal-content {

                height: 90vh;

                max-height: 90vh;

            }


            .offer-modal-body {

                padding: 15px;

                font-size: 15px;

            }


            .offer-content {

                font-size: 15px;

                line-height: 1.6;

            }

        }
    </style>
@endpush

@push('scripts')
    <script>
        // ==========================
        // Offers Filter
        // ==========================
        const resortFilter = document.getElementById('resortFilter');
        const packageCols = document.querySelectorAll('.package-col');

        if (resortFilter && packageCols.length > 0) {

            const noResults = document.getElementById('noResults');
            const filterInfo = document.getElementById('filterInfo');
            const selectedResortName = document.getElementById('selectedResortName');

            function filterPackages() {

                const selectedResort = resortFilter.value;
                let visibleCount = 0;

                // Show/Hide "Showing packages for..."
                if (selectedResort === 'all') {
                    filterInfo.classList.remove('show');
                } else {
                    selectedResortName.textContent =
                        resortFilter.options[resortFilter.selectedIndex].text;

                    filterInfo.classList.add('show');
                }

                // Filter cards
                packageCols.forEach(function(col) {

                    if (
                        selectedResort === 'all' ||
                        col.dataset.resort === selectedResort
                    ) {
                        col.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        col.classList.add('hidden');
                    }

                });

                // Show "No packages available" only for a selected resort
                if (selectedResort === 'all') {
                    noResults.classList.remove('show');
                } else {
                    noResults.classList.toggle('show', visibleCount === 0);
                }
            }

            resortFilter.addEventListener('change', filterPackages);

            filterPackages();
        }
    </script>

    <script>
        /* =========================================================
               MODAL SCROLL FIX
               ========================================================= */

        document.addEventListener('DOMContentLoaded', function() {


            /*
             * When modal opens
             */

            document.querySelectorAll('.modal').forEach(function(modal) {

                // Prevent scroll/wheel/touch events from bubbling up to Lenis on the window
                ['wheel', 'touchmove'].forEach(function(eventType) {
                    modal.addEventListener(eventType, function(e) {
                        e.stopPropagation();
                    }, { passive: true });
                });

                modal.addEventListener(
                    'show.bs.modal',
                    function() {
                        if (window.lenis) {
                            window.lenis.stop();
                        }
                        document.body.classList.add('modal-is-open');
                        document.documentElement.classList.add('modal-is-open');
                    }
                );

                modal.addEventListener(
                    'shown.bs.modal',
                    function() {

                        /*
                         * Make sure the modal body starts
                         * at the top when opened.
                         */

                        const modalBody =
                            modal.querySelector(
                                '.offer-modal-body'
                            );


                        if (modalBody) {

                            modalBody.scrollTop = 0;

                        }

                    }
                );


                /*
                 * When modal closes
                 */

                modal.addEventListener(
                    'hidden.bs.modal',
                    function() {

                        document.body.classList.remove(
                            'modal-is-open'
                        );
                        document.documentElement.classList.remove(
                            'modal-is-open'
                        );

                        // Only restart Lenis if no other modals are open
                        if (window.lenis && document.querySelectorAll('.modal.show').length === 0) {
                            window.lenis.start();
                        }

                    }
                );

            });

        });
    </script>
@endpush
