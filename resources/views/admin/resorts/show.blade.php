@extends('admin.layouts.app')
@section('title', 'View ' . 'Resort')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">View Resort</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Name:</div>
                <div class="col-md-9">{{ $resort->title }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Location:</div>
                <div class="col-md-9">{{ $resort->location }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Title:</div>
                <div class="col-md-9">{{ $resort->title }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Description:</div>
                <div class="col-md-9">
                    {!! nl2br(e($resort->description)) !!}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Image:</div>
                <div class="col-md-9">
                    @if($resort->image)
                        <img src="{{ asset('uploads/resorts/' . $resort->image) }}"
                            alt="{{ $resort->name }}"
                            class="img-thumbnail"
                            width="250">
                    @else
                        <span class="text-muted">No image available</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Button Text:</div>
                <div class="col-md-9">
                    {{ $resort->button_text }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Button URL:</div>
                <div class="col-md-9">
                    <a href="{{ $resort->button_url }}" target="_blank">
                        {{ $resort->button_url }}
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Status:</div>
                <div class="col-md-9">
                    @php
                        $class = match ($resort->status) {
                            \App\Enums\Status::ACTIVE => 'success',
                            \App\Enums\Status::INACTIVE => 'danger',
                        };
                    @endphp

                    <span class="badge badge-{{ $class }}">
                        {{ $resort->status->label() }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Created At:</div>
                <div class="col-md-9">{{ $resort->created_at->format('d M Y, h:i A') }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 font-weight-bold">Updated At:</div>
                <div class="col-md-9">{{ $resort->updated_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.resorts.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.resorts.edit', $resort) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection