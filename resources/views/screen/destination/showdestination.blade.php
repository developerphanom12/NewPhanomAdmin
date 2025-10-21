@extends('layouts.app')

@section('title', 'Destination Details - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Destination Details</h1>
                            <p>{{ $destination->boarding_point }} to {{ $destination->destination_point }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('screen.destination.destinations') }}" class="btn btn-outline-white me-2">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                            <a href="{{ route('screen.destination.edit', $destination->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
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
        <!-- Key Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-route fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Distance</h6>
                                <h3 class="text-white mb-0">{{ $destination->distance }} KM</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white {{ $destination->is_enabled ? 'bg-success' : 'bg-danger' }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-toggle-on fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Status</h6>
                                <h3 class="text-white mb-0">{{ $destination->is_enabled ? 'Active' : 'Inactive' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">Range</h6>
                                <h3 class="text-white mb-0">{{ $destination->destination_range }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-hashtag fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-white mb-0">ID</h6>
                                <h3 class="text-white mb-0">#{{ $destination->id }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Basic Information Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Basic Information</h4>
                <span class="badge bg-primary rounded-pill">
                    <i class="fas fa-map-marker-alt me-1"></i> Route Details
                </span>
            </div>
            <div class="card-body">
                <div class="route-visual p-4 bg-soft-primary text-center mb-4">
                    <div class="d-flex align-items-center justify-content-between route-line">
                        <div class="location-point start">
                            <i class="fas fa-map-marker-alt text-primary fa-2x mb-2"></i>
                            <h5>{{ $destination->boarding_point }}</h5>
                            <div class="text-muted small">Boarding Point</div>
                        </div>
                        <div class="route-distance">
                            <span class="distance-badge">{{ $destination->distance }} KM</span>
                        </div>
                        <div class="location-point end">
                            <i class="fas fa-flag-checkered text-success fa-2x mb-2"></i>
                            <h5>{{ $destination->destination_point }}</h5>
                            <div class="text-muted small">Destination Point</div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%" class="text-muted">Route ID</td>
                                <td class="fw-bold">{{ $destination->id }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Boarding Point</td>
                                <td class="fw-bold">{{ $destination->boarding_point }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Destination Point</td>
                                <td class="fw-bold">{{ $destination->destination_point }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%" class="text-muted">Distance</td>
                                <td class="fw-bold">{{ $destination->distance }} KM</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Range</td>
                                <td class="fw-bold">{{ $destination->destination_range }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td>
                                    @if($destination->is_enabled)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%" class="text-muted">Created At</td>
                                <td>{{ $destination->created_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%" class="text-muted">Last Updated</td>
                                <td>{{ $destination->updated_at->format('M d, Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ALTO/WAGON R Details -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-soft-primary">
                <h4 class="card-title mb-0"><i class="fas fa-car me-2"></i>SEDAN Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-primary border-3">
                            <div class="text-muted mb-2">Commission</div>
                            <h3 class="text-primary mb-0">₹{{ $destination->commission_alto }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-info border-3">
                            <div class="text-muted mb-2">Minimum Booking</div>
                            <h3 class="text-info mb-0">₹{{ $destination->min_booking_alto }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-success border-3">
                            <div class="text-muted mb-2">Net Profit</div>
                            <h3 class="text-success mb-0">₹{{ $destination->min_booking_alto + $destination->commission_alto }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-warning border-3">
                            <div class="text-muted mb-2">Total Fare</div>
                            <h3 class="text-warning mb-0">₹{{ $destination->total_fare_alto }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-danger border-3">
                            <div class="text-muted mb-2">Driver Fare</div>
                            <h3 class="text-danger mb-0">₹{{ $destination->driver_fare_alto }}</h3>
                        </div>
                    </div>
                </div>
                
                <!-- Revenue Distribution -->
                <div class="mt-4">
                    <h5 class="border-bottom pb-2">Revenue Distribution</h5>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Driver's Share:</span>
                                <span class="fw-bold">{{ $destination->total_fare_alto > 0 ? number_format($destination->driver_fare_alto / $destination->total_fare_alto * 100, 2) : 0 }}%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Company's Share:</span>
                                <span class="fw-bold">{{ $destination->total_fare_alto > 0 ? number_format(($destination->min_booking_alto + $destination->commission_alto) / $destination->total_fare_alto * 100, 2) : 0 }}%</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="progress-container">
                                @php
                                    $driverPercentage = $destination->total_fare_alto > 0 ? ($destination->driver_fare_alto / $destination->total_fare_alto * 100) : 0;
                                    $companyPercentage = 100 - $driverPercentage;
                                @endphp
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $driverPercentage }}%;" aria-valuenow="{{ $driverPercentage }}" aria-valuemin="0" aria-valuemax="100">Driver {{ number_format($driverPercentage, 0) }}%</div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $companyPercentage }}%;" aria-valuenow="{{ $companyPercentage }}" aria-valuemin="0" aria-valuemax="100">Company {{ number_format($companyPercentage, 0) }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ERTIGA Details -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-soft-info">
                <h4 class="card-title mb-0"><i class="fas fa-car me-2"></i>ERTIGA Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-primary border-3">
                            <div class="text-muted mb-2">Commission</div>
                            <h3 class="text-primary mb-0">₹{{ $destination->commission_sedan }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-info border-3">
                            <div class="text-muted mb-2">Minimum Booking</div>
                            <h3 class="text-info mb-0">₹{{ $destination->min_booking_sedan }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-success border-3">
                            <div class="text-muted mb-2">Net Profit</div>
                            <h3 class="text-success mb-0">₹{{ $destination->min_booking_sedan + $destination->commission_sedan }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-warning border-3">
                            <div class="text-muted mb-2">Total Fare</div>
                            <h3 class="text-warning mb-0">₹{{ $destination->total_fare_sedan }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-danger border-3">
                            <div class="text-muted mb-2">Driver Fare</div>
                            <h3 class="text-danger mb-0">₹{{ $destination->driver_fare_sedan }}</h3>
                        </div>
                    </div>
                </div>
                
                <!-- Revenue Distribution -->
                <div class="mt-4">
                    <h5 class="border-bottom pb-2">Revenue Distribution</h5>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Driver's Share:</span>
                                <span class="fw-bold">{{ $destination->total_fare_sedan > 0 ? number_format($destination->driver_fare_sedan / $destination->total_fare_sedan * 100, 2) : 0 }}%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Company's Share:</span>
                                <span class="fw-bold">{{ $destination->total_fare_sedan > 0 ? number_format(($destination->min_booking_sedan + $destination->commission_sedan) / $destination->total_fare_sedan * 100, 2) : 0 }}%</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="progress-container">
                                @php
                                    $driverPercentage = $destination->total_fare_sedan > 0 ? ($destination->driver_fare_sedan / $destination->total_fare_sedan * 100) : 0;
                                    $companyPercentage = 100 - $driverPercentage;
                                @endphp
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $driverPercentage }}%;" aria-valuenow="{{ $driverPercentage }}" aria-valuemin="0" aria-valuemax="100">Driver {{ number_format($driverPercentage, 0) }}%</div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $companyPercentage }}%;" aria-valuenow="{{ $companyPercentage }}" aria-valuemin="0" aria-valuemax="100">Company {{ number_format($companyPercentage, 0) }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CRYSTA Details -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-soft-success">
                <h4 class="card-title mb-0"><i class="fas fa-shuttle-van me-2"></i>CRYSTA Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-primary border-3">
                            <div class="text-muted mb-2">Commission</div>
                            <h3 class="text-primary mb-0">₹{{ $destination->commission_ertiga }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-info border-3">
                            <div class="text-muted mb-2">Minimum Booking</div>
                            <h3 class="text-info mb-0">₹{{ $destination->min_booking_ertiga }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-success border-3">
                            <div class="text-muted mb-2">Net Profit</div>
                            <h3 class="text-success mb-0">₹{{ $destination->min_booking_ertiga + $destination->commission_ertiga }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-warning border-3">
                            <div class="text-muted mb-2">Total Fare</div>
                            <h3 class="text-warning mb-0">₹{{ $destination->total_fare_ertiga }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="data-card bg-light p-3 text-center border-start border-danger border-3">
                            <div class="text-muted mb-2">Driver Fare</div>
                            <h3 class="text-danger mb-0">₹{{ $destination->driver_fare_ertiga }}</h3>
                        </div>
                    </div>
                </div>
                
                <!-- Revenue Distribution -->
                <div class="mt-4">
                    <h5 class="border-bottom pb-2">Revenue Distribution</h5>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Driver's Share:</span>
                                <span class="fw-bold">{{ $destination->total_fare_ertiga > 0 ? number_format($destination->driver_fare_ertiga / $destination->total_fare_ertiga * 100, 2) : 0 }}%</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Company's Share:</span>
                                <span class="fw-bold">{{ $destination->total_fare_ertiga > 0 ? number_format(($destination->min_booking_ertiga + $destination->commission_ertiga) / $destination->total_fare_ertiga * 100, 2) : 0 }}%</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="progress-container">
                                @php
                                    $driverPercentage = $destination->total_fare_ertiga > 0 ? ($destination->driver_fare_ertiga / $destination->total_fare_ertiga * 100) : 0;
                                    $companyPercentage = 100 - $driverPercentage;
                                @endphp
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $driverPercentage }}%;" aria-valuenow="{{ $driverPercentage }}" aria-valuemin="0" aria-valuemax="100">Driver {{ number_format($driverPercentage, 0) }}%</div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $companyPercentage }}%;" aria-valuenow="{{ $companyPercentage }}" aria-valuemin="0" aria-valuemax="100">Company {{ number_format($companyPercentage, 0) }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions Card -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <a href="{{ route('screen.destination.edit', $destination->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Edit Destination
                    </a>
                    <form action="{{ route('screen.destination.destroy', $destination->id) }}" method="POST" class="d-inline-block ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this destination?')">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </form>
                </div>
                <a href="{{ route('screen.destination.destinations') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Add custom CSS for improved UI */
    .data-card {
        border-radius: 8px;
        transition: transform 0.3s;
    }
    .data-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .route-visual {
        border-radius: 10px;
        position: relative;
    }
    .route-line {
        position: relative;
    }
    .route-line::after {
        content: '';
        position: absolute;
        top: 30px;
        left: 50px;
        right: 50px;
        height: 4px;
        background: linear-gradient(to right, #3a57e8, #4caf50);
        z-index: 1;
    }
    .location-point {
        position: relative;
        z-index: 2;
        padding: 10px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        width: 120px;
    }
    .distance-badge {
        background-color: #3a57e8;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 600;
        z-index: 2;
        position: relative;
    }
    .bg-soft-primary {
        background-color: rgba(58, 87, 232, 0.1);
    }
    .bg-soft-info {
        background-color: rgba(13, 202, 240, 0.1);
    }
    .bg-soft-success {
        background-color: rgba(25, 135, 84, 0.1);
    }
    
    /* Progress bar styling */
    .progress {
        overflow: visible;
        margin-bottom: 26px;
        border-radius: 5px;
    }
    .progress-bar {
        position: relative;
        text-align: center;
        line-height: 30px;
        font-weight: 600;
    }
</style>
@endpush 