@extends('layouts.app')

@section('title', 'Coupon List - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
   <div class="iq-navbar-header" style="height: 215px;">
      <div class="container-fluid iq-container">
          <div class="row">
              <div class="col-md-12">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                      <div>
                            <h1>Coupon List</h1>
                            <p>Manage your coupons.</p>
                      </div>
                      <div>
                            <a href="{{ route('coupons.create') }}" class="btn btn-primary">Add New Coupon</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="iq-header-img">
          <img src="{{asset('images/dashboard/top-header.png')}}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
      </div>
   </div>
    <div class="container-fluid content-inner mt-n5 py-0">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Coupons</h4>
                     </div>
                  </div>
                  <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                     <div class="table-responsive">
                            <table class="table table-striped">
                           <thead>
                              <tr>
                                        <th>ID</th>
                                 <th>Title</th>
                                 <th>Type</th>
                                        <th>Amount</th>
                                        <th>Coupon Code</th>
                                 <th>Validity</th>
                                        <th>Enabled</th>
                                        <th>Public</th>
                                        <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                                    @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->title }}</td>
                                        <td>{{ ucfirst($coupon->type) }}</td>
                                        <td>{{ $coupon->amount }}{{ $coupon->type === 'percentage' ? '%' : '' }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->validity->format('Y-m-d') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $coupon->is_enabled ? 'success' : 'danger' }}">
                                                {{ $coupon->is_enabled ? 'Yes' : 'No' }}
                                          </span>
                                 </td>
                                        <td>
                                            <span class="badge bg-{{ $coupon->is_public ? 'info' : 'secondary' }}">
                                                {{ $coupon->is_public ? 'Yes' : 'No' }}
                                          </span>
                                 </td>
                                        <td>
                                            <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?')">Delete</button>
                                            </form>
                                 </td>
                              </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No coupons found.</td>
                              </tr>
                                    @endforelse
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
