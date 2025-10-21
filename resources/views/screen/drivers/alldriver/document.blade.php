@extends('layouts.app')

@section('title', 'Driver Documents - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
   <div class="iq-navbar-header" style="height: 215px;">
      <div class="container-fluid iq-container">
          <div class="row">
              <div class="col-md-12">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                      <div>
                          <h1>Driver Document Management</h1>
                          <p>View and approve driver documents</p>
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
                        <h4 class="card-title">{{ $driver->name }}'s Document Details</h4>
                     </div>
                     <div>
                        <a href="{{ route('screen.drivers.alldrivers') }}" class="btn btn-primary">Back to All Drivers</a>
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
                                 <th>Document Type</th>
                                 <th>Document Number</th>
                                 <th>Image</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <!-- Police Verification -->
                              <tr>
                                 <td>Police Verification</td>
                                 <td>
                                    @if(isset($documents['police_verification']))
                                       {{ $documents['police_verification']->verification_number }}
                                    @else
                                       Not Uploaded
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['police_verification']))
                                       <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#policeVerificationModal">View Image</button>
                                    @else
                                       No Image
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['police_verification']))
                                       @if($documents['police_verification']->status === 'approved')
                                          <span class="badge bg-success">Approved</span>
                                       @elseif($documents['police_verification']->status === 'rejected')
                                          <span class="badge bg-danger">Rejected</span>
                                       @else
                                          <span class="badge bg-warning">Pending</span>
                                       @endif
                                    @else
                                       <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['police_verification']))
                                       <div class="d-flex align-items-center">
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST" class="me-2">
                                             @csrf
                                             <input type="hidden" name="document_type" value="police_verification">
                                             <input type="hidden" name="document_id" value="{{ $documents['police_verification']->id }}">
                                             <input type="hidden" name="status" value="approved">
                                             <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                          </form>
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="document_type" value="police_verification">
                                             <input type="hidden" name="document_id" value="{{ $documents['police_verification']->id }}">
                                             <input type="hidden" name="status" value="rejected">
                                             <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                       </div>
                                    @else
                                       <span class="text-muted">No Action</span>
                                    @endif
                                 </td>
                              </tr>
                              
                              <!-- Driver License -->
                              <tr>
                                 <td>Driver License</td>
                                 <td>
                                    @if(isset($documents['driver_license']))
                                       {{ $documents['driver_license']->license_number }}
                                    @else
                                       Not Uploaded
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['driver_license']))
                                       <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#driverLicenseModal">View Image</button>
                                    @else
                                       No Image
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['driver_license']))
                                       @if($documents['driver_license']->status === 'approved')
                                          <span class="badge bg-success">Approved</span>
                                       @elseif($documents['driver_license']->status === 'rejected')
                                          <span class="badge bg-danger">Rejected</span>
                                       @else
                                          <span class="badge bg-warning">Pending</span>
                                       @endif
                                    @else
                                       <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['driver_license']))
                                       <div class="d-flex align-items-center">
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST" class="me-2">
                                             @csrf
                                             <input type="hidden" name="document_type" value="driver_license">
                                             <input type="hidden" name="document_id" value="{{ $documents['driver_license']->id }}">
                                             <input type="hidden" name="status" value="approved">
                                             <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                          </form>
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="document_type" value="driver_license">
                                             <input type="hidden" name="document_id" value="{{ $documents['driver_license']->id }}">
                                             <input type="hidden" name="status" value="rejected">
                                             <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                    </div>
                                    @else
                                       <span class="text-muted">No Action</span>
                                    @endif
                                 </td>
                              </tr>
                              
                              <!-- Aadhaar Card -->
                              <tr>
                                 <td>Aadhaar Card</td>
                                 <td>
                                    @if(isset($documents['aadhaar_card']))
                                       {{ $documents['aadhaar_card']->aadhaar_number }}
                                    @else
                                       Not Uploaded
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['aadhaar_card']))
                                       <div class="d-flex">
                                          <button class="btn btn-sm btn-icon btn-primary me-2" data-bs-toggle="modal" data-bs-target="#aadhaarCardFrontModal">Front</button>
                                          <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#aadhaarCardBackModal">Back</button>
                                       </div>
                                    @else
                                       No Image
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['aadhaar_card']))
                                       @if($documents['aadhaar_card']->status === 'approved')
                                          <span class="badge bg-success">Approved</span>
                                       @elseif($documents['aadhaar_card']->status === 'rejected')
                                          <span class="badge bg-danger">Rejected</span>
                                       @else
                                          <span class="badge bg-warning">Pending</span>
                                       @endif
                                    @else
                                       <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['aadhaar_card']))
                                       <div class="d-flex align-items-center">
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST" class="me-2">
                                             @csrf
                                             <input type="hidden" name="document_type" value="aadhaar_card">
                                             <input type="hidden" name="document_id" value="{{ $documents['aadhaar_card']->id }}">
                                             <input type="hidden" name="status" value="approved">
                                             <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                          </form>
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="document_type" value="aadhaar_card">
                                             <input type="hidden" name="document_id" value="{{ $documents['aadhaar_card']->id }}">
                                             <input type="hidden" name="status" value="rejected">
                                             <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                   </div>
                                    @else
                                       <span class="text-muted">No Action</span>
                                    @endif
                                </td>
                             </tr>
                              
                              <!-- Pollution Verification -->
                              <tr>
                                 <td>Pollution Verification</td>
                                 <td>
                                    @if(isset($documents['pollution_verification']))
                                       {{ $documents['pollution_verification']->pollution_number }}
                                    @else
                                       Not Uploaded
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['pollution_verification']))
                                       <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#pollutionVerificationModal">View Image</button>
                                    @else
                                       No Image
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['pollution_verification']))
                                       @if($documents['pollution_verification']->status === 'approved')
                                          <span class="badge bg-success">Approved</span>
                                       @elseif($documents['pollution_verification']->status === 'rejected')
                                          <span class="badge bg-danger">Rejected</span>
                                       @else
                                          <span class="badge bg-warning">Pending</span>
                                       @endif
                                    @else
                                       <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['pollution_verification']))
                                       <div class="d-flex align-items-center">
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST" class="me-2">
                                             @csrf
                                             <input type="hidden" name="document_type" value="pollution_verification">
                                             <input type="hidden" name="document_id" value="{{ $documents['pollution_verification']->id }}">
                                             <input type="hidden" name="status" value="approved">
                                             <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                          </form>
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="document_type" value="pollution_verification">
                                             <input type="hidden" name="document_id" value="{{ $documents['pollution_verification']->id }}">
                                             <input type="hidden" name="status" value="rejected">
                                             <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                   </div>
                                    @else
                                       <span class="text-muted">No Action</span>
                                    @endif
                                </td>
                             </tr>
                              
                              <!-- Insurance Verification -->
                              <tr>
                                 <td>Insurance Verification</td>
                                 <td>
                                    @if(isset($documents['insurance_verification']))
                                       {{ $documents['insurance_verification']->insurance_number }}
                                    @else
                                       Not Uploaded
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['insurance_verification']))
                                       <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#insuranceVerificationModal">View Image</button>
                                    @else
                                       No Image
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['insurance_verification']))
                                       @if($documents['insurance_verification']->status === 'approved')
                                          <span class="badge bg-success">Approved</span>
                                       @elseif($documents['insurance_verification']->status === 'rejected')
                                          <span class="badge bg-danger">Rejected</span>
                                       @else
                                          <span class="badge bg-warning">Pending</span>
                                       @endif
                                    @else
                                       <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['insurance_verification']))
                                       <div class="d-flex align-items-center">
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST" class="me-2">
                                             @csrf
                                             <input type="hidden" name="document_type" value="insurance_verification">
                                             <input type="hidden" name="document_id" value="{{ $documents['insurance_verification']->id }}">
                                             <input type="hidden" name="status" value="approved">
                                             <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                          </form>
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="document_type" value="insurance_verification">
                                             <input type="hidden" name="document_id" value="{{ $documents['insurance_verification']->id }}">
                                             <input type="hidden" name="status" value="rejected">
                                             <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                   </div>
                                    @else
                                       <span class="text-muted">No Action</span>
                                    @endif
                                </td>
                             </tr>
                              
                              <!-- Vehicle Registration -->
                              <tr>
                                 <td>Vehicle Registration</td>
                                 <td>
                                    @if(isset($documents['vehicle_registration']))
                                       {{ $documents['vehicle_registration']->registration_number }}
                                    @else
                                       Not Uploaded
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['vehicle_registration']))
                                       <button class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#vehicleRegistrationModal">View Image</button>
                                    @else
                                       No Image
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['vehicle_registration']))
                                       @if($documents['vehicle_registration']->status === 'approved')
                                          <span class="badge bg-success">Approved</span>
                                       @elseif($documents['vehicle_registration']->status === 'rejected')
                                          <span class="badge bg-danger">Rejected</span>
                                       @else
                                          <span class="badge bg-warning">Pending</span>
                                       @endif
                                    @else
                                       <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($documents['vehicle_registration']))
                                       <div class="d-flex align-items-center">
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST" class="me-2">
                                             @csrf
                                             <input type="hidden" name="document_type" value="vehicle_registration">
                                             <input type="hidden" name="document_id" value="{{ $documents['vehicle_registration']->id }}">
                                             <input type="hidden" name="status" value="approved">
                                             <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                          </form>
                                          <form action="{{ route('screen.drivers.document.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="document_type" value="vehicle_registration">
                                             <input type="hidden" name="document_id" value="{{ $documents['vehicle_registration']->id }}">
                                             <input type="hidden" name="status" value="rejected">
                                             <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                       </div>
                                    @else
                                       <span class="text-muted">No Action</span>
                                    @endif
                                 </td>
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
</div>

