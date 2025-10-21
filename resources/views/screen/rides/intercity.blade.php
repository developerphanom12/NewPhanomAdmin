@extends('layouts.app')

@section('title', 'userlist - Kabby Admin')

@section('content')

<div class="position-relative iq-banner">
   <div class="iq-navbar-header" style="height: 215px;">
      <div class="container-fluid iq-container">
          <div class="row">
              <div class="col-md-12">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                      <div>
                          <h1>Welcome to Kabby Admin!</h1>
                          <p>This is our Inter City Ride Details.</p>
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
                  <h4 class="card-title">InterCity Ride</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Ride Id</th>
                           <th>Customer</th>
                           <th>Driver</th>
                           <th>Date</th>
                           <th>Amount</th>
                           <th>Ride Status</th>
                           <th style="min-width: 100px">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($ridesDetails as $ride)
                        <tr>
                           <td>{{ $ride['ride_id'] }}</td>
                           <td>{{ $ride['user_name'] }}</td>
                           <td>{{ $ride['driver_name'] }}</td>
                           <td>{{ $ride['created_at'] }}</td>
                           <td>{{ $ride['booking_amount'] }}</td>
                           <td><span class="badge bg-primary">Ride Placed</span></td>
                           <td>
                               <div class="flex align-items-center list-user-action">
                                   <a class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View" href="{{ route('screen.rides.intercityview', $ride['ride_id']) }}">
                                      <span class="btn-inner">
                                         <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>                                      
                                      </span>
                                   </a>
                               </div>
                           </td>
                        </tr>
                        @endforeach

                        <!-- Repeat the above <tr> structure for more rows -->

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection