@extends('layouts.app')

@section('title', 'Pending Drivers - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
   <div class="iq-navbar-header" style="height: 215px;">
      <div class="container-fluid iq-container">
          <div class="row">
              <div class="col-md-12">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                      <div>
                          <h1>Pending Approval Drivers</h1>
                          <p>Drivers waiting for document verification.</p>
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
   <div class="conatiner-fluid content-inner mt-n5 py-0">
       <div>
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Pending Approval Drivers</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     @if(session('success'))
                        <div class="alert alert-success" role="alert">
                           {{ session('success') }}
                        </div>
                     @endif
                     
                     @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                           {{ session('error') }}
                        </div>
                     @endif
                     
                     <div class="table-responsive">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                           <thead>
                              <tr>
                                 <th>Image</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Phone</th>
                                 <th>Documents</th>
                                 <th>Date</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(count($drivers) > 0)
                                 @foreach($drivers as $driver)
                              <tr>
                                 <td>
                                       <img src="{{ $driver->profile_photo_url }}" class="rounded-circle avatar-40" alt="user">
                                 </td>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->email }}</td>
                                    <td>{{ $driver->contact }}</td>
                                 <td>
                                    <div class="d-flex align-items-center">
                                          <a href="{{ route('screen.drivers.alldriver.document', $driver->id) }}" class="btn btn-sm btn-icon btn-info ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View Documents">
                                          <span class="btn-inner">
                                             <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 12.2H15" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 16.2H12.38" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 6H14C16 6 16 5 16 4C16 2 15 2 14 2H10C9 2 8 2 8 4C8 6 9 6 10 6Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 4.02C19.33 4.2 21 5.43 21 10V16C21 20 20 22 15 22H9C4 22 3 20 3 16V10C3 5.44 4.67 4.2 8 4.02" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg>
                                          </span>
                                       </a>
                                    </div>
                                 </td>
                                    <td>{{ $driver->created_at->format('Y-m-d') }}</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                              </tr>
                                 @endforeach
                              @else
                                 <tr>
                                    <td colspan="7" class="text-center">No pending approval drivers found</td>
                              </tr>
                              @endif
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