<!-- Document Image Modals -->

<!-- Police Verification Modal -->
@if(isset($documents['police_verification']))
<div class="modal fade" id="policeVerificationModal" tabindex="-1" aria-labelledby="policeVerificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="policeVerificationModalLabel">Police Verification Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['police_verification']->front_image_url }}" class="img-fluid" alt="Police Verification">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Driver License Modal -->
@if(isset($documents['driver_license']))
<div class="modal fade" id="driverLicenseModal" tabindex="-1" aria-labelledby="driverLicenseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="driverLicenseModalLabel">Driver License</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['driver_license']->front_image_url }}" class="img-fluid" alt="Driver License">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Aadhaar Card Front Modal -->
@if(isset($documents['aadhaar_card']))
<div class="modal fade" id="aadhaarCardFrontModal" tabindex="-1" aria-labelledby="aadhaarCardFrontModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aadhaarCardFrontModalLabel">Aadhaar Card (Front)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['aadhaar_card']->front_image_url }}" class="img-fluid" alt="Aadhaar Card Front">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Aadhaar Card Back Modal -->
@if(isset($documents['aadhaar_card']))
<div class="modal fade" id="aadhaarCardBackModal" tabindex="-1" aria-labelledby="aadhaarCardBackModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aadhaarCardBackModalLabel">Aadhaar Card (Back)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['aadhaar_card']->back_image_url }}" class="img-fluid" alt="Aadhaar Card Back">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Pollution Verification Modal -->
@if(isset($documents['pollution_verification']))
<div class="modal fade" id="pollutionVerificationModal" tabindex="-1" aria-labelledby="pollutionVerificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pollutionVerificationModalLabel">Pollution Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['pollution_verification']->front_image_url }}" class="img-fluid" alt="Pollution Verification">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Insurance Verification Modal -->
@if(isset($documents['insurance_verification']))
<div class="modal fade" id="insuranceVerificationModal" tabindex="-1" aria-labelledby="insuranceVerificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insuranceVerificationModalLabel">Insurance Verification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['insurance_verification']->front_image_url }}" class="img-fluid" alt="Insurance Verification">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Vehicle Registration Modal -->
@if(isset($documents['vehicle_registration']))
<div class="modal fade" id="vehicleRegistrationModal" tabindex="-1" aria-labelledby="vehicleRegistrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vehicleRegistrationModalLabel">Vehicle Registration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ $documents['vehicle_registration']->front_image_url }}" class="img-fluid" alt="Vehicle Registration">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

@endsection 
