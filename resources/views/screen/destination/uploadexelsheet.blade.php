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
                            <p>Uploade Excel Sheet.</p>
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
                                <h4 class="card-title">Uploade Excel Sheet</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('screen.destination.import') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="excel_file">Excel File</label>
                                        <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx,.xls,.csv" required>
                                        <div class="form-text">Upload Excel file with destination details (xlsx, xls, csv)</div>
                                        @error('excel_file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 d-flex align-items-end">
                                        <a href="{{ route('screen.destination.download-sample') }}" class="btn btn-info">
                                            <i class="fas fa-download me-1"></i> Download Sample Excel
                                        </a>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <h5 class="alert-heading mb-2"><i class="fas fa-info-circle me-2"></i>Excel Format Requirements</h5>
                                            <p>Download the sample Excel file for the correct format, or ensure your file has the following columns:</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="mb-0">
                                                        <li><strong>Column A:</strong> Boarding Point</li>
                                                        <li><strong>Column B:</strong> Destination Point</li>
                                                        <li><strong>Column C:</strong> Distance (numeric)</li>
                                                        <li><strong>Column D:</strong> Destination Range (format: "250 - 300")</li>
                                                        <li><strong>Column E:</strong> Commission SEDAN (numeric)</li>
                                                        <li><strong>Column F:</strong> Commission ERTIGA (numeric)</li>
                                                        <li><strong>Column G:</strong> Commission CRYSTA (numeric)</li>
                                                        <li><strong>Column H:</strong> Total Fare SEDAN (numeric)</li>
                                                        <li><strong>Column I:</strong> Total Fare ERTIGA (numeric)</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="mb-0">
                                                        <li><strong>Column J:</strong> Total Fare CRYSTA (numeric)</li>
                                                        <li><strong>Column K:</strong> Min Booking SEDAN (numeric)</li>
                                                        <li><strong>Column L:</strong> Min Booking ERTIGA (numeric)</li>
                                                        <li><strong>Column M:</strong> Min Booking CRYSTA (numeric)</li>
                                                        <li><strong>Column N:</strong> Driver Fare SEDAN (numeric)</li>
                                                        <li><strong>Column O:</strong> Driver Fare ERTIGA (numeric)</li>
                                                        <li><strong>Column P:</strong> Driver Fare CRYSTA (numeric)</li>
                                                        <li><strong>Column Q:</strong> Is Enabled (1 for enabled, 0 for disabled, optional)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <small class="mb-0">The first row should be a header row and will be skipped during import.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                    <a href="{{ route('screen.destination.destinations') }}" class="btn btn-secondary">Back</a>
                                </div>

                                @if(session('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

@endsection