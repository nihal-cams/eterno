@extends('admin.layouts.app')

@section('title', 'Experience Page')

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header">

                <h4>

                    Experience Page

                </h4>

            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>
                @endif

                <form action="{{ route('admin.experiences.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    <h5 class="mb-3">

                        Banner Section

                    </h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Banner Title

                                </label>

                                <input type="text" name="banner_title" class="form-control"
                                    value="{{ old('banner_title', $experiencePage->banner_title) }}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Banner Image

                                </label>

                                <input type="file" name="banner_image" class="form-control">

                                @if ($experiencePage->banner_image)
                                    <img src="{{ asset($experiencePage->banner_image) }}" width="150"
                                        class="mt-2 img-thumbnail">
                                @endif

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>

                                    Banner Description

                                </label>

                                <textarea name="banner_description" rows="4" class="form-control">{{ old('banner_description', $experiencePage->banner_description) }}</textarea>

                            </div>

                        </div>

                    </div>

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

                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">

                                <label>

                                    Title

                                </label>

                                <input type="text" name="intro_title" class="form-control"
                                    value="{{ old('intro_title', $experiencePage->intro_title) }}">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>

                                    Description

                                </label>

                                <textarea name="intro_description" rows="5" class="form-control">{{ old('intro_description', $experiencePage->intro_description) }}</textarea>

                            </div>

                        </div>

                    </div>

                    <button class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        Update Experience Page

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
