
@php
    
    use App\Models\Institute;
    $institutes = Institute::get();

@endphp


@extends('auth.layouts.app')
@section('title', 'Signup')
@section('content')


    <div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <div class="d-flex justify-content-center h-100 align-items-center">
            <div class="authincation-content style-2">
                <div class="row no-gutters">
                    <div class="col-xl-12 tab-content">
                        <div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
                           

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="text-center mb-4">
                                    <h3 class="text-center mb-2 text-black">Sign Up</h3>
                                  
                                </div>
                               
        
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Institute</label>
                                    <select class="form-control"  name="institute" id="institute">
                                        <option selected disabled>Select Institute</option>
                                        @foreach ($institutes as $key => $institute)
                                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('institute')
                                    <span class="text-danger">
                                                {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                             
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label mb-2 fs-13 label-color font-w500">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">


                                </div>

                                <button class="btn btn-block btn-primary">Sign Up</button>
                                
                            </form>
                            <div class="new-account mt-3 text-center">
                                <p class="font-w500">Already have an account? <a class="text-primary" href="{{ route('login') }}" data-toggle="tab">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')


<script>
    $('select').niceSelect();
</script>

@endsection

