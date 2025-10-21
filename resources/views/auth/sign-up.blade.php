@extends('layouts.auth')

@section('title', 'Sign Up - Kabby Admin')

@section('content')

<div class="wrapper">
    <section class="login-content">
        <div class="row m-0 align-items-center bg-white vh-100">            
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                            <div class="card-body">
                                
                                <h2 class="mb-2 text-center">Sign Up</h2>
                                <p class="text-center">Create your Kabby Admin account.</p>
                                
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                       id="password" name="password" required>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" 
                                                       id="password_confirmation" name="password_confirmation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Sign Up</button>
                                    </div>
                                    <p class="mt-3 text-center">
                                        Already have an account? <a href="{{ route('login') }}" class="text-underline">Sign in</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                <img src="{{ asset('images/auth/01.png') }}" class="img-fluid gradient-main animated-scaleX" alt="sign up">
            </div>
        </div>
    </section>
</div>
@endsection 