@extends('front.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-slideshow">
            <div class="hero-slide active"
                style="background-image: linear-gradient(rgba(0,0,0,45%), rgba(0,0,0,45%)), url('./images/banner-2.jpg');">
            </div>
            <div class="hero-slide"
                style="background-image: linear-gradient(rgba(0,0,0,45%), rgba(0,0,0,45%)), url('./images/banner-1.jpg');">
            </div>
            <div class="hero-slide"
                style="background-image: linear-gradient(rgba(0,0,0,45%), rgba(0,0,0,45%)), url('./images/banner-3.jpg');">
            </div>
        </div>
        <div class="container">
            <div class="hero-content reveal">
                <h1>An Invitation to the new world</h1>
                <p>Eterno Hotels & Resorts brings together exceptional destinations where nature, comfort and
                    unforgettable
                    experiences come together.</p>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="welcome-section">
        <div class="container">
            <div class="welcome-card-wrapper reveal">
                <div class="welcome-card">
                    <div class="welcome-img-left reveal-left">
                        <img src="images/home-about-1.jpg" alt="Resort View">
                    </div>
                    <div class="welcome-content">
                        <div class="section-label">Welcome</div>
                        <h2>Eterno</h2>
                        <p class="subhead">At Eterno Hotels & Resorts, we believe that every destination has a story
                            waiting to be
                            experienced. Our properties are thoughtfully designed to blend luxury with the natural
                            beauty of their surroundings, offering guests immersive stays that create lasting memories.
                        </p>
                        <div> <a href="about-us.php" class="btn-custom btn-outline-custom">Learn More</a></div>
                    </div>
                    <div class="welcome-img-right d-none d-xl-block reveal-right">
                        <img src="images/home-about-2.jpg" alt="Nature View">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Resorts Section -->

    <section class="resorts-section section-space" id="resortContainer">
        <div class="resorts-sticky-wrapper">
            <div class="container">
                <div class="mb-4 mb-md-5 reveal">
                    <div class="section-label">Discover Your Perfect Escape</div>
                    <h2>Explore Our Resorts</h2>
                </div>

                <div class="resort-tabs reveal-scale">
                    <button class="resort-tab active" data-target="camellia">Camellia & Elettaria</button>
                    <button class="resort-tab" data-target="capithans">Capithans Dale</button>
                    <button class="resort-tab" data-target="amber">Amber Paradise</button>
                </div>

                <!-- Wrapper for swipeable panels on mobile/tablet -->
                <div class="resort-panels-wrapper">
                    <!-- Camellia & Elettaria -->
                    <div class="resort-panel active" id="camellia">
                        <div class="row align-items-center g-5 ">
                            <div class="col-lg-6 order-2 order-lg-1 resort-content-mt">
                                <div class="resort-content">
                                    <h3>Camellia & Elettaria - Munnar</h3>
                                    <span class="subtitle">A Luxury Plantation Resort in Munnar</span>
                                    <p>Nestled amidst 22 acres of lush cardamom and tea plantations, Camellia & Elettaria
                                        offers a peaceful escape surrounded by misty hills and pristine forests. Guests can
                                        choose from elegantly designed valley-view suites, wooden houses and luxury tree
                                        houses while enjoying breathtaking views and complete tranquility.</p>
                                    <a href="#" class="btn-custom btn-outline-custom">Explore Property</a>
                                </div>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 resort-img-mt">
                                <div class="resort-image">
                                    <img src="images/resort-1.jpg" alt="Camellia Resort" class="img-fluid">
                                    <div class="swipe-indicator">
                                        <span>Swipe</span>
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Capithans Dale -->
                    <div class="resort-panel" id="capithans">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6 order-2 order-lg-1 resort-content-mt">
                                <div class="resort-content">
                                    <h3>Capithans Dale - Munnar</h3>
                                    <span class="subtitle">A Boutique Mountain Retreat in Munnar</span>
                                    <p>Nestled among the lush tea plantations and misty hills of Munnar, Capithans Dale is a
                                        boutique mountain retreat designed for travelers seeking serenity and luxury. Wake
                                        up to panoramic views of the Western Ghats, unwind in elegantly crafted
                                        accommodations, and explore scenic trails, waterfalls, and nature-rich landscapes.
                                    </p>
                                    <a href="#" class="btn-custom btn-outline-custom">Explore Property</a>
                                </div>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 resort-img-mt">
                                <div class="resort-image">
                                    <img src="images/resort-2.jpg" alt="Capithans Dale" class="img-fluid">
                                    <div class="swipe-indicator">
                                        <span>Swipe</span>
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amber Paradise -->
                    <div class="resort-panel" id="amber">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6 order-2 order-lg-1 resort-content-mt">
                                <div class="resort-content">
                                    <h3>Amber Paradise - Vagamon</h3>
                                    <span class="subtitle">An Exclusive Hillside Retreat in Vagamon</span>
                                    <p>Perched on the rolling meadows of Vagamon, Amber Paradise is a boutique mountain
                                        retreat that offers panoramic views of the Western Ghats. With its infinity pool
                                        overlooking the valley, private cottages with floor-to-ceiling windows, and curated
                                        trekking experiences, this resort redefines hill-station luxury for the modern
                                        traveler.</p>
                                    <a href="#" class="btn-custom btn-outline-custom">Explore Property</a>
                                </div>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 resort-img-mt">
                                <div class="resort-image">
                                    <img src="images/resort-3.jpg" alt="Amber Paradise" class="img-fluid">
                                    <div class="swipe-indicator">
                                        <span>Swipe</span>
                                        <i class="bi bi-arrow-right-short"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    <section class="video-section">
        <div class="d-flex flex-column align-items-center">
            <div class="play-button reveal-scale" data-bs-toggle="modal" data-bs-target="#videoModal">
                <i class="bi bi-play-fill"></i>
            </div>
            <h3 class="reveal">An Invitation to a New World</h3>
        </div>


        <!-- Video Modal -->
        <div class="modal fade video-modal-blur" id="videoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-transparent border-0">

                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="modal-body p-0">
                        <video id="popupVideo" class="w-100 rounded-3" controls>
                            <source src="videos/CAMELLIA -32 (AD).mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- Offers Section -->
    <section class="offers-section section-space">
        <div class="container">

            <div class="d-flex flex-column align-items-center reveal">
                <div class="section-label">Special OFFERS</div>
                <h2 class="mb-3 text-center">Exclusive Packages & Seasonal Deals</h2>
                <p class="subhead max-910 text-center">
                    Discover special offers crafted to make your stay even more memorable.
                    Enjoy exclusive benefits, seasonal discounts and curated experiences
                    available for a limited time.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Offer 1 -->
                <div class="col-lg-6 reveal reveal-left">
                    <div class="offer-card mb-2">
                        <img src="images/book-1.jpg" class="img-fluid w-100" alt="Offer">
                        <a href="offers.php" class="btn-custom btn-custom-white">Book Now</a>
                    </div>
                </div>

                <!-- Offer 2 -->
                <div class="col-lg-6 reveal reveal-right">
                    <div class="offer-card mb-2">
                        <img src="images/book-2.jpg" class="img-fluid w-100" alt="Offer">
                        <a href="offers.php" class="btn-custom btn-custom-white">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="offers.php" class="btn-custom btn-outline-custom">Find More Offers</a>
            </div>

        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="gallery-header mb-5 reveal">

                <div class="section-label">Gallery Preview</div>
                <h2 class="mb-3">Moments Worth Remembering</h2>
                <p class="subhead max-910">
                    Explore stunning landscapes, luxurious accommodations and unforgettable experiences through our
                    collection of photographs showcasing the essence of Eterno Hotels & Resorts.
                </p>

            </div>
        </div>

        <div class="gallery-slider-wrapper reveal">
            <div class="gallery-track">
                <!-- Set 1 -->
                <div class="gallery-slide gallery-slide-tall">
                    <img src="images/gallery-2.jpg " alt="Gallery 1">
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
        </div>

        <div class="text-center mt-5">
            <a href="gallery.php" class="btn-custom btn-outline-custom">View Our Gallery</a>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-space">
        <div class=" container">
            <div class="text-center reveal d-flex flex-column align-items-center reveal">
                <div class="section-label">TESTIMONIALS</div>
                <h2 class="mb-3">Valuable words from our guests</h2>
                <p class="subhead max-910 text-center">
                    Every journey at Eterno is defined by exceptional hospitality, scenic beauty and personalized
                    experiences. Hear from guests who have discovered comfort, tranquility and unforgettable moments
                    amidst the stunning landscapes of Munnar and Vagamon.
                </p>
            </div>
        </div>

        <div class="testimonial-slider-wrapper reveal">
            <div class="testimonial-track">
                <!-- Column 1 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-green">Camellia & Elettaria</span>
                        <h5>"A Perfect Plantation Escape"</h5>
                        <p>"Staying at Camellia & Elettaria was an unforgettable experience. Waking up to mist-covered
                            plantations and enjoying the peaceful atmosphere made our Munnar trip truly special. The
                            hospitality was exceptional, and every detail felt thoughtfully curated."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-2.jpg" alt="Rakesh" class="author-img">
                            <span class="author-name">— Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-brown">Eterno Hospitality</span>
                        <h5>"Exceptional Hospitality"</h5>
                        <p>"What stood out the most was the warmth of the Eterno team. From check-in to departure, we
                            felt genuinely cared for. The staff went above and beyond to make our family vacation
                            comfortable and memorable."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-1.jpg" alt="Priya" class="author-img">
                            <span class="author-name">— Priya Nair & Family, Chennai</span>
                        </div>
                    </div>
                </div>
                <!-- Column 2 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-blue">Capithans Dale</span>
                        <h5>"The Best View in Munnar"</h5>
                        <p>"The panoramic mountain views from Capithans Dale are simply breathtaking. Every room feels
                            connected to nature, and the serene surroundings made it the perfect place to unwind. Highly
                            recommended for couples and nature lovers."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-4.jpg" alt="Rakesh" class="author-img">
                            <span class="author-name">— Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-green">Camellia & Elettaria</span>
                        <h5>"More Than Just a Stay"</h5>
                        <p>"The plantation walks, jeep safari, and campfire evenings created some of our favorite travel
                            memories. Eterno offers experiences that make you feel connected to the destination rather
                            than just staying at a hotel."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-2.jpg" alt="Rakesh" class="author-img">
                            <span class="author-name">— Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                </div>
                <!-- Column 3 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-blue">Capithans Dale</span>
                        <h5>"The Best View in Munnar"</h5>
                        <p>"The panoramic mountain views from Capithans Dale are simply breathtaking. Every room feels
                            connected to nature, and the serene surroundings made it the perfect place to unwind. Highly
                            recommended for couples and nature lovers."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-3.jpg" alt="Priya" class="author-img">
                            <span class="author-name">— Priya Nair & Family, Chennai</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-brown">Eterno Hospitality</span>
                        <h5>"Luxury Surrounded by Nature"</h5>
                        <p>"The panoramic mountain views from Capithans Dale are simply breathtaking. Every room feels
                            connected to nature, and the serene surroundings made it the perfect place to unwind. Highly
                            recommended for couples and nature lovers."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-4.jpg" alt="Guest" class="author-img">
                            <span class="author-name">Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                </div>
                <!-- Column 4 -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-brown">Eterno Hospitality</span>
                        <h5>"A Hidden Gem in the Hills"</h5>
                        <p>"Capithans Dale exceeded all our expectations. The treehouse experience was magical, and
                            waking up to birdsong and mountain mist was something we'll never forget. A truly unique
                            experience."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-2.jpg" alt="Rahul" class="author-img">
                            <span class="author-name">— Rahul Menon, Bangalore</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-blue">Capithans Dale</span>
                        <h5>"Heaven on Earth"</h5>
                        <p>"From the moment we arrived, we were captivated by the beauty of this place. The staff
                            treated us like family, and every meal was a culinary delight. We can't wait to return."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-1.jpg" alt="Anjali" class="author-img">
                            <span class="author-name">— Anjali Sharma, Mumbai</span>
                        </div>
                    </div>
                </div>

                <!-- Column 1 dup -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-green">Camellia & Elettaria</span>
                        <h5>"A Perfect Plantation Escape"</h5>
                        <p>"Staying at Camellia & Elettaria was an unforgettable experience. Waking up to mist-covered
                            plantations and enjoying the peaceful atmosphere made our Munnar trip truly special. The
                            hospitality was exceptional, and every detail felt thoughtfully curated."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-4.jpg" alt="Rakesh" class="author-img">
                            <span class="author-name">— Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-brown">Eterno Hospitality</span>
                        <h5>"Exceptional Hospitality"</h5>
                        <p>"What stood out the most was the warmth of the Eterno team. From check-in to departure, we
                            felt genuinely cared for. The staff went above and beyond to make our family vacation
                            comfortable and memorable."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-1.jpg" alt="Priya" class="author-img">
                            <span class="author-name">— Priya Nair & Family, Chennai</span>
                        </div>
                    </div>
                </div>
                <!-- Column 2 dup -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-blue">Capithans Dale</span>
                        <h5>"The Best View in Munnar"</h5>
                        <p>"The panoramic mountain views from Capithans Dale are simply breathtaking. Every room feels
                            connected to nature, and the serene surroundings made it the perfect place to unwind. Highly
                            recommended for couples and nature lovers."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-4.jpg" alt="Rakesh" class="author-img">
                            <span class="author-name">— Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-green">Camellia & Elettaria</span>
                        <h5>"More Than Just a Stay"</h5>
                        <p>"The plantation walks, jeep safari, and campfire evenings created some of our favorite travel
                            memories. Eterno offers experiences that make you feel connected to the destination rather
                            than just staying at a hotel."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-4.jpg" alt="Rakesh" class="author-img">
                            <span class="author-name">— Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                </div>
                <!-- Column 3 dup -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-blue">Capithans Dale</span>
                        <h5>"The Best View in Munnar"</h5>
                        <p>"The panoramic mountain views from Capithans Dale are simply breathtaking. Every room feels
                            connected to nature, and the serene surroundings made it the perfect place to unwind. Highly
                            recommended for couples and nature lovers."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-1.jpg" alt="Priya" class="author-img">
                            <span class="author-name">— Priya Nair & Family, Chennai</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-brown">Eterno Hospitality</span>
                        <h5>"Luxury Surrounded by Nature"</h5>
                        <p>"The panoramic mountain views from Capithans Dale are simply breathtaking. Every room feels
                            connected to nature, and the serene surroundings made it the perfect place to unwind. Highly
                            recommended for couples and nature lovers."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-2.jpg" alt="Guest" class="author-img">
                            <span class="author-name">Rakesh Menon, Kochi</span>
                        </div>
                    </div>
                </div>
                <!-- Column 4 dup -->
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <span class="testimonial-tag tag-brown">Eterno Hospitality</span>
                        <h5>"A Hidden Gem in the Hills"</h5>
                        <p>"Capithans Dale exceeded all our expectations. The treehouse experience was magical, and
                            waking up to birdsong and mountain mist was something we'll never forget. A truly unique
                            experience."</p>
                        <div class="testimonial-author">
                            <img src="images/testimonial-4.jpg" alt="Rahul" class="author-img">
                            <span class="author-name">— Rahul Menon, Bangalore</span>
                        </div>
                    </div>
                    <div class="testimonial-card testimonial-card-offset">
                        <span class="testimonial-tag tag-blue">Capithans Dale</span>
                        <h5>"Heaven on Earth"</h5>
                        <p>"From the moment we arrived, we were captivated by the beauty of this place. The staff
                            treated us like family, and every meal was a culinary delight. We can't wait to return."</p>
                        <div class="testimonial-author">
                            <img src="1" alt="Anjali" class="author-img">
                            <span class="author-name">— Anjali Sharma, Mumbai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
