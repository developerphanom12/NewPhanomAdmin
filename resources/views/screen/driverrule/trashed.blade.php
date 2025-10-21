@extends('layouts.app')
@section('title', 'Deleted Driver Rules - Kabby Admin')
@section('content')
<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Deleted Driver Rules</h1>
                            <p>Restore or permanently delete driver rules.</p>
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
                            <h4 class="card-title">Deleted Driver Rules</h4>
                        </div>
                        <div>
                            <a href="{{ route('driver-rules.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Driver Rules
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Deleted At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trashedDriverRules as $rule)
                                        <tr>
                                            <td>{{ $rule->id }}</td>
                                            <td>{{ $rule->name }}</td>
                                            <td>
                                                <span class="badge {{ $rule->is_enabled ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $rule->is_enabled ? 'Enabled' : 'Disabled' }}
                                                </span>
                                            </td>
                                            <td>{{ $rule->deleted_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    <form action="{{ route('driver-rules.restore', $rule->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-icon btn-success" 
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Restore">
                                                            <i class="fas fa-trash-restore"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('driver-rules.force-delete', $rule->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-icon btn-danger" 
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Permanently"
                                                                onclick="return confirm('Are you sure you want to permanently delete this rule? This action cannot be undone.')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No deleted driver rules found.</td>
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