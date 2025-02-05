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
                                <h5 class="mb-0">Admission Application Form</h5>
                            </div>
                            <div class="col-md-12">

                            </div>
                        </div>
                       
                       
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('student.update_user') }}">
                            @csrf
                                <input type="hidden" value="{{ $student->id }}" name="user_id">
                            <div class="row">
                                <div class="col-xl-2 col-lg-4">
                                    <label class="form-label text-primary">Passport Size Photograph<span class="required">*</span></label>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{ asset('profile/' . $student->profile_photo) }});"> 			
                                            </div>
                                        </div>
                                        <div class="change-btn mt-2 mb-lg-0 mb-3">
                                            <input type='file' class="form-control d-none" name="imageUpload"   id="imageUpload" accept=".png, .jpg, .jpeg">
                                            <label for="imageUpload" class="dlab-upload mb-0 btn btn-primary btn-sm">Choose File</label>
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

                                                <label for="fullname" class="form-label text-primary">Full Name<span class="required">*</span></label>
                                               
                                                <input type="text" class="form-control" name="fullname" value="{{ $student->name }}">
                                            
                                                @error('fullname')
                                                        <span class="text-danger">
                                                            {{ $message }}
                                                        </span>
                                                @enderror
                                            
                                            </div>
                                            
                                            {{-- <div class="mb-3">
                                                <label class="form-label text-primary">Gender<span class="required">*</span></label>
                                                <select class="form-control"  name="gender">
                                                    <option value="1">Male</option>
                                                    <option value="0">Female</option>
                                                </select>
                                                @error('gender')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                          
                                            <div class="mb-3">
                                                <label for="dob" class="form-label text-primary">Date of Birth<span class="required">*</span></label>
                                                <input type="date" class="form-control" name="dob" value="{{ $student->dob }}">
                                                @error('dob')
                                            <span class="text-danger">
                                                        {{ $message }}</span>
                                            @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="nationality" class="form-label text-primary">Nationality<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="nationality" value="{{ $student->nationality }}" placeholder="Enter your nationality">
                                                @error('nationality')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                           
                                            <div class="mb-3">
                                                <label for="religion" class="form-label text-primary">Religion</label>
                                                <input type="text" class="form-control" name="religion" value="{{ $student->religion }}">
                                                @error('religion')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                           
                                            <div class="mb-3">
                                                <label for="fathername" class="form-label text-primary">Name of Father/Guardian<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="fathername" placeholder="Enter father/guardian's name" value="{{ $student->father_name }}">
                                                @error('fathername')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                       
                                          
                                          
                                            <div class="mb-3">
                                                <label for="mothername" class="form-label text-primary">Name of Mother<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="mothername" placeholder="Enter mother's name" value="{{ $student->mother_name }}">
                                                @error('mothername')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                           
                                           
                                          
                                            
                                            <div class="mb-3">
                                                <label for="address" class="form-label text-primary">Address<span class="required">*</span></label>
                                                <input class="form-control" name="address" value="{{ $student->address }}">
                                                @error('address')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                          
                                            <div class="mb-3">
                                                <label for="district" class="form-label text-primary">District<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="district" placeholder="Enter district" value="{{ $student->district }}">
                                                @error('district')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                          
                                            <div class="mb-3">
                                                <label for="pincode" class="form-label text-primary">Pin Code<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="pincode" placeholder="Enter pin code" value="{{ $student->pin }}">
                                                @error('pincode')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="phone" class="form-label text-primary">Mobile Number (for SMS/Whatsapp Notifications)<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="phone" placeholder="Enter mobile number" value="{{ $student->mobile }}">
                                                @error('phone')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                           
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            
                                            {{-- <div class="mb-3">
                                                <label class="form-label text-primary">Documents Upload</label><span class="required">(PDF Only)</span>
                                                <input type="file" class="form-control" name="aadhar" accept=".pdf,.png,.jpg,.jpeg">
                                                <label for="aadhar" class="form-label">Aadhar Card</label><span class="required">*</span>
                                                @error('aadhar')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="file" class="form-control" name="sslc" accept=".pdf,.png,.jpg,.jpeg">
                                                <label for="sslc" class="form-label">SSLC Passed Certificate</label>
                                                @error('sslc')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="file" class="form-control" name="academic" accept=".pdf,.png,.jpg,.jpeg">
                                                <label for="academic" class="form-label">Previous Academic Certificates</label>
                                                @error('academic')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            <div class="mb-3">
                                                <label for="islamicstudy" class="form-label text-primary">Qualification (Islamic Studies)<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="islamicstudy" placeholder="Madrassa Standard/Others" value="{{ $student->islamic_qualfication }}">
                                                @error('islamicstudy')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="secularstudy" class="form-label text-primary">Qualification (Secular Education)<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="secularstudy" placeholder="High School / Higher Secondary " value="{{ $student->secular_qualfication }}">
                                                @error('secularstudy')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="islamicyear" class="form-label text-primary">Year of Passing (Islamic Studies)<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="islamicyear" placeholder="Enter year of passing in Islamic Studies" value="{{ $student->islamic_year }}">
                                                @error('islamicyear')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="secularyear" class="form-label text-primary">Year of Passing (Secular Education)<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="secularyear" placeholder="Enter year of passing in Secular Education" value="{{ $student->secular_year }}">
                                                @error('secularyear')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="fatheroccupation" class="form-label text-primary">Profession/Occupation of Father/Guardian</label>
                                                <input type="text" class="form-control" name="fatheroccupation" placeholder="Enter father/guardian's profession/occupation" value="{{ $student->father_occupation }}">
                                                @error('fatheroccupation')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="motheroccupation" class="form-label text-primary">Profession/Occupation of Mother</label>
                                                <select class="form-control" id="motheroccupation" name="motheroccupation">
                                                    <option value="housewife" {{$student->mother_occupation == 'housewife' ? 'selected' : ''}}>Housewife/Nill</option>
                                                    <option value="other" {{$student->mother_occupation != 'housewife' ? 'selected' : ''}}>Other</option>
                                                </select>
                                                <!-- Input field for other occupation -->
                                                <input type="text" class="form-control mt-2 d-none" id="otheroccupation" name="otheroccupation" placeholder="Enter occupation" value="{{ $student->mother_occupation }}">
                                                @error('motheroccupation')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="city" class="form-label text-primary">City<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="city" placeholder="Enter city" value="{{ $student->city }}">
                                                @error('city')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="state" class="form-label text-primary">State<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="state" placeholder="Enter state" value="{{ $student->state }}">
                                                @error('state')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label text-primary">Email<span class="required">*</span></label>
                                                
                                                    <input type="email" class="form-control" name="email" value="{{ $student->email }}">
                                               
                                                @error('email')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" name="previous_education" value="1">
                                                <label class="form-check-label" for="previous_education">Have you attended any other Islamic educational institution before?</label>
                                                @error('previous_education')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-primary">If yes, please provide details</label>
                                                <textarea class="form-control" name="previous_education_details" rows="4"></textarea>
                                                @error('previous_education_details')
                                                <span class="text-danger">
                                                            {{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            {{-- <div class="mb-3">
                                                <label class="form-label text-primary">Aims and Dreams</label>
                                                <input type="text" class="form-control" name="aim1" placeholder="Aim 1">
                                                <input type="text" class="form-control mt-2" name="aim2" placeholder="Aim 2">
                                                <input type="text" class="form-control mt-2" name="aim3" placeholder="Aim 3">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Hobbies and Interests</label>
                                                <input type="text" class="form-control" name="hobbies_interests" placeholder="Enter hobbies and interests">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-primary">Extracurricular Activities</label>
                                                <input type="text" class="form-control" name="extracurricular_activities" placeholder="Enter extracurricular activities">
                                            </div> --}}
                                           
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-2">
                                </div>
                                <div class="col-10">
                                   <p> <big style="color: red">Declaration: </big><br>
                                    I hereby declare that the information provided above is true to the best of my knowledge and belief.
                                    In case any information is found to be false, my admission may be canceled and I agree with all
                                    rules and regulations of this institution from the time of admission.</p>

                                    <p>Date & Time: {{ \Carbon\Carbon::now() }}</p>
                                    <div class="mb-3">
                                        <label class="form-label text-primary">Signature Upload</label><span class="required">* (Upload your signature's image)</span>
                                        <input type="file" class="form-control" name="signature" accept=".png,.jpg,.jpeg">
                                      
                                        @error('signature')
                                        <span class="text-danger">
                                                    {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div> --}}
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

       
    });
</script>





@endsection
