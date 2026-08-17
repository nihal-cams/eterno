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


                                    {{-- Scrollable Body --}}
                                    <div class="modal-body offer-modal-body">

                                        @if ($offer->image)
                                            <div class="text-center mb-4">
                                                <img src="{{ asset('uploads/offers/' . $offer->image) }}"
                                                    alt="{{ $offer->title }}" class="img-fluid rounded"
                                                    style="max-height: 300px;">
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

                                            <h5>Terms &amp; Conditions</h5>

                                            <ul>
                                                <li>Offer is subject to availability.</li>
                                                <li>Advance reservation is required.</li>
                                                <li>Blackout dates may apply.</li>
                                                <li>This offer cannot be combined with other promotions.</li>
                                                <li>Additional charges may apply for extra services.</li>
                                                <li>Terms and conditions may change without prior notice.</li>
                                            </ul>

                                            <h5>Booking Information</h5>

                                            <p>
                                                Contact our reservations team for availability, pricing
                                                and booking assistance.
                                            </p>

                                            <p>
                                                <strong>Book your stay today</strong> and enjoy an
                                                unforgettable resort experience with us.
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
        /* Modal */
        .offer-modal-content {
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        /* Only modal body scrolls */
        .offer-modal-body {
            overflow-y: auto !important;
            overflow-x: hidden;
            max-height: calc(90vh - 130px);
            -webkit-overflow-scrolling: touch;
        }

        /* Content */
        .offer-content {
            font-size: 16px;
            line-height: 1.7;
        }

        .offer-content h5 {
            margin-top: 25px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .offer-content p {
            margin-bottom: 18px;
        }

        .offer-content ul {
            padding-left: 25px;
            margin-bottom: 20px;
        }

        .offer-content li {
            margin-bottom: 8px;
        }

        /* Close button */
        .offer-modal-content .btn-close {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
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
@endpush
