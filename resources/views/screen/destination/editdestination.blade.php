@extends('layouts.app')

@section('title', 'Edit Destination - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>Edit your Destination.</p>
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
                                <h4 class="card-title">Edit Destination</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="destinationForm" method="POST" action="{{ route('screen.destination.update', $destination->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Basic Information -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="boardingPoint">Boarding Point</label>
                                        <input type="text" class="form-control" id="boardingPoint" name="boarding_point" value="{{ $destination->boarding_point }}" required>
                                        <div class="form-text">Enter the pickup location</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="destinationPoint">Destination Point</label>
                                        <input type="text" class="form-control" id="destinationPoint" name="destination_point" value="{{ $destination->destination_point }}" required>
                                        <div class="form-text">Enter the drop-off location</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="distance">Distance (KM)</label>
                                        <input type="number" class="form-control" id="distance" name="distance" min="0" step="0.1" value="{{ $destination->distance }}" required>
                                        <div class="form-text">Enter the distance in kilometers</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="destinationRange">Destination Range (KM)</label>
                                        <input type="text" class="form-control" id="destinationRange" name="destination_range" value="{{ $destination->destination_range }}" required placeholder="e.g. 250 - 300">
                                        <div class="form-text">Enter the distance range in format: min - max (e.g. 250 - 300)</div>
                                    </div>
                                </div>

                                <!-- Commission -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Commission</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="commissionAlto">ALTO/WAGON R</label>
                                                <input type="number" class="form-control" id="commissionAlto" name="commission_alto" min="0" step="0.01" value="{{ $destination->commission_alto }}" required>
                                                <div class="form-text">Commission amount for ALTO/WAGON R</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="commissionSedan">SEDAN</label>
                                                <input type="number" class="form-control" id="commissionSedan" name="commission_sedan" min="0" step="0.01" value="{{ $destination->commission_sedan }}" required>
                                                <div class="form-text">Commission amount for SEDAN</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="commissionErtiga">ERTIGA</label>
                                                <input type="number" class="form-control" id="commissionErtiga" name="commission_ertiga" min="0" step="0.01" value="{{ $destination->commission_ertiga }}" required>
                                                <div class="form-text">Commission amount for ERTIGA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Fare -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Total Fare</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="totalFareAlto">ALTO/WAGON R</label>
                                                <input type="number" class="form-control" id="totalFareAlto" name="total_fare_alto" min="0" step="0.01" value="{{ $destination->total_fare_alto }}" required>
                                                <div class="form-text">Total fare for ALTO/WAGON R</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="totalFareSedan">SEDAN</label>
                                                <input type="number" class="form-control" id="totalFareSedan" name="total_fare_sedan" min="0" step="0.01" value="{{ $destination->total_fare_sedan }}" required>
                                                <div class="form-text">Total fare for SEDAN</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="totalFareErtiga">ERTIGA</label>
                                                <input type="number" class="form-control" id="totalFareErtiga" name="total_fare_ertiga" min="0" step="0.01" value="{{ $destination->total_fare_ertiga }}" required>
                                                <div class="form-text">Total fare for ERTIGA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Minimum Booking Amount -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Minimum Booking Amount</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="minBookingAlto">ALTO/WAGON R</label>
                                                <input type="number" class="form-control" id="minBookingAlto" name="min_booking_alto" min="0" step="0.01" value="{{ $destination->min_booking_alto }}" required>
                                                <div class="form-text">Minimum booking amount for ALTO/WAGON R</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="minBookingSedan">SEDAN</label>
                                                <input type="number" class="form-control" id="minBookingSedan" name="min_booking_sedan" min="0" step="0.01" value="{{ $destination->min_booking_sedan }}" required>
                                                <div class="form-text">Minimum booking amount for SEDAN</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="minBookingErtiga">ERTIGA</label>
                                                <input type="number" class="form-control" id="minBookingErtiga" name="min_booking_ertiga" min="0" step="0.01" value="{{ $destination->min_booking_ertiga }}" required>
                                                <div class="form-text">Minimum booking amount for ERTIGA</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Driver Fare -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Driver Fare</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="driverFareAlto">ALTO/WAGON R</label>
                                                <input type="number" class="form-control" id="driverFareAlto" name="driver_fare_alto" value="{{ $destination->driver_fare_alto }}" readonly>
                                                <div class="form-text">Driver fare = Total fare - Minimum booking amount</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="driverFareSedan">SEDAN</label>
                                                <input type="number" class="form-control" id="driverFareSedan" name="driver_fare_sedan" value="{{ $destination->driver_fare_sedan }}" readonly>
                                                <div class="form-text">Driver fare = Total fare - Minimum booking amount</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label" for="driverFareErtiga">ERTIGA</label>
                                                <input type="number" class="form-control" id="driverFareErtiga" name="driver_fare_ertiga" value="{{ $destination->driver_fare_ertiga }}" readonly>
                                                <div class="form-text">Driver fare = Total fare - Minimum booking amount</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enable/Disable Switch -->
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="isEnabled" name="is_enabled" {{ $destination->is_enabled ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isEnabled">Enable this destination</label>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update Destination</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Get form elements
        const form = document.getElementById('destinationForm');
        const totalFareAltoField = document.getElementById('totalFareAlto');
        const totalFareSedanField = document.getElementById('totalFareSedan');
        const totalFareErtigaField = document.getElementById('totalFareErtiga');
        const minBookingAltoField = document.getElementById('minBookingAlto');
        const minBookingSedanField = document.getElementById('minBookingSedan');
        const minBookingErtigaField = document.getElementById('minBookingErtiga');
        const driverFareAltoField = document.getElementById('driverFareAlto');
        const driverFareSedanField = document.getElementById('driverFareSedan');
        const driverFareErtigaField = document.getElementById('driverFareErtiga');
        const rangeField = document.getElementById('destinationRange');

        // Function to calculate driver fare
        function calculateDriverFare() {
            // ALTO/WAGON R
            const totalFareAlto = parseFloat(totalFareAltoField.value) || 0;
            const minBookingAlto = parseFloat(minBookingAltoField.value) || 0;
            driverFareAltoField.value = (totalFareAlto - minBookingAlto).toFixed(2);

            // SEDAN
            const totalFareSedan = parseFloat(totalFareSedanField.value) || 0;
            const minBookingSedan = parseFloat(minBookingSedanField.value) || 0;
            driverFareSedanField.value = (totalFareSedan - minBookingSedan).toFixed(2);

            // ERTIGA
            const totalFareErtiga = parseFloat(totalFareErtigaField.value) || 0;
            const minBookingErtiga = parseFloat(minBookingErtigaField.value) || 0;
            driverFareErtigaField.value = (totalFareErtiga - minBookingErtiga).toFixed(2);
        }

        // Add event listeners for input changes
        totalFareAltoField.addEventListener('input', calculateDriverFare);
        totalFareSedanField.addEventListener('input', calculateDriverFare);
        totalFareErtigaField.addEventListener('input', calculateDriverFare);
        minBookingAltoField.addEventListener('input', calculateDriverFare);
        minBookingSedanField.addEventListener('input', calculateDriverFare);
        minBookingErtigaField.addEventListener('input', calculateDriverFare);

        // Initial calculation
        calculateDriverFare();

        // Form validation
        form.addEventListener('submit', function(event) {
            const rangeValue = rangeField.value.trim();
            const rangePattern = /^\s*(\d+(?:\.\d+)?)\s*-\s*(\d+(?:\.\d+)?)\s*$/;
            
            if (!rangePattern.test(rangeValue)) {
                event.preventDefault();
                alert('Please enter the destination range in the format: min - max (e.g. 250 - 300)');
                rangeField.focus();
                return false;
            }
            
            // Extract min and max values for additional validation
            const matches = rangeValue.match(rangePattern);
            const minValue = parseFloat(matches[1]);
            const maxValue = parseFloat(matches[2]);
            
            if (minValue >= maxValue) {
                event.preventDefault();
                alert('The minimum value must be less than the maximum value in the range');
                rangeField.focus();
                return false;
            }
            
            return true;
        });
    });
</script>
@endpush 