```blade
@extends('admin.layouts.app')

@section('title', 'About')

@section('content')
    @use(App\Enums\AboutStatus)
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                About Page
            </h1>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        {{-- Main Form --}}
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">

            @csrf

            @method('PUT')

            {{-- =========================================================
                 BANNER SECTION
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Banner Section
                    </h6>

                </div>

                <div class="card-body">

                    <div class="row">
                        {{-- Banner Title --}}
                        <div class="col-md-6">

                            <label>
                                Banner Title
                            </label>

                            <input type="text" name="banner_title" class="form-control"
                                value="{{ old('banner_title', $about->banner_title) }}">
                            @error('banner_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Banner Image --}}
                        <div class="form-group col-md-6">
                            <label>
                                <strong>
                                    Banner Image
                                </strong>
                            </label>
                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                    accept="image/*">
                                <label class="custom-file-label" id="banner-image-label" for="banner_image">

                                    {{ $about->banner_image ? basename($about->banner_image) : 'Choose file' }}
                                </label>
                            </div>

                            <img id="uploaded_img"
                                src="{{ $about->banner_image ? asset($about->banner_image) : asset('img/upload_image.png') }}"
                                width="150" height="100" alt="Banner Image">


                            @error('banner_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Banner Description --}}
                        <div class="col-md-12 mt-3">

                            <label>
                                Description
                            </label>

                            <textarea name="banner_description" rows="5" class="form-control">{{ old('banner_description', $about->banner_description) }}</textarea>
                            @error('banner_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 ABOUT / INTRO SECTION
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        About Section
                    </h6>

                </div>


                <div class="card-body">
                    <div class="row">
                        {{-- Intro Title --}}
                        <div class="col-md-6">
                            <label>
                                Title
                            </label>
                            <input type="text" name="intro_title" class="form-control"
                                value="{{ old('intro_title', $about->intro_title) }}">

                            @error('intro_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>


                        {{-- Intro Image --}}
                        <div class="form-group col-md-6">
                            <label>
                                <strong>
                                    Intro Image
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="intro_image" name="intro_image"
                                    accept="image/*">

                                <label class="custom-file-label" id="intro-image-label" for="intro_image">
                                    {{ $about->intro_image ? basename($about->intro_image) : 'Choose file' }}
                                </label>

                            </div>


                            <img id="uploaded_img"
                                src="{{ $about->intro_image ? asset($about->intro_image) : asset('img/upload_image.png') }}"
                                width="150" height="100" alt="Intro Image">

                            @error('intro_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Intro Description --}}
                        <div class="col-md-12 mt-3">

                            <label>
                                Description
                            </label>

                            <textarea name="intro_description" rows="6" class="form-control">{{ old('intro_description', $about->intro_description) }}</textarea>
                            @error('intro_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

            </div>



            {{-- =========================================================
                 CALL TO ACTION SECTION
            ========================================================== --}}
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Call To Action
                    </h6>

                </div>


                <div class="card-body">

                    <div class="row">

                        {{-- CTA Title --}}
                        <div class="col-md-6">

                            <label>
                                CTA Title
                            </label>

                            <input type="text" name="cta_title" class="form-control"
                                value="{{ old('cta_title', $about->cta_title) }}">

                            @error('cta_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>


                        {{-- CTA Button Text --}}
                        <div class="col-md-6">

                            <label>
                                Button Text
                            </label>

                            <input type="text" name="cta_button_text" class="form-control"
                                value="{{ old('cta_button_text', $about->cta_button_text) }}">

                            @error('cta_button_text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>


                        {{-- CTA Button Link --}}
                        <div class="col-md-6 mt-3">

                            <label>
                                Button Link
                            </label>

                            <input type="text" name="cta_button_link" class="form-control"
                                value="{{ old('cta_button_link', $about->cta_button_link) }}">

                            @error('cta_button_link')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>


                        {{-- CTA Background Image --}}
                        <div class="form-group col-md-6 py-3">

                            <label>
                                <strong>
                                    CTA Background Image
                                </strong>
                            </label>


                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="cta_background_image"
                                    name="cta_background_image" accept="image/*">

                                <label class="custom-file-label" id="cta-background-image-label"
                                    for="cta_background_image">

                                    {{ $about->cta_background_image ? basename($about->cta_background_image) : 'Choose file' }}

                                </label>

                            </div>


                            <img id="uploaded_img"
                                src="{{ $about->cta_background_image ? asset($about->cta_background_image) : asset('img/upload_image.png') }}"
                                width="150" height="100" alt="CTA Background Image">


                            @error('cta_background_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- CTA Description --}}
                        <div class="col-md-12 mt-3">

                            <label>
                                Description
                            </label>

                            <textarea name="cta_description" rows="5" class="form-control">{{ old('cta_description', $about->cta_description) }}</textarea>
                            @error('cta_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- Status --}}
                        <div class="col-md-6 mt-3">

                            <div class="form-group">

                                <label>
                                    Status
                                </label>

                                <select name="status" class="form-control">

                                    <option value="{{ AboutStatus::ACTIVE->value }}"
                                        {{ old('status', $about->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::ACTIVE->value ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="{{ AboutStatus::INACTIVE->value }}"
                                        {{ old('status', $about->status?->value ?? AboutStatus::ACTIVE->value) == AboutStatus::INACTIVE->value ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                            </div>




                        </div>

                    </div>

                </div>



                {{-- =========================================================
                 UPDATE BUTTON
            ========================================================== --}}
                <div class="text-right mb-4">

                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-save"></i>
                        Update About

                    </button>

                </div>


        </form>

    </div>

@endsection





@push('style')
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('script')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>
    <script>
        // Banner Image
        $('#banner_image').on('change', function() {

            if (this.files && this.files[0]) {

                const file = this.files[0];

                const formGroup = $(this).closest('.form-group');

                formGroup.find('#uploaded_img')
                    .attr('src', URL.createObjectURL(file));

                formGroup.find('.custom-file-label')
                    .addClass('selected')
                    .html(file.name);
            }

        });


        // Intro Image
        $('#intro_image').on('change', function() {

            if (this.files && this.files[0]) {

                const file = this.files[0];

                const formGroup = $(this).closest('.form-group');

                formGroup.find('#uploaded_img')
                    .attr('src', URL.createObjectURL(file));

                formGroup.find('.custom-file-label')
                    .addClass('selected')
                    .html(file.name);
            }

        });


        // CTA Background Image
        $('#cta_background_image').on('change', function() {

            if (this.files && this.files[0]) {

                const file = this.files[0];

                const formGroup = $(this).closest('.form-group');

                formGroup.find('#uploaded_img')
                    .attr('src', URL.createObjectURL(file));

                formGroup.find('.custom-file-label')
                    .addClass('selected')
                    .html(file.name);
            }

        });




        $('.custom-file-input').on('change', function() {

            const fileName = $(this)
                .val()
                .split('\\')
                .pop();

            $(this)
                .siblings('.custom-file-label')
                .addClass('selected')
                .html(fileName);

        });
    </script>
@endpush
```
