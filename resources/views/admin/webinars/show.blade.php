@extends('admin.layouts.app')
@section('title', 'View ' . 'Webinar')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Webinar</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Title:</div>
                <div class="col-md-9">{{ $webinar->title }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Platform:</div>
                <div class="col-md-9">{{ $webinar->platform }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Date:</div>
                <div class="col-md-9">
                    {{ \Carbon\Carbon::parse($webinar->date)->format('d M Y') }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Time:</div>
                <div class="col-md-9">
                    {{ $webinar->time->format('h:i A') }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Duration:</div>
                <div class="col-md-9">{{ $webinar->duration }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Capacity:</div>
                <div class="col-md-9">{{ $webinar->capacity }} attendees</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Meeting Link:</div>
                <div class="col-md-9">
                    <a href="{{ $webinar->meeting_link }}" target="_blank">
                        {{ $webinar->meeting_link }}
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    <span class="badge
                        @switch($webinar->status->value)
                            @case('draft') badge-secondary @break
                            @case('scheduled') badge-primary @break
                            @case('registration_closed') badge-warning @break
                            @case('live') badge-success @break
                            @case('completed') badge-info @break
                            @case('cancelled') badge-danger @break
                        @endswitch">
                        {{ $webinar->status->label() }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $webinar->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $webinar->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.webinars.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.webinars.edit', $webinar) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection