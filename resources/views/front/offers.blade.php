@extends('front.layouts.app')
@section('title', 'Offers | ')

@section('content')
<!-- ========== HERO BANNER ========== -->
@if($offerIntro)
<section class="hero-banner"
    style="background-image:url('{{ asset('uploads/offer-intros/'.$offerIntro->banner_image) }}')">
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
@if($offers->count())
<section class="section-space">
    <div class="container">

        <!-- Resort Select Dropdown -->
        <div class="offer-resort-select-wrapper">
            <select class="offer-resort-select"
                id="resortFilter" aria-label="Select your resort">
                <option value="all">
                    All Resorts
                </option>
                @foreach($resorts as $resort)
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

            @foreach($offers as $offer)
            <div class="col-md-6 col-lg-4 package-col"
                data-resort="{{ $offer->resort_id }}">
                <div class="package-card">
                    <div class="package-card-img-wrapper">
                        <img
                            src="{{ asset('uploads/offers/'.$offer->image) }}"
                            alt="{{ $offer->title }}">
                    </div>
                    <h4 class="package-card-title">
                        {{ $offer->title }}
                    </h4>
                    <p class="package-card-text">
                        {{ Str::limit($offer->description, 100) }}
                    </p>
                    <a href="{{ $offer->button_url }}"
                        class="btn-custom btn-outline-custom"
                        target="_blank">
                        {{ $offer->button_text }}
                    </a>
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
            packageCols.forEach(function (col) {

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