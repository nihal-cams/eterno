@extends('admin.layouts.app')

@section('title', $experience->exists ? 'Edit Experience' : 'Add Experience')

@section('content')

    @use(App\Enums\ExperienceStatus)
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                {{ $experience->exists ? 'Edit Experience' : 'Add Experience' }}

            </h1>

            <a href="{{ route('admin.experience-items.index') }}" class="btn btn-secondary btn-sm">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card shadow mb-4">

            <div class="card-body">

                <form
                    action="{{ $experience->exists ? route('admin.experience-items.update', $experience) : route('admin.experience-items.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if ($experience->exists)
                        @method('PUT')
                    @endif

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Subtitle</label>

                                <input type="text" name="subtitle" class="form-control"
                                    value="{{ old('subtitle', $experience->subtitle) }}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Title <span class="text-danger">*</span></label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $experience->title) }}" required>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Description</label>

                        <textarea name="description" rows="5" class="form-control">{{ old('description', $experience->description) }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>

                            Experience List

                        </label>

                        <small class="text-muted d-block mb-2">

                            Enter one item per line.

                        </small>

                        <textarea name="experience_list" rows="6" class="form-control">{{ old('experience_list', $experience->experience_list) }}</textarea>

                    </div>

                    <div class="row">

                        {{--  <div class="col-md-6">

                            <div class="form-group">

                                <label>Image</label>

                                <input type="file" name="image" class="form-control">

                            </div>

                            @if ($experience->image)
                                <img src="{{ asset($experience->image) }}" class="img-thumbnail" width="150">
                            @endif

                        </div>  --}}


                        <div class="form-group col-md-6">

                            <label>
                                <strong>
                                    Image
                                    <span class="text-danger">*</span>
                                </strong>
                            </label>

                            <div class="custom-file mb-3">

                                <input type="file" class="custom-file-input" id="image" name="image"
                                    accept="image/*"
                                    onchange="
                document.getElementById('uploaded_img').src =
                window.URL.createObjectURL(this.files[0]);

                document.getElementById('image-label').innerHTML =
                this.files[0].name;
            ">

                                <label class="custom-file-label" id="image-label" for="image">
                                    {{ $experience->image ?: 'Choose file' }}
                                </label>

                            </div>

                            <img id="uploaded_img"
                                src="{{ $experience->image ? asset($experience->image) : asset('img/upload_image.png') }}"
                                width="150" height="150" class="img-thumbnail">

                            @error('image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Layout</label>

                                <select name="layout" class="form-control">

                                    <option value="left"
                                        {{ old('layout', $experience->layout) == 'left' ? 'selected' : '' }}>

                                        Left Image

                                    </option>

                                    <option value="right"
                                        {{ old('layout', $experience->layout) == 'right' ? 'selected' : '' }}>

                                        Right Image

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Sort Order</label>

                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $experience->sort_order ?? 0) }}">

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <label>
                                <strong>Status</strong>
                            </label>

                            {{-- Hidden value for Inactive --}}
                            <input type="hidden" name="status" value="{{ ExperienceStatus::INACTIVE->value }}">

                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                    value="{{ ExperienceStatus::ACTIVE->value }}"
                                    {{ old('status', $experience->status?->value ?? ExperienceStatus::ACTIVE->value) ==
                                    ExperienceStatus::ACTIVE->value
                                        ? 'checked'
                                        : '' }}>

                                <label class="custom-control-label" for="status">
                                    <span id="status-text">
                                        {{ old('status', $experience->status?->value ?? ExperienceStatus::ACTIVE->value) ==
                                        ExperienceStatus::ACTIVE->value
                                            ? 'Active'
                                            : 'Inactive' }}
                                    </span>
                                </label>

                            </div>

                        </div>

                        {{--  <div class="col-md-6">

                            <div class="form-group">

                                <label>Status</label>

                                <select name="status" class="form-control">

                                    <option value="active"
                                        {{ old('status', $experience->status?->value) == 'active' ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="inactive"
                                        {{ old('status', $experience->status?->value) == 'inactive' ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                        </div>  --}}

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        {{ $experience->exists ? 'Update Experience' : 'Save Experience' }}

                    </button>

                    <a href="{{ route('admin.experience-items.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

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
