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
                            <p>COD.</p>
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
</div>

<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">COD</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                        <div class="checkbox mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                        Enable COD
                                    </label>
                                    <label class="form-label" for="validationDefault01">Check it to enable COD payment method</label>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault03">Image</label>
                                    <input type="file" class="form-control" aria-label="file example" required>
                                    <label class="form-label" for="validationDefault03">Insert Payment Method Image</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save</button>
                                
                                    <button type="button" class="btn btn-light">Back</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>

@endsection