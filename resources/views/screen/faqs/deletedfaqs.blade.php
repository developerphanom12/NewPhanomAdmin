@extends('layouts.app')

@section('title', 'Deleted FAQs - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Deleted FAQs</h1>
                            <p>Manage deleted frequently asked questions</p>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Deleted FAQs</h4>
                        </div>
                        <div>
                            <a href="{{ route('faq.index') }}" class="btn btn-primary">Back to FAQs</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Question</th>
                                        <th>Category</th>
                                        <th>Deleted At</th>
                                        <th style="min-width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($faqs->count() > 0)
                                        @foreach($faqs as $faq)
                                        <tr>
                                            <td>{{ $faq->id }}</td>
                                            <td>{{ Str::limit($faq->question, 50) }}</td>
                                            <td>{{ $faq->category ?? 'Uncategorized' }}</td>
                                            <td>{{ $faq->deleted_at->format('F d, Y h:i A') }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <form action="{{ route('faq.restore', $faq->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore" onclick="return confirm('Are you sure you want to restore this FAQ?')">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.5299 5.03003L11.0199 8.55003C10.6299 8.94003 10.6299 9.56003 11.0199 9.96003C11.4099 10.35 12.0299 10.35 12.4299 9.96003L15.9299 6.44003C17.8999 8.38003 17.8999 11.52 15.9299 13.46C13.9999 15.39 10.9699 15.46 8.96995 13.62L5.45995 17.13C4.84995 17.74 3.87995 17.74 3.26995 17.13C2.65995 16.52 2.65995 15.55 3.26995 14.94L6.77995 11.43C4.90995 9.43003 4.97995 6.34003 6.96995 4.43003C8.89995 2.50003 12.0499 2.50003 13.9799 4.44003L14.5299 5.03003Z" fill="currentColor"></path>
                                                                    <path opacity="0.4" d="M20.73 9.03C20.73 11.73 19.25 14.17 16.9 15.5C16.75 15.57 16.58 15.6 16.41 15.6C16.01 15.6 15.53 15.33 15.35 14.91C15.19 14.5 15.35 14.03 15.76 13.77C17.53 12.78 18.63 11 18.63 9C18.64 8.7 18.87 8.43 19.19 8.38C19.5 8.34 19.81 8.53 19.91 8.82C19.95 8.91 19.96 8.96 19.98 9L20.73 9.03Z" fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="{{ route('faq.force-delete', $faq->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Permanently" onclick="return confirm('Are you sure you want to permanently delete this FAQ? This action cannot be undone.')">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No deleted FAQs found</td>
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