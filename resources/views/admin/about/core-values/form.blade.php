@extends('admin.layouts.app')

@section('title', $coreValue->exists ? 'Edit Core Value' : 'Add Core Value')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">

                {{ $coreValue->exists ? 'Edit Core Value' : 'Add Core Value' }}

            </h1>

            <a href="{{ route('admin.core-values.index') }}" class="btn btn-secondary btn-sm">

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
                    action="{{ $coreValue->exists ? route('admin.core-values.update', $coreValue) : route('admin.core-values.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    @if ($coreValue->exists)
                        @method('PUT')
                    @endif


                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Title

                                </label>

                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $coreValue->title) }}" required>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Sort Order

                                </label>

                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $coreValue->sort_order ?? 0) }}">

                            </div>

                        </div>


                        <div class="col-md-12">

                            <div class="form-group">

                                <label>

                                    Description

                                </label>

                                <textarea name="description" rows="5" class="form-control">{{ old('description', $coreValue->description) }}</textarea>

                            </div>

                        </div>





                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Status

                                </label>

                                <select name="status" class="form-control">

                                    <option value="active"
                                        {{ old('status', $coreValue->status?->value) == 'active' ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="inactive"
                                        {{ old('status', $coreValue->status?->value) == 'inactive' ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    <hr>


                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-save"></i>

                        {{ $coreValue->exists ? 'Update' : 'Save' }}

                    </button>


                    <a href="{{ route('admin.core-values.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection
