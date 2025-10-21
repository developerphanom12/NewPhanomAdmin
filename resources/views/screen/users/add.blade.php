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
        <div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between ">
                                    <div class="fs-italic">
                                        <h5> {{$usersData[0]->name}}</h5>
                                        <!--<div class="text-muted-50 mb-1">-->
                                        <!--    <small>Trainer Expert</small>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="text-black-50 text-warning">
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gray">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gray">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                    <div class="card-profile-progress">
                                        <div id="circle-progress-1" class="circle-progress circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                                        <img src="{{asset('images/avatars/01.png')}}" alt="User-Profile" class="theme-color-default-img img-fluid rounded-circle card-img">
                                        <img src="{{asset('images/avatars/avtar_1.png')}}" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-circle card-img">
                                        <img src="{{asset('images/avatars/avtar_2.png')}}" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-circle card-img">
                                        <img src="{{asset('images/avatars/avtar_3.png')}}" alt="User-Profile" class="theme-color-green-img img-fluid rounded-circle card-img">
                                        <img src="{{asset('images/avatars/avtar_4.png')}}" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-circle card-img">
                                        <img src="{{asset('images/avatars/avtar_5.png')}}" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-circle card-img">
                                    </div>
                                    <div class="mt-3 text-center text-muted-50">
                                        <h3>Wallet Balance : 3500</h3>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Add Wallet Balance</button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <i></i>
                                <p>{{$usersData[0]->email}}</p>
                                <p>{{$usersData[0]->contact}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-bs-toggle="tab" href="#Ride-list" role="tab" aria-selected="true">Ride List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#wallte-transaction" role="tab" aria-selected="false">Wallet Transaction</a>
                                </li>
                            </ul>
                            {{-- start ride list --}}
                            <div class="col-lg-12">
                                <div class="profile-content tab-content">
                                    {{-- Make sure the corresponding tab pane also has 'show active' --}}
                                    <div id="Ride-list" class="tab-pane fade show active"  style="margin-top:40px">
                                        <div class="table-responsive">
                                            <table id="datatable2" class="table table-striped" data-toggle="data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Ride Id</th>
                                                        <th>Boarding Point</th>
                                                        <th>Destination Point</th>
                                                        <th>Date</th>
                                                        <th>Ride Status</th>
                                                        <th>Payment Method</th>
                                                        <th>Payment Status</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($rides as $ride): ?>
                                                       <tr>
                                                        <td>{{$ride->id}}</td>
                                                        <td>{{$ride->boarding_point}}</td>
                                                        <td>{{$ride->destination_point}}</td>
                                                        <td>2024-03-20</td>
                                                        <td><span class="badge bg-success py-2">Ride Completed</span></td>
                                                        <td>Kabby wallet</td>
                                                        <td><span class="badge bg-success py-2">Paid</span></td>
                                                        <td>5463546</td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="wallte-transaction" class="tab-pane fade" style="margin-top:40px">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Payment</th>
                                                        <th>Tnx ID</th>
                                                        <th>Date</th>
                                                        <th>Note</th>
                                                        <th>Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>#12345</td>
                                                        <td>Kabby wallet</td>
                                                        <td>TXN123456789</td>
                                                        <td>2024-03-20</td>
                                                        <td>Ride payment</td>
                                                        <td>$50.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>#12346</td>
                                                        <td>Kabby wallet</td>
                                                        <td>TXN123456790</td>
                                                        <td>2024-03-20</td>
                                                        <td>Wallet recharge</td>
                                                        <td>$100.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>#12347</td>
                                                        <td>Kabby wallet</td>
                                                        <td>TXN123456791</td>
                                                        <td>2024-03-19</td>
                                                        <td>Refund</td>
                                                        <td>$25.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>#12348</td>
                                                        <td>Kabby wallet</td>
                                                        <td>TXN123456792</td>
                                                        <td>2024-03-19</td>
                                                        <td>Ride payment</td>
                                                        <td>$75.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>#12349</td>
                                                        <td>Kabby wallet</td>
                                                        <td>TXN123456793</td>
                                                        <td>2024-03-18</td>
                                                        <td>Wallet recharge</td>
                                                        <td>$200.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- wallet transaction --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection