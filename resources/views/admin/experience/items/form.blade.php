@extends('admin.layouts.app')

@section('title', $experience->exists ? 'Edit Experience' : 'Add Experience')

@section('content')

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

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Image</label>

                                <input type="file" name="image" class="form-control">

                            </div>

                            @if ($experience->image)
                                <img src="{{ asset($experience->image) }}" class="img-thumbnail" width="150">
                            @endif

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Layout</label>

                                <select name="layout" class="form-control">

                                    <option value="left" {{ old('layout', $experience->layout) == 'left' ? 'selected' : '' }}>

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

                        <div class="col-md-6">

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

                        </div>

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
