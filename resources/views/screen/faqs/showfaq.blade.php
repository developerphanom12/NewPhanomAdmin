@extends('layouts.app')

@section('title', 'FAQ Details - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>FAQ Details</h1>
                            <p>View detailed information about this FAQ</p>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">FAQ Information</h4>
                        </div>
                        <div>
                            <a href="{{ route('faq.edit', $faq) }}" class="btn btn-primary">Edit FAQ</a>
                            <a href="{{ route('faq.index') }}" class="btn btn-light">Back to List</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"><strong>Question:</strong></label>
                                    <div class="p-3 bg-light rounded">{{ $faq->question }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label class="form-label"><strong>Answer:</strong></label>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label class="form-label"><strong>Category:</strong></label>
                                    <div class="p-3 bg-light rounded">{{ $faq->category ?? 'Uncategorized' }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label class="form-label"><strong>Display Order:</strong></label>
                                    <div class="p-3 bg-light rounded">{{ $faq->order }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label class="form-label"><strong>Status:</strong></label>
                                    <div class="p-3 bg-light rounded">
                                        <span class="badge bg-{{ $faq->is_active ? 'success' : 'danger' }}">
                                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label class="form-label"><strong>Created At:</strong></label>
                                    <div class="p-3 bg-light rounded">{{ $faq->created_at->format('F d, Y h:i A') }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label class="form-label"><strong>Last Updated:</strong></label>
                                    <div class="p-3 bg-light rounded">{{ $faq->updated_at->format('F d, Y h:i A') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 