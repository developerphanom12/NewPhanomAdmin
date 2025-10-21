@extends('layouts.app')

@section('title', 'Tax List - Kabby Admin')

@section('content')
@php
    $countryService = app(App\Services\CountryService::class);
    $countries = collect($countryService->getCountries())->keyBy('code');
@endphp

<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>Manage your Tax rules.</p>
                        </div>
                        <div>
                            <a href="{{ route('taxes.create') }}" class="btn btn-primary">Add New Tax</a>
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
                            <h4 class="card-title">Tax List</h4>
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
                                     <th>Tax Title</th>
                                     <th>Country</th>
                                     <th>Tax Type</th>
                                     <th>Tax Amount</th>
                                     <th>Status</th>
                                     <th>Actions</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  @forelse($taxes as $tax)
                                  <tr>
                                     <td>{{ $tax->id }}</td>
                                     <td>{{ $tax->tax_title }}</td>
                                     <td>{{ $countries[$tax->country]['name'] ?? $tax->country }}</td>
                                     <td>{{ ucfirst($tax->tax_type) }}</td>
                                     <td>{{ $tax->tax_amount }} {{ $tax->tax_type === 'percentage' ? '%' : '' }}</td>
                                     <td>
                                        <span class="badge bg-{{ $tax->is_active ? 'success' : 'danger' }}">
                                            {{ $tax->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                     </td>
                                     <td>
                                        <a href="{{ route('taxes.edit', $tax) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('taxes.destroy', $tax) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this tax?')">
                                                Delete
                                            </button>
                                        </form>
                                     </td>
                                  </tr>
                                  @empty
                                  <tr>
                                     <td colspan="7" class="text-center">No taxes found.</td>
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
</div>

@endsection

















