@extends('layouts.app')

@section('title', 'All Banners - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Welcome to Kabby Admin!</h1>
                            <p>Manage Your Banners.</p>
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
                           <a href="{{ route('banner.create') }}" class="btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3 text-center">
                              <i class="btn-inner">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                 </svg>
                              </i>
                              <span>Add New Banner</span>
                           </a>
                           
                           <a href="{{ route('banner.deleted') }}" class="btn btn-secondary btn-icon mt-lg-0 mt-md-0 mt-3 ms-2 text-center">
                              <i class="btn-inner">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                 </svg>
                              </i>
                              <span>View Deleted Banners</span>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
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
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input banner-status-toggle" type="checkbox" 
                                                    id="banner-status-{{ $banner->id }}" 
                                                    data-banner-id="{{ $banner->id }}"
                                                    {{ $banner->is_active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <a class="btn btn-sm btn-icon btn-info me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View" href="{{ route('banner.show', $banner) }}">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89108 11.9994 8.89108C13.7454 8.89108 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="{{ route('banner.edit', $banner) }}">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <form action="{{ route('banner.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                                        <td colspan="4" class="text-center">No banners found</td>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all banner status toggle switches
        const toggleSwitches = document.querySelectorAll('.banner-status-toggle');
        
        // Add event listener to each toggle switch
        toggleSwitches.forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                const bannerId = this.dataset.bannerId;
                const isActive = this.checked ? 1 : 0;
                
                // Create form data
                const formData = new FormData();
                formData.append('is_active', isActive);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Send AJAX request
                fetch(`{{ url('banner') }}/${bannerId}/toggle-status`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showStatusMessage('Banner status updated successfully', 'success');
                    } else {
                        showStatusMessage('Error updating banner status', 'error');
                        // Revert the toggle to its previous state
                        this.checked = !this.checked;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showStatusMessage('Error updating banner status', 'error');
                    // Revert the toggle to its previous state
                    this.checked = !this.checked;
                });
            });
        });
        
        // Function to show status messages
        function showStatusMessage(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = type === 'success' 
                ? 'alert alert-success alert-dismissible fade show' 
                : 'alert alert-danger alert-dismissible fade show';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            // Insert the alert at the top of the card body
            const cardBody = document.querySelector('.card-body');
            cardBody.insertBefore(alertDiv, cardBody.firstChild);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    });
</script>
@endpush
@endsection