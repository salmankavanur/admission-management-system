@extends('layouts.app')
@section('title', 'Institute')

@section('content')

    <div class="content-body">
        <div class="container-fluid">
            @include('common.alert')
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-0">Edit Profile</h5>
                                </div>
                
                            </div>


                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-2 col-lg-4">
                                        <label class="form-label text-primary">Profile Picture<span
                                                class="required">*</span></label>
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                @if(isset($user->dp))
                                                <div id="imagePreview"
                                                    style="background-image: url({{ asset('dp/'.$user->dp) }});">
                                                </div>
                                                @else
                                                <div id="imagePreview"
                                                    style="background-image: url({{ asset('images/no-img-avatar.png') }});">
                                                </div>

                                                @endif
                                            </div>
                                            <div class="change-btn mt-2 mb-lg-0 mb-3">
                                                <input type='file' class="form-control d-none" name="imageUpload"
                                                    id="imageUpload" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload"
                                                    class="dlab-upload mb-0 btn btn-primary btn-sm">Choose File</label>
                                                @error('imageUpload')
                                                    <span class="text-danger">
                                                        {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-8">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">

                                                <div class="mb-3">

                                                    <label for="fullname" class="form-label text-primary">Full Name<span
                                                            class="required">*</span></label>
                                                   
                                                        <input type="text" class="form-control" name="fullname"
                                                            value="{{ $user->name }}">
                                                 
                                                    @error('fullname')
                                                        <span class="text-danger">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label text-primary">Email<span
                                                            class="required">*</span></label>

                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ $user->email }}">

                                                    @error('email')
                                                        <span class="text-danger">
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label text-primary">Mobile
                                                        Number<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="phone"
                                                        placeholder="Enter mobile number" value="{{ $user->mobile_number }}">
                                                    @error('phone')
                                                        <span class="text-danger">
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label text-primary">Password</label>
                                                    <input type="password" class="form-control" name="pw"
                                                        placeholder="Enter Password">
                                                    @error('pw')
                                                        <span class="text-danger">
                                                            {{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="text-align: end;">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')


<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    $('.remove-img').on('click', function() {
        // Set the default image URL
        var defaultImageUrl = "{{ asset('images/no-img-avatar.png') }}";
        // Remove style attribute to reset background image
        $('.avatar-preview, #imagePreview').removeAttr('style');
        // Set default image as background image
        $('#imagePreview').css('background-image', 'url(' + defaultImageUrl + ')');
    });
</script>



@endsection
