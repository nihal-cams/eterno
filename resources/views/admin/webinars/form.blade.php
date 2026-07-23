@extends("admin.layouts.app")
@section('title', ($webinar->id ? 'Edit ' : 'Add ') . 'Webinar')
@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            {{ $webinar->id ? 'Edit ' : 'Add ' }} Webinar
        </h1>
        
        <form method="POST" action="{{ $webinar->id ? route('admin.webinars.update', $webinar) : route('admin.webinars.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $webinar->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <!-- <h3 class="font-size-lg text-dark font-weight-bold mb-3">Webinar</h3> -->
                <div class="row">

                    <div class="form-group col-6">
                        <label><strong>Title <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $webinar->title) }}">
                        @error("title")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label><strong>Platform <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="platform"
                            class="form-control"
                            placeholder="Zoom, Google Meet, Microsoft Teams"
                            value="{{ old('platform', $webinar->platform) }}">
                        @error('platform')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-3">
                        <label><strong>Date <span class="text-danger">*</span></strong></label>
                        <input type="date"
                            name="date"
                            class="form-control"
                            value="{{ old('date', $webinar->date ? $webinar->date->format('Y-m-d') : '') }}">
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-3">
                        <label><strong>Time <span class="text-danger">*</span></strong></label>
                        <input type="time"
                            name="time"
                            class="form-control"
                            value="{{ old('time', $webinar->time?->format('H:i')) }}">
                        @error('time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-3">
                        <label><strong>Duration <span class="text-danger">*</span></strong></label>
                        <input type="text"
                            name="duration"
                            class="form-control"
                            placeholder="30 minutes"
                            value="{{ old('duration', $webinar->duration) }}">
                        @error('duration')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-3">
                        <label><strong>Capacity (No. of attendees) <span class="text-danger">*</span></strong></label>
                        <input type="number"
                            name="capacity"
                            class="form-control"
                            value="{{ old('capacity', $webinar->capacity) }}">
                        @error('capacity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label><strong>Meeting Link <span class="text-danger">*</span></strong></label>
                        <input type="url"
                            name="meeting_link"
                            class="form-control"
                            placeholder="https://..."
                            value="{{ old('meeting_link', $webinar->meeting_link) }}">
                        @error('meeting_link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label><strong>Status <span class="text-danger">*</span></strong></label>
                        <select name="status" class="form-control">
                            @foreach(\App\Enums\WebinarStatus::cases() as $status)
                                <option value="{{ $status->value }}"
                                    {{ old('status', 
                                            $webinar->exists 
                                            ? $webinar->status?->value 
                                            : \App\Enums\WebinarStatus::SCHEDULED->value
                                        ) == $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-success mr-3">Save</button>
                    <a class="btn btn-secondary ml-3" href="{{ route('admin.webinars.index') }}">Cancel</a>
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
@endpush