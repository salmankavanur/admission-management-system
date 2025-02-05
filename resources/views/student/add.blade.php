@extends('layouts.app')
@section('title', 'Institute')

@section('content')

    <div class="content-body">
        <div class="container-fluid">
            @include('common.alert')
            @if ($institutes->status == 1 && $departments->status == 1)
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-0">Admission Application Form</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="mb-0" style="float: left">All <span class="required">*</span> indicated
                                            columns should be filled (mandatory),
                                            others are optional. <br> <span class="required">Documents Upload (PDF Only)
                                                <br> Please ensure to fill out the form only in English. Other languages
                                                should not be
                                                used.”</span>
                                        </p>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('student.store') }}">
                                    @csrf

                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-4">
                                            <label class="form-label text-primary">Passport Size Photograph<span
                                                    class="required">*</span></label>
                                            <div class="avatar-upload">
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url({{ asset('images/no-img-avatar.png') }});">
                                                    </div>
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
                                                        <label for="fullname" class="form-label text-primary">Institute<span
                                                                class="required">*</span></label>
                                                        {{-- @hasanyrole('Manager|Staff|Student') --}}
                                                        <select class="form-control" name="institute" id="institute">


                                                            <option value="{{ $institutes->id }}">{{ $institutes->name }}
                                                            </option>

                                                        </select>
                                                        {{-- @endhasanyrole --}}
                                                        {{-- @hasanyrole('Super Admin')
                                                    <select class="form-control" name="institute" id="institute">


                                                        <option value="{{ $institutes->id }}">{{ $institutes->name }}
                                                        </option>

                                                    </select>
                                                    @endhasanyrole --}}
                                                    </div>

                                                    <div class="mb-3" style="margin: 59px 0 0 0;">

                                                        <label for="fullname" class="form-label text-primary">Full Name<span
                                                                class="required">*</span></label>

                                                        <input type="text" class="form-control" name="fullname"
                                                            value="{{ $user->name }}" readonly>

                                                        @error('fullname')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label text-primary">Gender<span
                                                                class="required">*</span></label>
                                                        <select class="form-control" name="gender">
                                                            <option value="1"
                                                                {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
                                                            <option value="0"
                                                                {{ old('gender') == 0 ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3" style="margin: 59px 0 0 0;">
                                                        <label for="dob" class="form-label text-primary">Date of
                                                            Birth<span class="required">*</span></label>
                                                        <input type="date" class="form-control" name="dob"
                                                            value="{{ old('dob') }}">
                                                        @error('dob')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nationality"
                                                            class="form-label text-primary">Nationality<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="nationality"
                                                            placeholder="Enter your nationality"
                                                            value="{{ old('nationality') ?? 'India' }}">
                                                        @error('nationality')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="religion"
                                                            class="form-label text-primary">Religion</label>
                                                        <input type="text" class="form-control" name="religion"
                                                            value="{{ old('religion') ?? 'Islam' }}">
                                                        @error('religion')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="fathername" class="form-label text-primary">Name of
                                                            Father/Guardian<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="fathername"
                                                            placeholder="Enter father/guardian's name"
                                                            value="{{ old('fathername') }}">
                                                        @error('fathername')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="fatheroccupation"
                                                            class="form-label text-primary">Profession/Occupation of
                                                            Father/Guardian</label>
                                                        <input type="text" class="form-control"
                                                            name="fatheroccupation"
                                                            placeholder="Enter father/guardian's profession/occupation"
                                                            value="{{ old('fatheroccupation') }}">
                                                        @error('fatheroccupation')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="mothername" class="form-label text-primary">Name of
                                                            Mother<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="mothername"
                                                            placeholder="Enter mother's name"
                                                            value="{{ old('mothername') }}">
                                                        @error('mothername')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="motheroccupation"
                                                            class="form-label text-primary">Profession/Occupation of
                                                            Mother</label>
                                                        <select class="form-control" id="motheroccupation"
                                                            name="motheroccupation">
                                                            <option value="housewife"
                                                                {{ old('motheroccupation') == 'housewife' ? 'selected' : '' }}>
                                                                Housewife/Nill</option>
                                                            <option value="other"
                                                                {{ old('motheroccupation') == 'other' ? 'selected' : '' }}>
                                                                Other</option>
                                                        </select>


                                                    </div>
                                                    <!-- Input field for other occupation -->
                                                    <div class="mb-3" style="margin: 59px 0 0 0;">
                                                        <input type="text" class="form-control mt-2 d-none"
                                                            id="otheroccupation" name="otheroccupation"
                                                            placeholder="Enter occupation"
                                                            value="{{ old('otheroccupation') }}">
                                                        @error('motheroccupation')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="address" class="form-label text-primary">Address<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="address"
                                                            placeholder="Enter Address" value="{{ old('address') }}">
                                                        @error('address')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="city" class="form-label text-primary">City<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="city"
                                                            placeholder="Enter city" value="{{ old('city') }}">
                                                        @error('city')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="district"
                                                            class="form-label text-primary">District<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="district"
                                                            placeholder="Enter district" value="{{ old('district') }}">
                                                        @error('district')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label text-primary">State<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="state"
                                                            placeholder="Enter state" value="{{ old('state') }}">
                                                        @error('state')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pincode" class="form-label text-primary">Pin
                                                            Code<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="pincode"
                                                            placeholder="Enter pin code" value="{{ old('pincode') }}">
                                                        @error('pincode')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label text-primary">Email<span
                                                                class="required">*</span></label>

                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ $user->email }}" readonly>



                                                        @error('email')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label text-primary">Mobile
                                                            Number
                                                            (for SMS/Whatsapp Notifications)<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="phone"
                                                            placeholder="Enter mobile number"
                                                            value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="department"
                                                            class="form-label text-primary">Department<span
                                                                class="required">*</span></label>
                                                        {{-- @hasanyrole('Super Admin')
                                                        <select class="form-control" id="department" name="department">
                                                            @error('department')
                                                                <span class="text-danger">
                                                                    {{ $message }}</span>
                                                            @enderror

                                                        </select>
                                                    @endhasanyrole --}}
                                                        {{-- @hasanyrole('Manager|Staff|Student') --}}

                                                        <select class="form-control" name="department" id="department">


                                                            <option value="{{ $departments->id }}">
                                                                {{ $departments->name }}
                                                            </option>

                                                        </select>
                                                        @error('department')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror

                                                        </select>

                                                        {{-- @endhasanyrole --}}
                                                    </div>
                                                    <div class="mb-3" style="margin: 59px 0 0 0;">
                                                        <label class="form-label text-primary">Documents Upload</label>
                                                        <input type="file" class="form-control" name="aadhar"
                                                            accept=".pdf,.png,.jpg,.jpeg">
                                                        <label for="aadhar" class="form-label">Aadhar Card</label><span
                                                            class="required">*</span>
                                                        @error('aadhar')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="sslc"
                                                            accept=".pdf,.png,.jpg,.jpeg">
                                                        <label for="sslc" class="form-label">SSLC Passed
                                                            Certificate</label>
                                                        @error('sslc')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="academic"
                                                            accept=".pdf,.png,.jpg,.jpeg">
                                                        <label for="academic" class="form-label">Previous Academic
                                                            Certificates</label>
                                                        @error('academic')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">

                                                        <label for="academic" class="form-label">Which grade or standard
                                                            or division are you seeking admission to?<span
                                                                class="required">*</span></label>
                                                        <select class="form-control" name="grade" id="grade">


                                                            <option value="Secondary" {{ (old('grade') == 'Secondary') ? 'selected' : '' }}>Secondary</option>
                                                            <option value="Higher Secondary" {{ (old('grade') == 'Higher Secondary') ? 'selected' : '' }}>Higher Secondary</option>

                                                        </select>
                                                        @error('grade')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="islamicstudy"
                                                            class="form-label text-primary">Qualification (Islamic
                                                            Studies)<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="islamicstudy"
                                                            placeholder="Madrassa Standard/Others" value="{{ old('islamicstudy') }}">
                                                        @error('islamicstudy')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="secularstudy"
                                                            class="form-label text-primary">Qualification (Secular
                                                            Education)<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="secularstudy"
                                                            placeholder="High School / Higher Secondary " value="{{ old('secularstudy') }}">
                                                        @error('secularstudy')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="islamicyear" class="form-label text-primary">Year of
                                                            Passing (Islamic Studies)<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="islamicyear"
                                                            placeholder="Enter year of passing in Islamic Studies" value="{{ old('islamicyear') }}">
                                                        @error('islamicyear')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="secularyear" class="form-label text-primary">Year of
                                                            Passing (Secular Education)<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="secularyear"
                                                            placeholder="Enter year of passing in Secular Education" value="{{ old('secularyear') }}">
                                                        @error('secularyear')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="previous_education" value="{{ old('previous_education') ?? '1' }}">
                                                        <label class="form-check-label" for="previous_education">Have you
                                                            attended any other Islamic educational institution
                                                            before?</label>
                                                        @error('previous_education')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-primary">If yes, please provide
                                                            details</label>
                                                        <textarea class="form-control" name="previous_education_details" rows="4">{{ old('previous_education_details')}}</textarea>
                                                        @error('previous_education_details')
                                                            <span class="text-danger">
                                                                {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-primary">Aims and Dreams</label>
                                                        <input type="text" class="form-control" name="aim1"
                                                            placeholder="Aim 1" value="{{ old('aim1') }}">
                                                        <input type="text" class="form-control mt-2" name="aim2"
                                                            placeholder="Aim 2" value="{{ old('aim2') }}">
                                                        <input type="text" class="form-control mt-2" name="aim3"
                                                            placeholder="Aim 3" value="{{ old('aim3') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-primary">Hobbies and
                                                            Interests</label>
                                                        <input type="text" class="form-control"
                                                            name="hobbies_interests"
                                                            placeholder="Enter hobbies and interests" value="{{ old('hobbies_interests') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label text-primary">Extracurricular
                                                            Activities</label>
                                                        <input type="text" class="form-control"
                                                            name="extracurricular_activities"
                                                            placeholder="Enter extracurricular activities" value="{{ old('extracurricular_activities') }}">
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($count > 0)
                                        <hr>
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="mb-0">Additional Info</h5>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8">
                                                <div class="row"> <!-- Added a new row here -->
                                                    @foreach ($additional_fields as $key => $item)
                                                        <div class="col-xl-6 col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="fullname"
                                                                    class="form-label text-primary">{{ $item->questions }}<span
                                                                        class="required">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="extra_fields[]" required>
                                                                @error('extra_fields[]')
                                                                    <span class="text-danger">
                                                                        {{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-10">
                                            <p> <big style="color: red">Declaration: </big><br>
                                                I hereby declare that the information provided above is true to the best of
                                                my
                                                knowledge and belief.
                                                In case any information is found to be false, my admission may be canceled
                                                and I
                                                agree with all
                                                rules and regulations of this institution from the time of admission.</p>

                                            <p>Date & Time: {{ \Carbon\Carbon::now() }}</p>
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Signature Upload</label><span
                                                    class="required">* (Upload your signature's image)</span>
                                                <input type="file" class="form-control" name="signature"
                                                    accept=".png,.jpg,.jpeg">
                                                {{-- <label for="signature" class="form-label">Image</label> --}}
                                                @error('signature')
                                                    <span class="text-danger">
                                                        {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" style="text-align: end;">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            {{-- <button type="button" class="btn btn-outline-primary ms-3">Save as Draft</button> --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="authincation h-100"
                    style="background-image: url(images/student-bg.jpg); background-repeat:no-repeat; background-size:cover;">
                    <div class="container h-100">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-input-content  error-page">
                                    <h4>Application Form Is Not Available Yet</h4>
                                    <p>Form Will Be Uploaded here Once It Get Ready!</p>
                                    <p>Thank You For Your Patience!</p>
                                    <a class="btn btn-primary" href="{{ url('/') }}">Go To Home</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <img class="w-100" src="{{ asset('images/svg/student.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>


            @endif
        </div>
    </div>



@endsection
@section('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
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
    <script>
        // Function to show/hide input field for other occupation
        function toggleOtherOccupationField() {
            var selectedValue = $('#motheroccupation').val();
            if (selectedValue === 'other') {
                $('#otheroccupation').removeClass('d-none').addClass('d-block');
            } else {
                $('#otheroccupation').removeClass('d-block').addClass('d-none');
            }
        }

        // Call the function on page load
        toggleOtherOccupationField();

        // Call the function when select value changes
        $('#motheroccupation').change(function() {
            toggleOtherOccupationField();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Nice Select for the institute dropdown only
            $('select').niceSelect();

            // Fetch departments based on selected institute
            $('#institute').change(function() {
                var instituteId = $(this).val();

                // Clear previous options
                $('#department').empty();

                // Fetch departments via AJAX
                $.ajax({
                    url: "{{ route('student.department', ['id' => ':instituteId']) }}".replace(
                        ':instituteId', instituteId),
                    type: 'GET',
                    success: function(response) {
                        // Log response to check format
                        console.log(response);
                        // Populate departments dropdown with fetched data
                        if ($.isArray(response) && response.length > 0) {
                            $.each(response, function(key, department) {
                                $('#department').append('<option value="' + department
                                    .id + '">' + department.name + '</option>');
                                $('#department').niceSelect('update');
                            });

                        } else {
                            console.log("No departments found.");
                            $('#department').niceSelect('update');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors
                    }
                });
            });
        });
    </script>





@endsection
