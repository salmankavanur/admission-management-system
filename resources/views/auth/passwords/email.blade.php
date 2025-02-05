@extends('auth.layouts.app')
@section('title', 'Reset')
@section('content')


    <div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <div class="d-flex justify-content-center h-100 align-items-center">
            <div class="authincation-content style-2">
                <div class="row no-gutters">
                    <div class="col-xl-12 tab-content">
                        <div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
                           

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="text-center mb-4">
                                    <h3 class="text-center mb-2 text-black">Reset Your Password</h3>
                                  
                                </div>
                                @if (session('error'))
                                <span class="text-danger"> {{ session('error') }}</span>
                            @endif
        
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                               
                                <button class="btn btn-primary btn-user btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                {{-- <button class="btn btn-block btn-primary">Sign In</button> --}}
                                
                            </form>
                            <div class="new-account mt-3 text-center">
                                <p class="font-w500">Already know your account? <a class="text-primary" href="{{route('login')}}" data-toggle="tab">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


