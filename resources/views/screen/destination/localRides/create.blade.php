@extends('layouts.app')

@section('title', 'Dashboard - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>{{ isset($pricing) && !$isEdit ? 'View' : (isset($pricing) && $isEdit ? 'Edit' : 'Create') }} your Local Destination pricing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{ asset('images/dashboard/top-header.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('images/dashboard/top-header1.png') }}" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('images/dashboard/top-header2.png') }}" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('images/dashboard/top-header3.png') }}" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('images/dashboard/top-header4.png') }}" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('images/dashboard/top-header5.png') }}" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>

    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ isset($pricing) && !$isEdit ? 'View' : (isset($pricing) && $isEdit ? 'Edit' : 'Create') }} Local Destination Pricing</h4>
                </div>
                @if(isset($pricing) && !$isEdit)
                <div>
                    <a href="{{ route('local-rides.edit') }}" class="btn btn-primary">Edit Pricing</a>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ isset($pricing) && $isEdit ? route('local-rides.update') : route('local-rides.store') }}" method="POST">
                    @csrf
                    <!-- Moto -->
                    <h5 class="mt-4">BIKE :</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="basic_amount_moto">Basic Amount</label>
                            <input type="number" class="form-control" id="basic_amount_moto" name="basic_amount_moto" 
                                value="{{ old('basic_amount_moto', $pricing->basic_amount_moto ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('basic_amount_moto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="per_km_price_moto">Per KM Price</label>
                            <input type="text" class="form-control" id="per_km_price_moto" name="per_km_price_moto" 
                                value="{{ old('per_km_price_moto', $pricing->per_km_price_moto ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('per_km_price_moto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_shares_moto">Kabby Shares</label>
                            <select class="form-select" id="kabby_shares_moto" name="kabby_shares_moto" 
                                {{ isset($pricing) && !$isEdit ? 'disabled' : 'required' }}>
                                <option value="" disabled {{ old('kabby_shares_moto', $pricing->kabby_shares_moto ?? '') ? '' : 'selected' }}>Select kabby shares</option>
                                <option value="percentage" {{ old('kabby_shares_moto', $pricing->kabby_shares_moto ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ old('kabby_shares_moto', $pricing->kabby_shares_moto ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
                            @error('kabby_shares_moto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_amount_moto">Amount</label>
                            <input type="text" class="form-control" id="kabby_amount_moto" name="kabby_amount_moto" 
                                value="{{ old('kabby_amount_moto', $pricing->kabby_amount_moto ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('kabby_amount_moto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Mini -->
                    <h5 class="mt-4">ALTO / WAGON R :</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="basic_amount_mini">Basic Amount</label>
                            <input type="number" class="form-control" id="basic_amount_mini" name="basic_amount_mini" 
                                value="{{ old('basic_amount_mini', $pricing->basic_amount_mini ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('basic_amount_mini')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="per_km_price_mini">Per KM Price</label>
                            <input type="text" class="form-control" id="per_km_price_mini" name="per_km_price_mini" 
                                value="{{ old('per_km_price_mini', $pricing->per_km_price_mini ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('per_km_price_mini')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_shares_mini">Kabby Shares</label>
                            <select class="form-select" id="kabby_shares_mini" name="kabby_shares_mini" 
                                {{ isset($pricing) && !$isEdit ? 'disabled' : 'required' }}>
                                <option value="" disabled {{ old('kabby_shares_mini', $pricing->kabby_shares_mini ?? '') ? '' : 'selected' }}>Select kabby shares</option>
                                <option value="percentage" {{ old('kabby_shares_mini', $pricing->kabby_shares_mini ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ old('kabby_shares_mini', $pricing->kabby_shares_mini ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
                            @error('kabby_shares_mini')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_amount_mini">Amount</label>
                            <input type="text" class="form-control" id="kabby_amount_mini" name="kabby_amount_mini" 
                                value="{{ old('kabby_amount_mini', $pricing->kabby_amount_mini ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('kabby_amount_mini')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Sedan -->
                    <h5 class="mt-4">SEDAN :</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="basic_amount_sedan">Basic Amount</label>
                            <input type="number" class="form-control" id="basic_amount_sedan" name="basic_amount_sedan" 
                                value="{{ old('basic_amount_sedan', $pricing->basic_amount_sedan ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('basic_amount_sedan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="per_km_price_sedan">Per KM Price</label>
                            <input type="text" class="form-control" id="per_km_price_sedan" name="per_km_price_sedan" 
                                value="{{ old('per_km_price_sedan', $pricing->per_km_price_sedan ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('per_km_price_sedan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_shares_sedan">Kabby Shares</label>
                            <select class="form-select" id="kabby_shares_sedan" name="kabby_shares_sedan" 
                                {{ isset($pricing) && !$isEdit ? 'disabled' : 'required' }}>
                                <option value="" disabled {{ old('kabby_shares_sedan', $pricing->kabby_shares_sedan ?? '') ? '' : 'selected' }}>Select kabby shares</option>
                                <option value="percentage" {{ old('kabby_shares_sedan', $pricing->kabby_shares_sedan ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ old('kabby_shares_sedan', $pricing->kabby_shares_sedan ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
                            @error('kabby_shares_sedan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_amount_sedan">Amount</label>
                            <input type="text" class="form-control" id="kabby_amount_sedan" name="kabby_amount_sedan" 
                                value="{{ old('kabby_amount_sedan', $pricing->kabby_amount_sedan ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('kabby_amount_sedan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Ertiga -->
                    <h5 class="mt-4">ERTIGA :</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="basic_amount_ertiga">Basic Amount</label>
                            <input type="number" class="form-control" id="basic_amount_ertiga" name="basic_amount_ertiga" 
                                value="{{ old('basic_amount_ertiga', $pricing->basic_amount_ertiga ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('basic_amount_ertiga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mt-4">
                            <label for="per_km_price_ertiga">Per KM Price</label>
                            <input type="text" class="form-control" id="per_km_price_ertiga" name="per_km_price_ertiga" 
                                value="{{ old('per_km_price_ertiga', $pricing->per_km_price_ertiga ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('per_km_price_ertiga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_shares_ertiga">Kabby Shares</label>
                            <select class="form-select" id="kabby_shares_ertiga" name="kabby_shares_ertiga" 
                                {{ isset($pricing) && !$isEdit ? 'disabled' : 'required' }}>
                                <option value="" disabled {{ old('kabby_shares_ertiga', $pricing->kabby_shares_ertiga ?? '') ? '' : 'selected' }}>Select kabby shares</option>
                                <option value="percentage" {{ old('kabby_shares_ertiga', $pricing->kabby_shares_ertiga ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ old('kabby_shares_ertiga', $pricing->kabby_shares_ertiga ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
                            @error('kabby_shares_ertiga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabby_amount_ertiga">Amount</label>
                            <input type="text" class="form-control" id="kabby_amount_ertiga" name="kabby_amount_ertiga" 
                                value="{{ old('kabby_amount_ertiga', $pricing->kabby_amount_ertiga ?? '') }}" 
                                {{ isset($pricing) && !$isEdit ? 'readonly' : 'required' }}>
                            @error('kabby_amount_ertiga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if(!isset($pricing) || $isEdit)
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{ isset($pricing) ? 'Update' : 'Save' }}</button>
                        <a href="{{ route('dashboard') }}">
                            <button type="button" class="btn btn-light">Back</button>
                        </a>
                    </div>
                    @else
                    <div class="form-group">
                        <a href="{{ route('dashboard') }}">
                            <button type="button" class="btn btn-light">Back</button>
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@endsection