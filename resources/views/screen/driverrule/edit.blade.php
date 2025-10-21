@extends('layouts.app')

@section('title', 'Edit Driver Rule - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Edit Driver Rule</h1>
                            <p>Update an existing rule for drivers to follow.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{asset('images/dashboard/top-header.png')}}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{asset('images/dashboard/top-header1.png')}}" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{asset('images/dashboard/top-header2.png')}}" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{asset('images/dashboard/top-header3.png')}}" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{asset('images/dashboard/top-header4.png')}}" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{asset('images/dashboard/top-header5.png')}}" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>

    <div class="container-fluid content-inner mt-n5 py-0">
        <div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit Driver Rule</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('driver-rules.update', $driverRule) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $driverRule->name) }}" required>
                                        <div class="form-text">Enter a clear and concise rule name</div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="6">{{ old('description', $driverRule->description) }}</textarea>
                                        <div class="form-text">Provide detailed information about this rule</div>
                                    </div>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_enabled" name="is_enabled" value="1" {{ $driverRule->is_enabled ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_enabled">
                                        Enable this rule
                                    </label>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update Rule</button>
                                    <a href="{{ route('driver-rules.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush 