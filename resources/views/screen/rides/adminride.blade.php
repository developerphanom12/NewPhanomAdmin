@extends('layouts.app')

@section('title', 'User List - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>This is our Admin Ride Order Details.</p>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Admin Ride Order</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>Ride ID</th>
                                        <th>Customer</th>
                                        <th>Driver</th>
                                        <th>Date</th>
                                        <th>Partial Paid Amount</th>
                                        <th>Amount</th>
                                        <th>Selected Car Type</th>
                                        <th>Payment Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>c640fef</td>
                                        <td>Test QA</td>
                                        <td>driver34</td>
                                        <td>Sun May 04 2025 1:56:12 PM</td>
                                        <td>₹150</td>
                                        <td>₹4000</td>
                                        <td>Alto/Swift/Wagon-R</td>
                                        <td>Wallet</td>
                                    </tr>
                                    <tr>
                                        <td>c640fef</td>
                                        <td>Test QA</td>
                                        <td>driver34</td>
                                        <td>Sun May 22 2025 1:56:12 AM</td>
                                        <td>₹150</td>
                                        <td>₹8500</td>
                                        <td>Crysta</td>
                                        <td>RazorPay</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection