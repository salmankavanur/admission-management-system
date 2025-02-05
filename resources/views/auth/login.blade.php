@extends('auth.layouts.app')
@section('title', 'Login')
@section('content')


    <div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <div class="d-flex justify-content-center h-100 align-items-center">
            <div class="authincation-content style-2">
                <div class="row no-gutters">
                    <div class="col-xl-12 tab-content">
                        <div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
                           

                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="text-center mb-4">
                                    <h3 class="text-center mb-2 text-black">Sign In</h3>
                                  
                                </div>
                               
        
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Password</label>
                                    <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                             
                                </div>
                                <a href="{{route('password.request')}}" class="text-primary float-end mb-4">Forgot Password ?</a>
                                <button class="btn btn-block btn-primary">Sign In</button>
                                
                            </form>
                            <div class="new-account mt-3 text-center">
                                <p class="font-w500">Don't have an account? <a class="text-primary" href="{{ route('register') }}" data-toggle="tab">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


