@extends('admin.layouts.app')

@section('title', 'Contact Page')

@section('content')

    <div class="container-fluid">

        <div class="card shadow mb-4">

            <div class="card-header">

                <h4 class="mb-0">
                    Contact Page
                </h4>

            </div>

            <div class="card-body">

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

                <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- ================= Banner ================= -->

                    <h5 class="mb-3">
                        Banner Section
                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Banner Title</label>

                                <input type="text" name="banner_title" class="form-control"
                                    value="{{ old('banner_title', $page->banner_title) }}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Banner Image</label>

                                <input type="file" name="banner_image" class="form-control">

                            </div>

                            @if ($page->banner_image)
                                <img src="{{ asset($page->banner_image) }}" width="180" class="img-thumbnail">
                            @endif

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Banner Description</label>

                                <textarea name="banner_description" rows="4" class="form-control">{{ old('banner_description', $page->banner_description) }}</textarea>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Intro ================= -->

                    <h5 class="mb-3">
                        Introduction Section
                    </h5>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Subtitle</label>

                                <input type="text" name="section_subtitle" class="form-control"
                                    value="{{ old('section_subtitle', $page->section_subtitle) }}">

                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">

                                <label>Title</label>

                                <input type="text" name="section_title" class="form-control"
                                    value="{{ old('section_title', $page->section_title) }}">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Description</label>

                                <textarea name="section_description" rows="5" class="form-control">{{ old('section_description', $page->section_description) }}</textarea>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Contact Form ================= -->

                    <h5 class="mb-3">
                        Contact Form Section
                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Form Title</label>

                                <input type="text" name="form_title" class="form-control"
                                    value="{{ old('form_title', $page->form_title) }}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Form Image</label>

                                <input type="file" name="form_image" class="form-control">

                            </div>

                            @if ($page->form_image)
                                <img src="{{ asset($page->form_image) }}" width="180" class="img-thumbnail">
                            @endif

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Form Description</label>

                                <textarea name="form_description" rows="4" class="form-control">{{ old('form_description', $page->form_description) }}</textarea>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Contact Info ================= -->

                    <h5 class="mb-3">
                        Contact Information
                    </h5>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Phone</label>

                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $page->phone) }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $page->email) }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Address</label>

                                <textarea name="address" rows="3" class="form-control">{{ old('address', $page->address) }}</textarea>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <!-- ================= Google Map ================= -->

                    <h5 class="mb-3">
                        Google Map
                    </h5>

                    <div class="form-group">

                        <label>Google Map Embed Code</label>

                        <textarea name="map_iframe" rows="6" class="form-control">{{ old('map_iframe', $page->map_iframe) }}</textarea>

                        <small class="text-muted">
                            Paste the Google Maps Embed iframe here.
                        </small>

                    </div>

                    <hr>

                    <button class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        Update Contact Page

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
