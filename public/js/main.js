document.addEventListener('DOMContentLoaded', () => {
    // ==========================
    // 1. Navbar & UI Interactions
    // ==========================
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        const navbarCollapse = document.getElementById('navbarNav');
        if (navbarCollapse) {
            navbarCollapse.addEventListener('show.bs.collapse', function () {
                navbar.classList.add('menu-open');
            });

            navbarCollapse.addEventListener('hide.bs.collapse', function () {
                navbar.classList.remove('menu-open');
            });
        }
    }

    // ==========================
    // 2. Scroll Reveal Animation
    // ==========================
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
    if (revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });
        revealElements.forEach(el => revealObserver.observe(el));
    }

    // ==========================
    // 3. Hero Slideshow
    // ==========================
    const heroSlides = document.querySelectorAll('.hero-slide');
    if (heroSlides.length > 0) {
        let currentSlide = 0;
        const slideInterval = 5000; // 5 seconds per slide

        function nextSlide() {
            heroSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.add('active');
        }
        setInterval(nextSlide, slideInterval);
    }

    // ==========================
    // 4. Book Now Modal
    // ==========================
    const bookBtn = document.getElementById('bookNowBtn');
    const bookModal = document.getElementById('bookModal');
    const bookModalClose = document.getElementById('bookModalClose');

    if (bookBtn && bookModal && bookModalClose) {
        bookBtn.addEventListener('click', function (e) {
            e.preventDefault();
            bookModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        bookModalClose.addEventListener('click', function () {
            bookModal.classList.remove('active');
            document.body.style.overflow = '';
        });

        bookModal.addEventListener('click', function (e) {
            if (e.target === bookModal) {
                bookModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // ==========================
    // 5. Advanced Resort Tabs & Scroll (GSAP)
    // ==========================
    const resortSection = document.querySelector('.resorts-section');
    const tabBar = document.querySelector('.resort-tabs');
    const resortTabs = document.querySelectorAll('.resort-tab');
    const resortPanels = document.querySelectorAll('.resort-panel');

    if (resortSection && resortTabs.length > 0 && resortPanels.length > 0) {
        const totalTabs = resortTabs.length;
        let currentIndex = 0;
        let stInstance = null;
        let programmaticTarget = null; // Fixed: declared variable to prevent implicit global

        function switchTab(index) {
            if (index < 0 || index >= totalTabs) return;

            resortTabs.forEach((tab, i) => {
                tab.classList.toggle("active", i === index);
            });

            resortPanels.forEach((panel, i) => {
                panel.classList.toggle("active", i === index);
            });

            currentIndex = index;
        }

        function initDesktopScroll() {
            if (window.innerWidth < 992) return;
            if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") return;

            gsap.registerPlugin(ScrollTrigger);

            stInstance = ScrollTrigger.create({
                trigger: resortSection,
                start: "top top",
                end: "+=" + ((totalTabs - 1) * 40) + "%",
                pin: true,
                scrub: 0,
                snap: {
                    snapTo: value => Math.round(value * (totalTabs - 1)) / (totalTabs - 1),
                    duration: { min: 0.15, max: 0.25 },
                    ease: "power1.inOut"
                },
                onUpdate(self) {
                    // Prevent intermediate tab switching during programmatic scroll
                    if (programmaticTarget !== null) return;

                    const index = Math.round(self.progress * (totalTabs - 1));
                    switchTab(index);
                }
            });

            resortTabs.forEach((tab, index) => {
                tab.addEventListener("click", function (e) {
                    e.preventDefault();

                    if (!stInstance) {
                        switchTab(index);
                        return;
                    }

                    programmaticTarget = index;
                    switchTab(index);

                    const progress = index / (totalTabs - 1);
                    const targetScroll = stInstance.start + ((stInstance.end - stInstance.start) * progress);

                    // Note: Requires GSAP ScrollToPlugin, or use gsap.to(window, { scrollTo: ... })
                    gsap.to(window, {
                        scrollTo: targetScroll,
                        duration: 0.5,
                        ease: "power2.out",
                        onComplete() {
                            programmaticTarget = null;
                        }
                    });
                });
            });
        }

        function initMobileSwipe() {
            let startX = 0;
            let startY = 0;

            resortSection.addEventListener("touchstart", function (e) {
                if (window.innerWidth >= 992) return;
                if (e.target.closest(".resort-tabs")) return;

                startX = e.changedTouches[0].clientX;
                startY = e.changedTouches[0].clientY;
            }, { passive: true });

            resortSection.addEventListener("touchend", function (e) {
                if (window.innerWidth >= 992) return;

                const endX = e.changedTouches[0].clientX;
                const endY = e.changedTouches[0].clientY;
                const dx = startX - endX;
                const dy = startY - endY;

                if (Math.abs(dx) < 50 || Math.abs(dx) < Math.abs(dy)) return;

                if (dx > 0) {
                    // Next tab (Loop)
                    let nextIndex = currentIndex + 1;
                    if (nextIndex >= totalTabs) nextIndex = 0;
                    switchTab(nextIndex);
                } else {
                    // Previous tab (Loop)
                    let prevIndex = currentIndex - 1;
                    if (prevIndex < 0) prevIndex = totalTabs - 1;
                    switchTab(prevIndex);
                }
            }, { passive: true });

            // Mobile Tab Click
            resortTabs.forEach((tab, index) => {
                tab.addEventListener("click", function () {
                    if (window.innerWidth >= 992) return;
                    switchTab(index);
                });
            });
        }

        function init() {
            if (stInstance) {
                stInstance.kill();
                stInstance = null;
            }
            switchTab(currentIndex);
            initDesktopScroll();
        }

        init();
        initMobileSwipe();

        window.addEventListener("resize", function () {
            init();
        });
    }


    // ==========================
    // 6. Home Page Gallery Slider
    // ==========================
    const galleryWrapper = document.querySelector('.gallery-slider-wrapper');
    const galleryTrack = document.querySelector('.gallery-track');

    if (galleryWrapper && galleryTrack) {
        let isDragging = false;
        let startX, dragStartPos;
        let currentPos = 0;
        let isAutoScrolling = true;
        const SPEED_PX_PER_SEC = 64;
        let lastTime = performance.now();
        let rafId;

        function getSetWidth() {
            return galleryTrack.scrollWidth / 2;
        }

        function loop(now) {
            if (isAutoScrolling && !isDragging) {
                const dt = (now - lastTime) / 1000;
                currentPos -= SPEED_PX_PER_SEC * dt;

                const setWidth = getSetWidth();
                while (currentPos <= -setWidth) currentPos += setWidth;
                while (currentPos > 0) currentPos -= setWidth;

                galleryTrack.style.transform = `translateX(${currentPos}px)`;
            }
            lastTime = now;
            rafId = requestAnimationFrame(loop);
        }

        rafId = requestAnimationFrame(loop);

        galleryWrapper.addEventListener('mousedown', (e) => {
            isDragging = true;
            isAutoScrolling = false;
            galleryWrapper.style.cursor = 'grabbing';
            startX = e.pageX;
            dragStartPos = currentPos;
        });

        galleryWrapper.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            currentPos = dragStartPos + (e.pageX - startX);
            galleryTrack.style.transform = `translateX(${currentPos}px)`;
        });

        function endDrag() {
            if (!isDragging) return;
            isDragging = false;
            galleryWrapper.style.cursor = 'grab';

            const setWidth = getSetWidth();
            while (currentPos <= -setWidth) currentPos += setWidth;
            while (currentPos > 0) currentPos -= setWidth;
            galleryTrack.style.transform = `translateX(${currentPos}px)`;

            isAutoScrolling = true;
        }

        galleryWrapper.addEventListener('mouseup', endDrag);
        galleryWrapper.addEventListener('mouseleave', endDrag);

        galleryWrapper.addEventListener('touchstart', (e) => {
            isDragging = true;
            isAutoScrolling = false;
            startX = e.touches[0].pageX;
            dragStartPos = currentPos;
        }, { passive: true });

        galleryWrapper.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            currentPos = dragStartPos + (e.touches[0].pageX - startX);
            galleryTrack.style.transform = `translateX(${currentPos}px)`;
        }, { passive: true });

        galleryWrapper.addEventListener('touchend', endDrag);
        galleryWrapper.addEventListener('touchcancel', endDrag);
    }

    // ==========================
    // 7. Home Page Testimonial Slider
    // ==========================
    const testimonialWrapper = document.querySelector('.testimonial-slider-wrapper');
    const testimonialTrack = document.querySelector('.testimonial-track');

    if (testimonialWrapper && testimonialTrack) {
        let isDragging = false;
        let startX, dragStartPos;
        let currentPos = 0;
        let lastTime = performance.now();
        let rafId;
        const SPEED_PX_PER_SEC = 42;
        let isPaused = false;

        function getSetWidth() {
            return testimonialTrack.scrollWidth / 2;
        }

        function loop(now) {
            if (!isDragging && !isPaused) {
                const dt = (now - lastTime) / 1000;
                currentPos -= SPEED_PX_PER_SEC * dt;

                const setWidth = getSetWidth();
                while (currentPos <= -setWidth) currentPos += setWidth;
                while (currentPos > 0) currentPos -= setWidth;

                testimonialTrack.style.transform = `translateX(${currentPos}px)`;
            }
            lastTime = now;
            rafId = requestAnimationFrame(loop);
        }

        rafId = requestAnimationFrame(loop);

        testimonialWrapper.addEventListener('mouseenter', () => {
            isPaused = false;
        });

        testimonialWrapper.addEventListener('mouseleave', () => {
            isPaused = false;
            lastTime = performance.now();
        });

        testimonialWrapper.addEventListener('mousedown', (e) => {
            isDragging = true;
            testimonialWrapper.style.cursor = 'grabbing';
            startX = e.pageX;
            dragStartPos = currentPos;
        });

        testimonialWrapper.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            currentPos = dragStartPos + (e.pageX - startX);
            testimonialTrack.style.transform = `translateX(${currentPos}px)`;
        });

        function endDrag() {
            if (!isDragging) return;
            isDragging = false;
            testimonialWrapper.style.cursor = 'grab';

            const setWidth = getSetWidth();
            while (currentPos <= -setWidth) currentPos += setWidth;
            while (currentPos > 0) currentPos -= setWidth;
            testimonialTrack.style.transform = `translateX(${currentPos}px)`;
        }

        testimonialWrapper.addEventListener('mouseup', endDrag);
        testimonialWrapper.addEventListener('mouseleave', () => {
            isPaused = false;
            endDrag();
        });

        testimonialWrapper.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].pageX;
            dragStartPos = currentPos;
        }, { passive: true });

        testimonialWrapper.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            currentPos = dragStartPos + (e.touches[0].pageX - startX);
            testimonialTrack.style.transform = `translateX(${currentPos}px)`;
        }, { passive: true });

        testimonialWrapper.addEventListener('touchend', endDrag);
        testimonialWrapper.addEventListener('touchcancel', endDrag);
    }

    // ==========================
    // 8. Video Modal
    // ==========================
    const videoModal = document.getElementById('videoModal');
    const popupVideo = document.getElementById('popupVideo');

    if (videoModal && popupVideo) {
        videoModal.addEventListener('shown.bs.modal', function () {
            popupVideo.play();
        });

        videoModal.addEventListener('hidden.bs.modal', function () {
            popupVideo.pause();
            popupVideo.currentTime = 0;
        });
    }

    // ==========================
    // 11. Accordion Logic
    // ==========================
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    if (accordionHeaders.length > 0) {
        accordionHeaders.forEach(header => {
            header.addEventListener('click', function () {
                const item = this.parentElement;
                const allItems = document.querySelectorAll('.accordion-item');
                const toggleIcon = this.querySelector('.accordion-toggle');

                allItems.forEach(acc => {
                    if (acc !== item) {
                        acc.classList.remove('active');
                        const otherToggle = acc.querySelector('.accordion-toggle');
                        if (otherToggle) otherToggle.textContent = '+';
                    }
                });

                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                    if (toggleIcon) toggleIcon.textContent = '+';
                } else {
                    item.classList.add('active');
                    if (toggleIcon) toggleIcon.textContent = '−';
                }
            });
        });
    }
