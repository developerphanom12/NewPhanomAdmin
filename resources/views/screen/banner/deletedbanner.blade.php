@extends('layouts.app')

@section('title', 'Deleted Banners - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>Deleted Banners.</p>
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
                    <div class="card-header d-flex">
                        <div class="header-title m-3">
                           <a href="{{ route('banner.index') }}" class="btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3 text-center">
                              <i class="btn-inner">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                 </svg>
                              </i>
                              <span>Back to All Banners</span>
                           </a>
                        </div>
                    </div>
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Priority</th>
                                        <th>Deleted At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($deletedBanners as $banner)
                                    <tr>
                                        <td class="text-center">
                                            @if($banner->image_path && file_exists(public_path('storage/' . $banner->image_path)))
                                                <img class="bg-soft-primary rounded img-fluid me-3" src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner" style="width: 100px; height: 40px;">
                                            @else
                                                <div class="bg-soft-primary rounded me-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 40px;">
                                                    <span class="text-muted">No image</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $banner->order }}</td>
                                        <td>{{ $banner->deleted_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <a href="{{ route('banner.restore', $banner->id) }}" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.91103 15.1288C4.52048 14.738 4.52051 14.1047 4.91103 13.7142C5.30147 13.3239 5.93466 13.3239 6.32514 13.7142L10.2074 17.5948V4.9C10.2074 4.4033 10.6107 4 11.1074 4C11.6041 4 12.0074 4.4033 12.0074 4.9V17.5948L15.8897 13.7142C16.2801 13.3239 16.9132 13.3239 17.3037 13.7142C17.6942 14.1047 17.6942 14.738 17.3037 15.1288L12.0037 20.4288C11.8074 20.6249 11.4963 20.7499 11.1064 20.7499C10.7176 20.7499 10.4074 20.6259 10.2074 20.4288L4.91103 15.1288Z" fill="currentColor"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <form action="{{ route('banner.force-delete', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to permanently delete this banner? This action cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently Delete">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No deleted banners found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div>
        </div>
    </div>
</div>
@endsection 