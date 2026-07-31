@extends("admin.layouts.app")
@section('title', ($banner->id ? 'Edit ' : 'Add ') . 'Banner')
@section("content")

@use(App\Enums\Status)

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $banner->id ? 'Edit ' : 'Add ' }} Banner
        </h1>
        
        <form method="POST" action="{{ $banner->id ? route('admin.banners.update', $banner) : route('admin.banners.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $banner->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Banner</h3> -->
                <div class="row">

                    <div class="form-group col-md-6">
                        <label><strong>Title <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $banner->title) }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Description <span class="text-danger">*</span></strong></label>
                        <textarea name="description"
                                rows="3"
                                class="form-control">{{ old('description', $banner->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label><strong>Image (Recommended dimensions: 800 × 800 px) <span class="text-danger">*</strong></label>
                        <div class="custom-file mb-3">
                            <input type="file"
                                class="custom-file-input"
                                id="image"
                                name="image"
                                accept="image/*"
                                onchange="document.getElementById('uploaded_img').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="image">
                                {{ $banner->image ?: 'Choose file' }}
                            </label>
                        </div>
                        <img id="uploaded_img"
                            src="{{ $banner->image ? asset('uploads/banners/'.$banner->image) : asset('img/upload_image.png') }}">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label><strong>Status</strong></label>
                        <input type="hidden" name="status" value="{{ Status::INACTIVE->value }}">
                        <div class="custom-control custom-switch">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="status"
                                name="status"
                                value="{{ Status::ACTIVE->value }}"
                                {{ old('status', $banner->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'checked' : '' }}
                            >
                            <label class="custom-control-label" for="status">
                                <span id="status-text">
                                    {{ old('status', $banner->status?->value ?? Status::ACTIVE->value) == Status::ACTIVE->value ? 'Active' : 'Inactive' }}
                                </span>
                            </label>
                        </div>
                    </div>

                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-success mr-3">{{ $banner->id ? 'Update' : 'Save' }}</button>
                    <a class="btn btn-secondary ml-3" href="{{ route('admin.banners.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        
    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')

@endpush

@push('script')
    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        document.getElementById('status').addEventListener('change', function () {
            document.getElementById('status-text').textContent =
                this.checked ? 'Active' : 'Inactive';
        });
    </script>
@endpush