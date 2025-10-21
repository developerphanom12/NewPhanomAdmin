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
                  <p>Your dashboard overview and statistics.</p>
               </div>
               <div>
                  <a href="#" class="btn btn-link btn-soft-light">
                     <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.8251 15.2171H12.1748C14.0987 15.2171 15.731 13.985 16.3054 12.2764C16.3887 12.0276 16.1979 11.7713 15.9334 11.7713H14.8562C14.5133 11.7713 14.2362 11.4977 14.2362 11.16C14.2362 10.8213 14.5133 10.5467 14.8562 10.5467H15.9005C16.2463 10.5467 16.5263 10.2703 16.5263 9.92875C16.5263 9.58722 16.2463 9.31075 15.9005 9.31075H14.8562C14.5133 9.31075 14.2362 9.03619 14.2362 8.69849C14.2362 8.35984 14.5133 8.08528 14.8562 8.08528H15.9005C16.2463 8.08528 16.5263 7.8088 16.5263 7.46728C16.5263 7.12575 16.2463 6.84928 15.9005 6.84928H14.8562C14.5133 6.84928 14.2362 6.57472 14.2362 6.23606C14.2362 5.89837 14.5133 5.62381 14.8562 5.62381H15.9886C16.2483 5.62381 16.4343 5.3789 16.3645 5.13113C15.8501 3.32401 14.1694 2 12.1748 2H11.8251C9.42172 2 7.47363 3.92287 7.47363 6.29729V10.9198C7.47363 13.2933 9.42172 15.2171 11.8251 15.2171Z" fill="currentColor"></path>
                        <path opacity="0.4" d="M19.5313 9.82568C18.9966 9.82568 18.5626 10.2533 18.5626 10.7823C18.5626 14.3554 15.6186 17.2627 12.0005 17.2627C8.38136 17.2627 5.43743 14.3554 5.43743 10.7823C5.43743 10.2533 5.00345 9.82568 4.46872 9.82568C3.93398 9.82568 3.5 10.2533 3.5 10.7823C3.5 15.0873 6.79945 18.6413 11.0318 19.1186V21.0434C11.0318 21.5715 11.4648 22.0001 12.0005 22.0001C12.5352 22.0001 12.9692 21.5715 12.9692 21.0434V19.1186C17.2006 18.6413 20.5 15.0873 20.5 10.7823C20.5 10.2533 20.066 9.82568 19.5313 9.82568Z" fill="currentColor"></path>
                     </svg>
                     Announcements
                  </a>
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
   <div class="row">
      <div class="col-sm-12 col-lg-6">
         <div class="card">
            <div class="card-header">
               <div class="header-title">
                  <h4 class="card-title">General Details</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="mt-2 d-flex mb-4">
                  <h6>Ride Id :</h6>
                  <h6 class="mx-2 text-muted">3bb45546-bde9-4daa-af95-e0c640fef1fe</h6>
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Date Created : </h6>
                  <h6 class="mx-2 text-muted">2025-05-04 1:56:12 PM</h6>
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Payment Status :</h6>
                  <span class="badge bg-warning p-2 mx-2">Not Paid</span>
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Payment Method :  </h6>
                  <img src="" alt="">
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Ride Status : </h6>
                  <span class="badge bg-primary p-2 mx-2">Ride Placed</span>
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Ride Distance :</h6>
                  <h6 class="mx-2">NaN null</h6>
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Pickup Date :</h6>
                  <span class="badge bg-success p-2 mx-2">04-05-2025</span>
               </div>
               <div class="mt-2 d-flex mb-4">
                  <h6>Pickup Time :</h6>
                  <span class="badge bg-success p-2 mx-2">05:57 PM</span>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title d-flex">
                  <h4 class="card-title"> Awarded Driver Detail</h4>
                  <span class="badge bg-success p-2 mx-2">Awarded</span>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header">
               <div class="header-title">
                  <h4 class="card-title">Location Details</h4>
               </div>
            </div>
            <div class="route-visual p-4 bg-soft-primary text-center mb-4 mt-3">
               <div class="d-flex align-items-center justify-content-between route-line">
                  <div class="location-point start">
                     <i class="fas fa-map-marker-alt text-primary fa-2x mb-2"></i>
                     <h5>stinationde</h5>
                     <div class="text-muted small">Boarding Point</div>
                  </div>
                  <div class="route-distance">
                     <span class="distance-badge">250 KM</span>
                  </div>
                  <div class="location-point end">
                     <i class="fas fa-flag-checkered text-success fa-2x mb-2"></i>
                     <h5>destinathion</h5>
                     <div class="text-muted small">Destination Point</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"> Ride Reviews</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="mt-2">
                  <p>Review For Customer</p>
                  <hr>
               </div>
               <div class="mt-2">
                  
                  <p>Review For Drive</p>
                  <hr>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title d-flex">
                  <h4 class="card-title"> Applied Driver list</h4>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12 col-lg-6">
         <div class="card">
            <div class="card-header">
               <div class="header-title">
                  <h4 class="card-title">Billing Details</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="d-flex align-items-center justify-content-center">
                  <div class="d-flex flex-column text-center align-items-center justify-content-between ">
                     <div class="card-profile-progress">
                        <div id="circle-progress-1" class="circle-progress  circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                        <img src="{{asset('images/avatars/01.png')}}" alt="User-Profile" class="theme-color-default-img img-fluid rounded-circle card-img">
                        <img src="{{asset('images/avatars/avtar_1.png')}}" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-circle card-img">
                        <img src="{{asset('images/avatars/avtar_2.png')}}" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-circle card-img">
                        <img src="{{asset('images/avatars/avtar_3.png')}}" alt="User-Profile" class="theme-color-green-img img-fluid rounded-circle card-img">
                        <img src="{{asset('images/avatars/avtar_4.png')}}" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-circle card-img">
                        <img src="{{asset('images/avatars/avtar_5.png')}}" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-circle card-img">  
                     </div>
                     <div class="fs-italic mt-2">
                        <h5> Regina Miles</h5>
                        <div class="text-muted-50 mb-1">
                           <small>Trainer Expert</small>
                        </div>
                     </div>
                     <div class="text-black-50 text-warning">
                        <svg class="icon-20"  xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                           <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                           <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                           <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gary">
                           <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gary">
                           <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                     </div>
                  </div>
               </div>
               <div class="mt-2 d-flex">
                  <h6 class="mb-1">Email :</h6>
                  <h6 class="text-muted mx-3">sheetalqa34@gmail.com</h6>
               </div>
               <div class="mt-2 d-flex">
                  <h6 class="mb-1">Phone :</h6>
                  <h6 class="text-muted mx-3">+91-2000020000</h6>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"> Price Details</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="user-bio">
                  <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
               </div>
               <div class="mt-2">
                  <h6 class="mb-1">Joined:</h6>
                  <p>Feb 15, 2021</p>
               </div>
               <div class="mt-2">
                  <h6 class="mb-1">Lives:</h6>
                  <p>United States of America</p>
               </div>
            </div>
         </div>
         
      </div>
      
   </div>
</div>
@endsection
