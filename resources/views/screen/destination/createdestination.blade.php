@extends('layouts.app')

@section('title', 'Create Destination - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>Create your Destination.</p>
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
                                <h4 class="card-title">Create Destination</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="destinationForm" method="POST" action="/destination/store" enctype="multipart/form-data">
                                @csrf
                                
                                @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                
                                <!-- Basic Information -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="boardingPoint">Boarding Point</label>
                                        <input type="text" class="form-control" id="boardingPoint" name="boarding_point" required>
                                        <div class="form-text">Enter the pickup location</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="destinationPoint">Destination Point</label>
                                        <input type="text" class="form-control" id="destinationPoint" name="destination_point" required>
                                        <div class="form-text">Enter the drop-off location</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="distance">Distance (KM)</label>
                                        <input type="number" class="form-control" id="distance" name="distance" min="0" step="0.1" required>
                                        <div class="form-text">Enter the distance in kilometers</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="destinationRange">Destination Range (KM)</label>
                                        <input type="text" class="form-control" id="destinationRange" name="destination_range" required placeholder="e.g. 250 - 300">
                                        <div class="form-text">Enter the distance range in format: min - max (e.g. 250 - 300)</div>
                                    </div>
                                </div>

                                <!-- Commission Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Commission from Drivers</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="commissionAlto">SEDAN</label>
                                                <input type="number" class="form-control commission-input" id="commissionAlto" name="commission_alto" min="0" required>
                                                <div class="form-text">Commission for SEDAN</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="commissionSedan">ERTIGA</label>
                                                <input type="number" class="form-control commission-input" id="commissionSedan" name="commission_sedan" min="0" required>
                                                <div class="form-text">Commission for ERTIGA</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="commissionErtiga">CRYSTA</label>
                                                <input type="number" class="form-control commission-input" id="commissionErtiga" name="commission_ertiga" min="0" required>
                                                <div class="form-text">Commission for CRYSTA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Minimum Booking Amount Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Booking Fee</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="minBookingAlto">SEDAN</label>
                                                <input type="number" class="form-control" id="minBookingAlto" name="min_booking_alto" min="0" step="0.01" required>
                                                <div class="form-text">Minimum booking amount for SEDAN</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="minBookingSedan">ERTIGA</label>
                                                <input type="number" class="form-control" id="minBookingSedan" name="min_booking_sedan" min="0" step="0.01" required>
                                                <div class="form-text">Minimum booking amount for ERTIGA</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="minBookingErtiga">CRYSTA</label>
                                                <input type="number" class="form-control" id="minBookingErtiga" name="min_booking_ertiga" min="0" step="0.01" required>
                                                <div class="form-text">Minimum booking amount for CRYSTA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Total Fare Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Total Fare</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="totalFareAlto">SEDAN</label>
                                                <input type="number" class="form-control total-fare-input" id="totalFareAlto" name="total_fare_alto" min="0" required>
                                                <div class="form-text">Total fare for SEDAN</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="totalFareSedan">ERTIGA</label>
                                                <input type="number" class="form-control total-fare-input" id="totalFareSedan" name="total_fare_sedan" min="0" required>
                                                <div class="form-text">Total fare for ERTIGA</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="totalFareErtiga">CRYSTA</label>
                                                <input type="number" class="form-control total-fare-input" id="totalFareErtiga" name="total_fare_ertiga" min="0" required>
                                                <div class="form-text">Total fare for CRYSTA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Driver Fare Section (Auto Calculated) -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Driver Fare (Auto Calculated)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="driverFareAlto">SEDAN</label>
                                                <input type="number" class="form-control" id="driverFareAlto" name="driver_fare_alto" readonly>
                                                <div class="form-text">Driver fare = Total fare - Minimum booking amount</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="driverFareSedan">ERTIGA</label>
                                                <input type="number" class="form-control" id="driverFareSedan" name="driver_fare_sedan" readonly>
                                                <div class="form-text">Driver fare = Total fare - Minimum booking amount</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="driverFareErtiga">CRYSTA</label>
                                                <input type="number" class="form-control" id="driverFareErtiga" name="driver_fare_ertiga" readonly>
                                                <div class="form-text">Driver fare = Total fare - Minimum booking amount</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                

                                <!-- Enable/Disable Switch -->
                                <div class="form-check form-switch mb-3">
                                    <input type="hidden" name="is_enabled" value="0">
                                    <input class="form-check-input" type="checkbox" id="isEnabled" name="is_enabled" value="1" checked>
                                    <label class="form-check-label" for="isEnabled">Enable this destination</label>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Save Destination</button>
                                    <a href="{{ route('screen.destination.destinations') }}" class="btn btn-secondary">Cancel</a>
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
<script>
    // Function to calculate driver fare (total fare - minimum booking amount)
    function calculateDriverFare(vehicleType) {
        const totalFareElem = document.getElementById('totalFare' + vehicleType);
        const minBookingElem = document.getElementById('minBooking' + vehicleType);
        const driverFareElem = document.getElementById('driverFare' + vehicleType);
        
        if (!totalFareElem || !minBookingElem || !driverFareElem) return;
        
        const totalFare = parseFloat(totalFareElem.value) || 0;
        const minBooking = parseFloat(minBookingElem.value) || 0;
        
        // Calculate driver fare
        const driverFare = Math.max(0, totalFare - minBooking);
        
        // Update the driver fare field
        driverFareElem.value = driverFare.toFixed(2);
    }

    // Initialize calculations when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM content loaded');
        const vehicleTypes = ['Alto', 'Sedan', 'Ertiga'];
        
        // Add change event listeners to total fare and min booking fields
        vehicleTypes.forEach(function(vehicleType) {
            const totalFareField = document.getElementById('totalFare' + vehicleType);
            const minBookingField = document.getElementById('minBooking' + vehicleType);
            
            if (totalFareField) {
                totalFareField.addEventListener('input', function() {
                    calculateDriverFare(vehicleType);
                });
            }
            
            if (minBookingField) {
                minBookingField.addEventListener('input', function() {
                    calculateDriverFare(vehicleType);
                });
            }
            
            // Initial calculation
            calculateDriverFare(vehicleType);
        });
        
        // Add validation for the destination range field but don't prevent submission
        const destinationForm = document.getElementById('destinationForm');
        const rangeField = document.getElementById('destinationRange');
        
        if (destinationForm && rangeField) {
            console.log('Form and range field found');
            
            // Replace the old event handler with a new one
            destinationForm.addEventListener('submit', function(event) {
                const rangeValue = rangeField.value.trim();
                const rangePattern = /^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/;
                
                console.log('Form submission attempt');
                
                // Validate the format but do not prevent submission
                if (!rangePattern.test(rangeValue)) {
                    console.log('Range format validation failed');
                } else {
                    // Extract min and max values for additional validation
                    const matches = rangeValue.match(rangePattern);
                    const minValue = parseFloat(matches[1]);
                    const maxValue = parseFloat(matches[2]);
                    
                    if (minValue >= maxValue) {
                        console.log('Range min-max validation failed');
                    } else {
                        console.log('Range validation passed');
                    }
                }
                
                console.log('Form will be submitted');
                return true;
            });
        }
    });
</script>
@endpush