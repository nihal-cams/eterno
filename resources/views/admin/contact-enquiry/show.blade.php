@extends('admin.layouts.app')

@section('title', 'Contact Message')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Contact Message Details
            </h1>

            <a href="{{ route('admin.contact-enquiry.index') }}" class="btn btn-secondary btn-sm">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>

                        <th width="20%">Name</th>

                        <td>{{ $contactMessage->name }}</td>

                    </tr>

                    <tr>

                        <th>Email</th>

                        <td>{{ $contactMessage->email }}</td>

                    </tr>

                    <tr>

                        <th>Phone</th>

                        <td>{{ $contactMessage->phone }}</td>

                    </tr>

                    <tr>

                        <th>Interested Resort</th>

                        <td>{{ $contactMessage->resort }}</td>

                    </tr>

                    <tr>

                        <th>Submitted On</th>

                        <td>{{ $contactMessage->created_at->format('d M Y h:i A') }}</td>

                    </tr>

                    <tr>

                        <th>Message</th>

                        <td>

                            {!! nl2br(e($contactMessage->message)) !!}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

@endsection
