@extends('admin.layouts.app')

@section('title', 'Experience Page ' . ($type == 1 ? '(Home Page)' : '(Inner Page)'))

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header">

                <h4>

                    Experience Page {{ $type == 1 ? '(Home Page)' : '(Inner Page)' }}

                </h4>

            </div>

            <div class="card-body">

                {{--  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif  --}}
                <form action="{{ route('admin.experiences.update', $type) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    @if ($type == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Experience Title <span class="text-danger">*</span></strong></label>
                                    <input type="text" name="banner_title" class="form-control"
                                        value="{{ old('banner_title', $experiencePage->banner_title) }}">
                                    @error('banner_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @else
                        <h5 class="mb-3">
                            Banner Section
                        </h5>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Banner Title <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="banner_title" class="form-control"
                                        value="{{ old('banner_title', $experiencePage->banner_title) }}">

                                    @error('banner_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                            <div class="form-group col-md-6">

                                <label>
                                    <strong>Banner Image</strong>
                                </label>

                                <div class="custom-file mb-3">

                                    <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                        accept="image/*"
                                        onchange="
                        document.getElementById('uploaded_img').src =
                        window.URL.createObjectURL(this.files[0]);

                        document.getElementById('banner-image-label').innerHTML =
                        this.files[0].name;
                    ">

                                    <label class="custom-file-label" id="banner-image-label" for="banner_image">
                                        {{ $experiencePage->banner_image ?: 'Choose file' }}
                                    </label>

                                </div>

                                <img id="uploaded_img"
                                    src="{{ $experiencePage->banner_image ? asset($experiencePage->banner_image) : asset('img/upload_image.png') }}"
                                    width="150" height="100" alt="Banner Image">

                                @error('banner_image')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Banner Description
                                    </label>

                                    <textarea name="banner_description" rows="4" class="form-control">{{ old('banner_description', $experiencePage->banner_description) }}</textarea>
                                    @error('banner_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    @endif

                    <hr>

                    <h5>

                        Introduction

                    </h5>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>

                                    Subtitle

                                </label>

                                <input type="text" name="intro_subtitle" class="form-control"
                                    value="{{ old('intro_subtitle', $experiencePage->intro_subtitle) }}">

                                @error('intro_subtitle')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">

                                <label>

                                    Title

                                </label>

                                <input type="text" name="intro_title" class="form-control"
                                    value="{{ old('intro_title', $experiencePage->intro_title) }}">

                                @error('intro_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>

                                    Description

                                </label>

                                <textarea name="intro_description" rows="5" class="form-control">{{ old('intro_description', $experiencePage->intro_description) }}</textarea>
                                @error('intro_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        @if ($type == 1)
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>

                                        Button Text

                                    </label>

                                    <input type="text" name="button_text" class="form-control"
                                        value="{{ old('button_text', $experiencePage->button_text) }}">

                                    @error('button_text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>

                                        Button URL

                                    </label>

                                    <input type="text" name="button_url" class="form-control"
                                        value="{{ old('button_url', $experiencePage->button_url) }}">

                                    @error('button_url')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>
                        @endif

                    </div>

                    <button class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        Update

                    </button>

                </form>

            </div>

        </div>

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

    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush
