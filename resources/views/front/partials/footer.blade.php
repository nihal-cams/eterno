<div class="element-main position-relative">
    <div class="element-bg">
        <img src="images/bg-element.png" alt="" class="img-fluid">
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="container">
            <h2 class="reveal-left">Stay connected with what actually matters</h2>
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal-left">
                    <p class="subhead mb-0 color-primary">To receive updates about exclusive experiences, events,
                        new
                        destinations and
                        more, please
                        register your interest.</p>
                </div>
                <div class="col-lg-6 reveal-right">
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email Address">
                        <a href="#" class="btn-custom btn-primary-custom">Subscribe</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row footer-main-row reveal">
            <!-- Logo & Address -->
            <div class="col-xl-3 col-lg-4 col-md-6 footer-col">
                <div class="footer-logo-area">
                    <div class="footer-logo-img">
                        <img src="images/footer-logo.png" alt="">
                    </div>
                    <div class="footer-address">
                        <strong>Conglomerate of</strong>
                        @if ($contactpage && $contactpage->address_1)
                            {!! nl2br(e($contactpage->address_1)) !!}
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-xl-3 col-lg-4 col-md-6 footer-col">
                <div class="footer-links-area d-flex justify-content-start justify-content-lg-center">
                    <div>
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="footer-links">
                            <li> <a href="{{ url('/') }}"> Home </a> </li>
                            <li> <a href="{{ url('/about') }}"> About Us </a> </li>
                            <li> <a href="{{ url('/offers') }}"> Offers </a> </li>
                            <li> <a href="{{ url('/experience') }}"> Experiences </a> </li>
                            <li> <a href="{{ url('/gallery') }}"> Gallery </a> </li>
                            <li> <a href="{{ url('/contact') }}"> Contact </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Our Resorts -->
            <div class="col-xl-2 col-lg-4 col-md-6 footer-col">
                <div
                    class="footer-links-area d-flex justify-content-start justify-content-md-start justify-content-lg-center">
                    <div>
                        <h5 class="footer-heading">Our Resorts</h5>
                        <ul class="footer-links">
                            @forelse ($resorts as $resort)
                                <li> <a href="{{ $resort->button_url }}"> {{ $resort->name }} </a>
                                </li>
                            @empty
                                <li> <span>No resorts available</span> </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Us -->
            <div class="col-xl-4  col-md-6 footer-col">
                <div class="footer-contact-area d-flex justify-content-start justify-content-xl-end">

                    <div>
                        <h5 class="footer-heading">Contact Us</h5>

                        @if ($contactpage)
                            <ul class="footer-contact-list">
                                {{-- Phone 1 --}}
                                @if (!empty($contactpage->phone_1))
                                    <li>
                                        <i class="bi bi-phone"></i> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactpage->phone_1) }}">
                                            {{ $contactpage->phone_1 }} </a>
                                    </li>
                                @endif
                                {{-- Phone 2 --}}
                                @if (!empty($contactpage->phone_2))
                                    <li>
                                        <i class="bi bi-phone"></i> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactpage->phone_2) }}">
                                            {{ $contactpage->phone_2 }} </a>
                                    </li>
                                @endif
                                {{-- Telephone --}}
                                @if (!empty($contactpage->phone_3))
                                    <li>
                                        <i class="bi bi-telephone"></i> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactpage->phone_3) }}">
                                            {{ $contactpage->phone_3 }} </a>
                                    </li>
                                @endif
                                {{-- Email --}}
                                @if (!empty($contactpage->email))
                                    <li>
                                        <i class="bi bi-envelope"></i> <a href="mailto:{{ $contactpage->email_1 }}">
                                            {{ $contactpage->email_1 }} </a>
                                    </li>
                                @endif
                                {{-- Reservation Email --}}
                                @if (!empty($contactpage->email_2))
                                    <li> <i class="bi bi-envelope"></i> <a href="mailto:{{ $contactpage->email_2 }}">
                                            {{ $contactpage->email_2 }} </a>
                                    </li>
                                @endif
                            </ul>

                            <div class="footer-follow">
                                <span>Follow Us</span>

                                <div class="footer-social">
                                    {{-- X / Twitter --}}
                                    @if (!empty($contactpage->twitter_url))
                                        <a href="{{ $contactpage->twitter_url }}" target="_blank" rel="noopener"
                                            aria-label="X">
                                            <i class="bi bi-twitter-x"></i> </a>
                                    @endif
                                    {{-- YouTube --}}
                                    @if (!empty($contactpage->youtube_url))
                                        <a href="{{ $contactpage->youtube_url }}" target="_blank" rel="noopener"
                                            aria-label="YouTube"> <i class="bi bi-youtube"></i> </a>
                                    @endif
                                    {{-- Instagram --}}
                                    @if (!empty($contactpage->instagram_url))
                                        <a href="{{ $contactpage->instagram_url }}" target="_blank" rel="noopener"
                                            aria-label="Instagram"> <i class="bi bi-instagram"></i> </a>
                                    @endif
                                    {{-- Facebook --}}
                                    @if (!empty($contactpage->facebook_url))
                                        <a href="{{ $contactpage->facebook_url }}" target="_blank" rel="noopener"
                                            aria-label="Facebook"> <i class="bi bi-facebook"></i> </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>©2026. All rights reserved. Kavumkal Dream Destination Pvt. Ltd. <span class="footer-divider">|</span>
                Designed By <a href="https://camstech.com/" class="color-primary text-decoration-none" target="_blank">
                    CAMS</a>
            </p>
            <div class="footer-legal">
                <a href="#">Terms & Conditions</a>
                <span class="footer-divider">|</span>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js?v=9"></script>
<script src="https://unpkg.com/lenis@1.3.11/dist/lenis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

@stack('scripts')
</body>

</html>