// ==========================
// 12. Mega Menu Resort Preview
// ==========================
const megaItems = document.querySelectorAll(".mega-resort-list a");
const megaImage = document.getElementById("megaImage");
const megaTitle = document.getElementById("megaTitle");
const megaSubtitle = document.getElementById("megaSubtitle");
const megaDescription = document.getElementById("megaDescription");

if (
    megaItems.length &&
    megaImage &&
    megaTitle &&
    megaSubtitle &&
    megaDescription
) {
    megaItems.forEach(item => {
        item.addEventListener("mouseenter", function () {
            megaItems.forEach(link => link.classList.remove("active"));
            this.classList.add("active");

            megaImage.src = this.dataset.image || "";
            megaTitle.innerHTML = this.dataset.title || "";
            megaSubtitle.innerHTML = this.dataset.subtitle || "";
            megaDescription.innerHTML = this.dataset.description || "";
        });
    });
}

// Mobile Mega Menu Toggle
const megaTrigger = document.getElementById("megaTrigger");

if (megaTrigger) {
    megaTrigger.addEventListener("click", function (e) {
        if (window.innerWidth <= 991) {
            e.preventDefault();
            this.parentElement.classList.toggle("show");
        }
    });
}

    // ==========================
    // 13. Smooth Scrolling (Lenis)
    // ==========================
    if (typeof Lenis !== 'undefined') {
        const lenis = new Lenis({
            duration: 1.2,
            smoothWheel: true,
            wheelMultiplier: 0.9,
            touchMultiplier: 1.5,
            infinite: false
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    }
});