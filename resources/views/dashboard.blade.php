@extends('layouts.app')

@section('title', 'Dashboard - Kabby Admin')

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
           <div class="col-md-12 col-lg-12">
              <div class="row row-cols-1">
                 <div class="overflow-hidden d-slider1 ">
                    <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                   <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Total rides</p>
                                   <h4 class="counter">₹560K</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                   <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Total users</p>
                                   <h4 class="counter">{{ $todayUsers }}</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                   <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Total drivers</p>
                                   <h4 class="counter">₹375K</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                   <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Total Earnings</p>
                                   <h4 class="counter">₹742K</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-05" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                                   <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Ride Placed</p>
                                   <h4 class="counter">₹150K</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-06" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                                   <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Ride Active</p>
                                   <h4 class="counter">₹4600</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-07" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                   <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Ride Completed</p>
                                   <h4 class="counter">11.2M</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                       <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                        <div class="card-body">
                           <div class="progress-widget">
                              <div id="circle-progress-07" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                 <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                 </svg>
                              </div>
                              <div class="progress-detail">
                                 <p  class="mb-2">Ride Cancelled</p>
                                 <h4 class="counter">11.2M</h4>
                              </div>
                           </div>
                        </div>
                     </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                 </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="row row-cols-1">
                   <div class="overflow-hidden d-slider1 ">
                      <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-08" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                     <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Total rides</p>
                                     <h4 class="counter">₹560K</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-09" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                     <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Total users</p>
                                     <h4 class="counter">{{ $totalUsers }}</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-10" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                     <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Total drivers</p>
                                     <h4 class="counter">₹375K</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-11" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                     <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Total Earnings</p>
                                     <h4 class="counter">₹742K</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-12" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="50" data-type="percent">
                                     <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Ride Placed</p>
                                     <h4 class="counter">₹150K</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-13" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                                     <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Ride Active</p>
                                     <h4 class="counter">₹4600</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                               <div class="progress-widget">
                                  <div id="circle-progress-14" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                     <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                     </svg>
                                  </div>
                                  <div class="progress-detail">
                                     <p  class="mb-2">Ride Completed</p>
                                     <h4 class="counter">11.2M</h4>
                                  </div>
                               </div>
                            </div>
                         </li>
                         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                          <div class="card-body">
                             <div class="progress-widget">
                                <div id="circle-progress-15" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                   <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                      <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                   </svg>
                                </div>
                                <div class="progress-detail">
                                   <p  class="mb-2">Ride Cancelled</p>
                                   <h4 class="counter">11.2M</h4>
                                </div>
                             </div>
                          </div>
                       </li>
                      </ul>
                      <div class="swiper-button swiper-button-next"></div>
                      <div class="swiper-button swiper-button-prev"></div>
                   </div>
                </div>
             </div>
           </div>
           <div class="col-md-12 col-lg-12">
              <div class="row">
                 
                 <div class="col-md-12 col-xl-4">
                    <div class="card" data-aos="fade-up" data-aos-delay="900">
                       <div class="flex-wrap card-header d-flex justify-content-between">
                          <div class="header-title">
                             <h4 class="card-title">Service Statics</h4>            
                          </div>   
                          <div class="dropdown">
                             <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                This Week
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                             </ul>
                          </div>
                       </div>
                       <div class="card-body">
                          <div class="flex-wrap d-flex align-items-center justify-content-between">
                             <div id="myChart" class="col-md-8 col-lg-8 myChart"></div>
                             <div class="d-grid gap col-md-4 col-lg-4">
                                <div class="d-flex align-items-start">
                                   <svg class="mt-2 icon-14" xmlns="http://www.w3.org/2000/svg" width="14" viewBox="0 0 24 24" fill="#3a57e8">
                                      <g>
                                         <circle cx="12" cy="12" r="8" fill="#3a57e8"></circle>
                                      </g>
                                   </svg>
                                   <div class="ms-3">
                                      <span class="text-gray">Total Rides</span>
                                      <h6>251K</h6>
                                   </div>
                                </div>
                                <div class="d-flex align-items-start">
                                   <svg class="mt-2 icon-14" xmlns="http://www.w3.org/2000/svg" width="14" viewBox="0 0 24 24" fill="#4bc7d2">
                                      <g>
                                         <circle cx="12" cy="12" r="8" fill="#4bc7d2"></circle>
                                      </g>
                                   </svg>
                                   <div class="ms-3">
                                      <span class="text-gray">Accessories</span>
                                      <h6>176K</h6>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-md-12 col-xl-4">
                    <div class="card" data-aos="fade-up" data-aos-delay="1000">
                       <div class="flex-wrap card-header d-flex justify-content-between">
                          <div class="header-title">
                             <h4 class="card-title">Conversions</h4>            
                          </div>
                          <div class="dropdown">
                             <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                This Week
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                             </ul>
                          </div>
                       </div>
                       <div class="card-body">
                          <div id="d-activity" class="d-activity"></div>
                       </div>
                    </div>
                 </div>  
                 <div class="col-md-12 col-xl-4">
                    <div class="card" data-aos="fade-up" data-aos-delay="900">
                       <div class="flex-wrap card-header d-flex justify-content-between">
                          <div class="header-title">
                             <h4 class="card-title">Earnings</h4>            
                          </div>   
                          <div class="dropdown">
                             <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                This Week
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                             </ul>
                          </div>
                       </div>
                       <div class="text-center">
                        <h2 class="counter">65M</h2>
                     <div>
                        <span class="text-success">
                           <svg class="icon-10" xmlns="http://www.w3.org/2000/svg"  width="10"   viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                           </svg>
                           10%
                        </span>
                        <span>Increased</span>
                     </div>
                  </div>
                  <div id="chart-1" style="height: 200px"></div>
               </div>
               
                       
                </div>
                 </div>
                 
                    <div class="row">
                       <div class="col-sm-12">
                          <div class="card">
                             <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                   <h4 class="card-title">Recent Rides</h4>
                                </div>
                             </div>
                             <div class="card-body">
                                
                                <div class="table-responsive">
                                   <table id="datatable" class="table table-striped" data-toggle="data-table">
                                      <thead>
                                         <tr>
                                            <th>Image</th>
                                            <th>Driver</th>
                                            <th>rating</th>
                                            <th>Action</th>
                                         </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                         </tr>
                                         <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                         </tr>
                                         <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                         </tr>
                                         <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                         </tr>
                                         <tr>
                                            <td>Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                         </tr>
                                         <tr>
                                            <td>Brielle Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>61</td>
                                         </tr>
                                         <tr>
                                            <td>Herrod Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>59</td>
                                         </tr>
                                         <tr>
                                            <td>Rhona Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>55</td>
                                         </tr>
                                         <tr>
                                            <td>Colleen Hurst</td>
                                            <td>Javascript Developer</td>
                                            <td>San Francisco</td>
                                            <td>39</td>
                                         </tr>
                                      </tbody>
                                      <tfoot>
                                         <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                         </tr>
                                      </tfoot>
                                   </table>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                       </div>      
                       
                       <div class="row">
                        <div class="col-sm-12">
                           <div class="card">
                              <div class="card-header d-flex justify-content-between">
                                 <div class="header-title">
                                    <h4 class="card-title">Top Drivers</h4>
                                 </div>
                              </div>
                              <div class="card-body">
                                 
                                 <div class="table-responsive">
                                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                                       <thead>
                                          <tr>
                                             <th>Image</th>
                                             <th>Driver</th>
                                             <th>rating</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                             <td>Ashton Cox</td>
                                             <td>Junior Technical Author</td>
                                             <td>San Francisco</td>
                                             <td>66</td>
                                          </tr>
                                          <tr>
                                             <td>Ashton Cox</td>
                                             <td>Junior Technical Author</td>
                                             <td>San Francisco</td>
                                             <td>66</td>
                                          </tr>
                                          <tr>
                                             <td>Ashton Cox</td>
                                             <td>Junior Technical Author</td>
                                             <td>San Francisco</td>
                                             <td>66</td>
                                          </tr>
                                          <tr>
                                             <td>Cedric Kelly</td>
                                             <td>Senior Javascript Developer</td>
                                             <td>Edinburgh</td>
                                             <td>22</td>
                                          </tr>
                                          <tr>
                                             <td>Airi Satou</td>
                                             <td>Accountant</td>
                                             <td>Tokyo</td>
                                             <td>33</td>
                                          </tr>
                                          <tr>
                                             <td>Brielle Williamson</td>
                                             <td>Integration Specialist</td>
                                             <td>New York</td>
                                             <td>61</td>
                                          </tr>
                                          <tr>
                                             <td>Herrod Chandler</td>
                                             <td>Sales Assistant</td>
                                             <td>San Francisco</td>
                                             <td>59</td>
                                          </tr>
                                          <tr>
                                             <td>Rhona Davidson</td>
                                             <td>Integration Specialist</td>
                                             <td>Tokyo</td>
                                             <td>55</td>
                                          </tr>
                                          <tr>
                                             <td>Colleen Hurst</td>
                                             <td>Javascript Developer</td>
                                             <td>San Francisco</td>
                                             <td>39</td>
                                          </tr>
                                       </tbody>
                                       <tfoot>
                                          <tr>
                                             <th>Name</th>
                                             <th>Position</th>
                                             <th>Office</th>
                                             <th>Age</th>
                                          </tr>
                                       </tfoot>
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