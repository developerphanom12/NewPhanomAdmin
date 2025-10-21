@extends('layouts.app')

@section('title', 'View Banner - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>View Banner Details.</p>
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
                                <h4 class="card-title">Banner Details</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <p class="form-control-static">{{ $banner->title }}</p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Priority Order</label>
                                    <p class="form-control-static">{{ $banner->order }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <p class="form-control-static">
                                        @if($banner->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Created At</label>
                                    <p class="form-control-static">{{ $banner->created_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Banner Image</label>
                                    @if($banner->image_path)
                                        <div>
                                            <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner Image" class="img-fluid" style="max-height: 300px;">
                                        </div>
                                    @else
                                        <p class="text-muted">No image available</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <a href="{{ route('banner.edit', $banner) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('banner.index') }}" class="btn btn-light">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

@endsection 