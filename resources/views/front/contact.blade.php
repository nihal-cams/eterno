@extends('front.layouts.app')
@section('title', 'Contact Us | ')

@section('content')
    <!-- ========== HERO BANNER ========== -->
    <section class="hero-banner contact-banner"
        style="background-image:
        linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
        url('{{ $page?->banner_image ? asset($page->banner_image) : asset('images/contact-hero-bg.jpg') }}');">

        {{--  {{ dd($page) }}  --}}
        <div class="hero-inner-content px-2">
            <h1>{{ $page?->banner_title ?? 'Contact Usf' }}</h1>
            @if ($page?->banner_description)
                <p> {{ $page->banner_description }} </p>
            @endif
        </div>
        <div class="breadcrumb">
            <a href="/">Home</a><span>&rsaquo;</span>Contact
        </div>
    </section>

    <!-- contact section start here -->
    <div class="contact-section">
        <div class="container">
            <!-- Header -->
            <div class="contact-header">
                @if ($page?->section_subtitle)
                    <div class="section-label"> {{ $page->section_subtitle }} </div>
                @endif
                {{--  <div class="section-label">Let's Start Your Journey</div>  --}}

                @if ($page?->section_title)
                    <h3 class="subhead-v2"> {{ $page->section_title }} </h3>
                @endif
                @if ($page?->section_description)
                    <div class="subhead-v2"> {!! nl2br(e($page->section_description)) !!} </div>
                @endif

                {{--  <h3 class="subhead-v2">Warmth, care and attention to detail are at the heart of everything we do. We strive
                    to make every
                    guest feel welcomed, valued and at home.</h3>  --}}
            </div>

            <!-- Contact Form and Image -->
            <div class="contact-wrapper">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-7">
                        <div class="contact-image-wrapper">
                            {{--  <img src="images/contact-lft.jpg" class="img-fluid" alt="Resort in nature">  --}}

                            @if ($page?->form_image)
                                <img src="{{ asset($page->form_image) }}" class="img-fluid" alt="Contact Us">
                            @else
                                <img src="{{ asset('images/contact-lft.jpg') }}" class="img-fluid" alt="Contact Us">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="contact-form-section text-center">
                            <div class="section-label">Contact Us to Get More Details</div>
                            {{--  <h3>Let's Start Your Journey</h3>  --}}
                            {{--  <p class="subhead">Whether you're planning a relaxing getaway or simply have a question,
                                we're here to make
                                every step of your journey effortless.</p>  --}}

                            @if ($page?->form_title)
                                <div class="section-label"> {{ $page->form_title }} </div>
                            @endif
                            @if ($page?->form_description)
                                <p class="subhead"> {!! nl2br(e($page->form_description)) !!} </p>
                            @endif




                            {{--  <form id="contactForm" action="{{ route('contact.enquiry.store') }}" method="POST">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control-custom" placeholder="Your Name"
                                        value="{{ old('name') }}" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control-custom" placeholder="Email"
                                        value="{{ old('email') }}" required>
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-control-custom"
                                        placeholder="Phone Number" value="{{ old('phone') }}" required>
                                </div>

                                <!-- Resort -->
                                <div class="form-group">
                                    <select name="resort" class="form-control-custom" required>
                                        <option value="" disabled {{ old('resort') ? '' : 'selected' }}>
                                            Interested Resort
                                        </option>

                                        @foreach ($resorts as $resort)
                                            <option value="{{ $resort->name }}"
                                                {{ old('resort') == $resort->name ? 'selected' : '' }}>
                                                {{ $resort->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Message -->
                                <div class="form-group">
                                    <textarea name="message" class="form-control-custom" placeholder="Your Message" required>{{ old('message') }}</textarea>
                                </div>

                                <!-- Submit -->
                                <button type="submit" id="submitBtn" class="btn btn-primary-custom btn-custom w-100">
                                    <span id="submitText">Send Your Message</span>
                                    <span id="submitLoader" style="display: none;">
                                        Sending...
                                    </span>
                                </button>


                            </form>  --}}



                            <form id="contactForm" action="{{ route('contact.enquiry.store') }}" method="POST">
                                @csrf

                                {{-- Honeypot --}}
                                <div class="honeypot-field" aria-hidden="true">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" value="" tabindex="-1"
                                        autocomplete="off">
                                </div>

                                <!-- Name -->
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control-custom" placeholder="Your Name"
                                        value="{{ old('name') }}">

                                    <div class="field-error" data-error-for="name"></div>
                                </div>


                                <!-- Email -->
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control-custom" placeholder="Email"
                                        value="{{ old('email') }}">

                                    <div class="field-error" data-error-for="email"></div>
                                </div>


                                <!-- Phone -->
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control-custom"
                                        placeholder="Phone Number" value="{{ old('phone') }}">

                                    <div class="field-error" data-error-for="phone"></div>
                                </div>


                                <!-- Resort -->
                                <div class="form-group">
                                    <select name="resort" class="form-control-custom">
                                        <option value="" disabled {{ old('resort') ? '' : 'selected' }}>
                                            Interested Resort
                                        </option>

                                        @foreach ($resorts as $resort)
                                            <option value="{{ $resort->name }}"
                                                {{ old('resort') == $resort->name ? 'selected' : '' }}>
                                                {{ $resort->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="field-error" data-error-for="resort"></div>
                                </div>


                                <!-- Message -->
                                <div class="form-group">
                                    <textarea name="message" class="form-control-custom" placeholder="Your Message">{{ old('message') }}</textarea>

                                    <div class="field-error" data-error-for="message"></div>
                                </div>


                                <!-- Submit -->
                                <button type="submit" id="submitBtn" class="btn btn-primary-custom btn-custom w-100">
                                    <span id="submitText">Send Your Message</span>

                                    <span id="submitLoader" style="display: none;">
                                        Sending...
                                    </span>
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info-section">
                <div class="row">
                    <div class="col-md-4 contact-info-col">
                        <div class="contact-info-item">
                            <div class="contact-icon-btm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <h4>Call Us</h4>
                            {{--  <p><a href="tel:+914865285101">+91 48 65 285 101</a></p>  --}}

                            @if ($page?->phone)
                                <p> <a href="tel:{{ preg_replace('/\s+/', '', $page->phone) }}"> {{ $page->phone }} </a>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 contact-info-col">
                        <div class="contact-info-item">
                            <div class="contact-icon-btm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <h4>Address</h4>
                            {{--  <p>
                                Kavumkal Dream Destination Pvt. Ltd.<br>
                                LIG 2/208, Kinfra Building,<br>
                                Kani P.O., Pathanamthitta,<br>
                                Kerala, India - 689 672
                            </p>  --}}

                            @if ($page?->address)
                                <p> {!! nl2br(e($page->address)) !!} </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 contact-info-col">
                        <div class="contact-info-item">
                            <div class="contact-icon-btm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <h4>Email Us</h4>
                            {{--  <p><a href="mailto:sales@eternohotelsresorts.com">sales@eternohotelsresorts.com</a></p>  --}}

                            @if ($page?->email)
                                <p> <a href="mailto:{{ $page->email }}"> {{ $page->email }} </a> </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <div class="map-container">
                    <iframe src="{{ $page->map_iframe }}" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <style>
        .swal2-popup {
            font-family: inherit;
        }

        /*
                     * Honeypot:
                     * Invisible to normal users,
                     * but still available to bots that fill forms automatically.
                     */
        .honeypot-field {
            position: absolute !important;
            left: -9999px !important;
            top: -9999px !important;
            width: 1px !important;
            height: 1px !important;
            overflow: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /*
                     * Laravel validation messages
                     */
        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 6px;
            display: none;
        }

        .field-error.show {
            display: block;
        }

        .form-control-custom.input-error {
            border-color: #dc3545 !important;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('contactForm');

            if (!form) {
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoader = document.getElementById('submitLoader');



            /*
             * Remove all previous validation messages
             */
            function clearErrors() {

                document.querySelectorAll('.field-error').forEach(function(element) {
                    element.innerHTML = '';
                    element.classList.remove('show');
                });

                form.querySelectorAll('.input-error').forEach(function(element) {
                    element.classList.remove('input-error');
                });
            }


            /*
             * Show Laravel validation errors
             * directly underneath each field.
             */
            function showErrors(errors) {

                Object.keys(errors).forEach(function(field) {

                    const errorElement = document.querySelector(
                        '[data-error-for="' + field + '"]'
                    );

                    const inputElement = form.querySelector(
                        '[name="' + field + '"]'
                    );

                    if (errorElement && errors[field].length > 0) {

                        errorElement.textContent = errors[field][0];

                        errorElement.classList.add('show');
                    }

                    if (inputElement) {
                        inputElement.classList.add('input-error');
                    }
                });
            }


            /*
             * Remove error when user starts editing
             */
            form.querySelectorAll('input, select, textarea').forEach(function(field) {

                field.addEventListener('input', function() {

                    const fieldName = this.name;

                    const errorElement = document.querySelector(
                        '[data-error-for="' + fieldName + '"]'
                    );

                    if (errorElement) {
                        errorElement.innerHTML = '';
                        errorElement.classList.remove('show');
                    }

                    this.classList.remove('input-error');
                });


                field.addEventListener('change', function() {

                    const fieldName = this.name;

                    const errorElement = document.querySelector(
                        '[data-error-for="' + fieldName + '"]'
                    );

                    if (errorElement) {
                        errorElement.innerHTML = '';
                        errorElement.classList.remove('show');
                    }

                    this.classList.remove('input-error');
                });

            });


            /*
             * Form submit
             */
            form.addEventListener('submit', async function(e) {

                e.preventDefault();

                clearErrors();


                /*
                 * Check honeypot on frontend as well.
                 *
                 * If a bot fills username, don't submit.
                 */
                const honeypot = form.querySelector('[name="username"]');

                if (honeypot && honeypot.value.trim() !== '') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Unable to Submit',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonText: 'OK'
                    });

                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    submitLoader.style.display = 'none';

                    return;
                }


                /*
                 * Disable submit button
                 */
                submitBtn.disabled = true;

                submitText.style.display = 'none';
                submitLoader.style.display = 'inline';


                try {

                    const formData = new FormData(form);


                    const response = await fetch(form.action, {

                        method: 'POST',

                        body: formData,

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }

                    });


                    const data = await response.json();


                    /*
                     * SUCCESS
                     */
                    if (response.ok && data.success) {

                        await Swal.fire({

                            icon: 'success',

                            title: 'Thank You!',

                            text: data.message,

                            confirmButtonText: 'OK'

                        });

                        form.reset();

                        clearErrors();

                    }


                    /*
                     * VALIDATION ERROR
                     *
                     * No SweetAlert here.
                     *
                     * Errors will appear under
                     * the corresponding fields.
                     */
                    else if (response.status === 422) {

                        if (data.errors) {

                            showErrors(data.errors);

                        }

                    }


                    /*
                     * OTHER SERVER ERROR
                     */
                    else {

                        Swal.fire({

                            icon: 'error',

                            title: 'Oops!',

                            text: data.message ||
                                'Something went wrong. Please try again.',

                            confirmButtonText: 'OK'

                        });

                    }


                } catch (error) {

                    console.error('Contact form error:', error);


                    Swal.fire({

                        icon: 'error',

                        title: 'Something Went Wrong',

                        text: 'Unable to submit your enquiry. Please try again.',

                        confirmButtonText: 'OK'

                    });


                } finally {

                    submitBtn.disabled = false;

                    submitText.style.display = 'inline';

                    submitLoader.style.display = 'none';

                }

            });

        });
    </script>
@endpush

{{--  @push('styles')
    <style>
        .swal2-popup {
            font-family: inherit;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('contactForm');

            if (!form) {
                return;
            }

            form.addEventListener('submit', async function(e) {

                e.preventDefault();

                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submitText');
                const submitLoader = document.getElementById('submitLoader');

                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitLoader.style.display = 'inline';

                try {

                    const formData = new FormData(form);

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {

                        await Swal.fire({
                            icon: 'success',
                            title: 'Thank You!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });

                        form.reset();

                    } else if (response.status === 422) {

                        let errorMessages = '';

                        if (data.errors) {

                            Object.values(data.errors).forEach(function(messages) {

                                messages.forEach(function(message) {

                                    errorMessages +=
                                        '<div style="margin-bottom: 8px;">' +
                                        message +
                                        '</div>';

                                });

                            });
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorMessages,
                            confirmButtonText: 'OK'
                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message ||
                                'Something went wrong. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }

                } catch (error) {

                    console.error('Contact form error:', error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Something Went Wrong',
                        text: 'Unable to submit your enquiry. Please try again.',
                        confirmButtonText: 'OK'
                    });

                } finally {

                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    submitLoader.style.display = 'none';
                }

            });

        });
    </script>
@endpush  --}}
