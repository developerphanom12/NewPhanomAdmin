@extends('layouts.app')

@section('title', 'Create Tax - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>Create your Tax rule.</p>
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
                            <h4 class="card-title">Tax Details</h4>
                         </div>
                      </div>
                      <div class="card-body">
                         <form action="{{ route('taxes.store') }}" method="POST">
                            @csrf
                            <div class="row">
                               <div class="col-md-6 mb-3">
                                  <label class="form-label" for="tax_title">Tax Title</label>
                                  <input type="text" class="form-control @error('tax_title') is-invalid @enderror" 
                                         id="tax_title" name="tax_title" value="{{ old('tax_title') }}" required>
                                  @error('tax_title')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                               </div>
                               <div class="col-md-6 form-group mb-3">
                                <label class="form-label" for="country">Country</label>
                                <div class="form-group">
                                    <select class="form-select" id="country" name="country" required>
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country['code'] }}" {{ old('country') == $country['code'] ? 'selected' : '' }}>
                                                {{ $country['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                 </div>
                             </div>
                             <div class="col-md-6 form-group mb-3">
                                <label class="form-label" for="tax_type">Tax Type</label>
                                <div class="form-group">
                                    <select class="form-select @error('tax_type') is-invalid @enderror" 
                                            id="tax_type" name="tax_type" required>
                                       <option value="">Select Tax Type</option>
                                       <option value="fixed" {{ old('tax_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                       <option value="percentage" {{ old('tax_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                    @error('tax_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                 </div>
                             </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label" for="tax_amount">Tax Amount</label>
                                <input type="number" step="0.01" class="form-control @error('tax_amount') is-invalid @enderror" 
                                       id="tax_amount" name="tax_amount" value="{{ old('tax_amount') }}" required>
                                @error('tax_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                             </div>
                               <div class="col-md-6 form-group mb-3">
                                  <div class="checkbox mb-3">
                                     <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" 
                                               id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                          Enable
                                        </label>
                                     </div>
                                  </div>
                               </div>
                               
                               <div class="form-group">
                                  <button class="btn btn-primary" type="submit">Save</button>
                                  <a href="{{ route('taxes.index') }}" class="btn btn-secondary">Back</a>
                               </div>
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