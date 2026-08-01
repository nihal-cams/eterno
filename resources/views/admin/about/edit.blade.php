@extends('admin.layouts.app')

@section('title', 'About')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                About Page
            </h1>

        </div>

        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        Banner Section

                    </h6>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <label>Banner Title</label>

                            <input type="text" name="banner_title" class="form-control"
                                value="{{ old('banner_title', $about->banner_title) }}">

                        </div>

                        {{--  <div class="col-md-6">

                            <label>Banner Image</label>

                            <input type="file" name="banner_image" class="form-control">

                            @if ($about->banner_image)
                                <img src="{{ asset($about->banner_image) }}" width="150" class="mt-2 border">
                            @endif

                        </div>  --}}

                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Banner Image
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                    accept="image/*"
                                    onchange="
                document.getElementById('uploaded_banner_img').src =
                window.URL.createObjectURL(this.files[0]);

                document.getElementById('banner-image-label').innerHTML =
                this.files[0].name;
            ">

                                <label class="custom-file-label" id="banner-image-label" for="banner_image">
                                    {{ $about->banner_image ?: 'Choose file' }}
                                </label>

                            </div>

                            <img id="uploaded_banner_img"
                                src="{{ $about->banner_image ? asset($about->banner_image) : asset('img/upload_image.png') }}"
                                width="150" height="100" class="img-thumbnail">

                            @error('banner_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="col-md-12 mt-3">

                            <label>Description</label>

                            <textarea name="banner_description" rows="5" class="form-control">{{ old('banner_description', $about->banner_description) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        About Section

                    </h6>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <label>Title</label>

                            <input type="text" name="intro_title" class="form-control"
                                value="{{ old('intro_title', $about->intro_title) }}">

                        </div>

                        {{--  <div class="col-md-6">

                            <label>Image</label>

                            <input type="file" name="intro_image" class="form-control">

                            @if ($about->intro_image)
                                <img src="{{ asset($about->intro_image) }}" width="150" class="mt-2 border">
                            @endif

                        </div>  --}}

                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Intro Image
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="intro_image" name="intro_image"
                                    accept="image/*"
                                    onchange="
                                        document.getElementById('uploaded_intro_img').src =
                                        window.URL.createObjectURL(this.files[0]);

                                        document.getElementById('intro-image-label').innerHTML =
                                        this.files[0].name;
                                    ">

                                <label class="custom-file-label" id="intro-image-label" for="intro_image">
                                    {{ $about->intro_image ?: 'Choose file' }}
                                </label>

                            </div>

                            <img id="uploaded_intro_img"
                                src="{{ $about->intro_image ? asset($about->intro_image) : asset('img/upload_image.png') }}"
                                width="150" height="100" class="img-thumbnail">

                            @error('intro_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="col-md-12 mt-3">

                            <label>Description</label>

                            <textarea name="intro_description" rows="6" class="form-control">{{ old('intro_description', $about->intro_description) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        Call To Action

                    </h6>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <label>CTA Title</label>

                            <input type="text" name="cta_title" class="form-control"
                                value="{{ old('cta_title', $about->cta_title) }}">

                        </div>

                        <div class="col-md-6">

                            <label>Button Text</label>

                            <input type="text" name="cta_button_text" class="form-control"
                                value="{{ old('cta_button_text', $about->cta_button_text) }}">

                        </div>

                        <div class="col-md-6 mt-3">

                            <label>Button Link</label>

                            <input type="text" name="cta_button_link" class="form-control"
                                value="{{ old('cta_button_link', $about->cta_button_link) }}">

                        </div>
                        {{--
                        <div class="col-md-6 mt-3">

                            <label>Background Image</label>

                            <input type="file" name="cta_background_image" class="form-control">

                            @if ($about->cta_background_image)
                                <img src="{{ asset($about->cta_background_image) }}" width="150" class="mt-2 border">
                            @endif

                        </div>  --}}



                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    CTA Background Image
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="cta_background_image"
                                    name="cta_background_image" accept="image/*"
                                    onchange="
                                    document.getElementById('uploaded_cta_background_img').src =
                                    window.URL.createObjectURL(this.files[0]);

                                    document.getElementById('cta-background-image-label').innerHTML =
                                    this.files[0].name;
                                ">

                                <label class="custom-file-label" id="cta-background-image-label"
                                    for="cta_background_image">
                                    {{ $about->cta_background_image ?: 'Choose file' }}
                                </label>

                            </div>

                            <img id="uploaded_cta_background_img"
                                src="{{ $about->cta_background_image ? asset($about->cta_background_image) : asset('img/upload_image.png') }}"
                                width="150" height="100" class="img-thumbnail">

                            @error('cta_background_image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="col-md-12 mt-3">

                            <label>Description</label>

                            <textarea name="cta_description" rows="5" class="form-control">{{ old('cta_description', $about->cta_description) }}</textarea>

                        </div>

                        <div class="col-md-6 mt-3">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="active"
                                    {{ $about->status == \App\Enums\AboutStatus::ACTIVE ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive"
                                    {{ $about->status == \App\Enums\AboutStatus::INACTIVE ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-right">

                <button class="btn btn-primary">

                    <i class="fa fa-save"></i>

                    Update About

                </button>

            </div>

        </form>

    </div>

@endsection
@push('script')
    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('status-text').textContent =
                this.checked ? 'Active' : 'Inactive';
        });
    </script>
@endpush
