@extends('layouts.app')
@section('title', 'Notification')

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
                                    <h5 class="mb-0">Notify Student</h5>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-0" style="float: left"> Notify Students to Download Admit Card.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" enctype="multipart/form-data" action="{{ route('notifications.send') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-10 col-lg-8">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">



                                                <div class="mb-3">
                                                    @hasanyrole('Super Admin')
                                                        <label for="fullname" class="form-label text-primary">Select
                                                            Institute<span class="required">*</span></label>

                                                        <select class="form-control" name="institute" id="institute">
                                                            <option selected disabled>Select Institite</option>
                                                            @foreach ($institutes as $key => $institute)
                                                                <option value="{{ $institute->id }}">{{ $institute->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    @endhasanyrole
                                                    @hasanyrole('Manager|Staff')

                                                        <label for="fullname" class="form-label text-primary">Select
                                                            Department<span class="required">*</span></label>
                                                        <select class="form-control" name="department" id="department">
                                                            <option selected disabled>Select Department</option>
                                                            @foreach ($departments as $key => $department)
                                                                <option value="{{ $department->id }}">{{ $department->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endhasanyrole

                                                    @error('institute')
                                                        <span class="text-danger">
                                                            {{ $message }}</span>
                                                    @enderror

                                                </div>
                                                @hasanyrole('Super Admin')
                                                    <div class="mb-3">
                                                        <label for="department" class="form-label text-primary">Department<span
                                                                class="required">*</span></label>
                                                        <select class="form-control" id="department" name="department">
                                                            @error('department')
                                                                <span class="text-danger">
                                                                    {{ $message }}</span>
                                                            @enderror
                                                        @endhasanyrole
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="col-xl-6 col-sm-6">



                                                <div class="mb-3">



                                                    <label for="fullname" class="form-label text-primary">Select
                                                        Notification Method<span class="required">*</span></label> <br>

                                                    {{-- <select class="form-control"  name="method" id="method">
                                                    <option selected disabled>Select Method</option>
                                                    
                                                    <option value="0">Email</option>
                                                    <option value="1">SMS</option>
                                                    <option value="1">Whtsaap</option>
                                                    <option value="2">Email & SNS</option>
                                                    <option value="2">Email & Whatsapp</option>
                                                    <option value="2">SMS & Whatsapp</option>
                                                </select> --}}

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="method_0"
                                                            id="" value="1">
                                                        <label class="form-check-label" for="method_email">Email</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="method_1"
                                                            id="" value="1">
                                                        <label class="form-check-label" for="method_sms">SMS</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="method_2"
                                                            id="" value="1">
                                                        <label class="form-check-label"
                                                            for="method_whatsapp">Whatsapp</label>
                                                    </div>
                                                </div>


                                                <div class="mb-3" style="margin: 89px 0;float: right;">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#messagemodal"
                                                        class="btn btn-primary">Proceed</button>
                                                </div>
                                                <div class="modal fade" id="messagemodal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-center">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Notification Message
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    <label for="fullname"
                                                                        class="form-label text-primary">Notification
                                                                        Message<span class="required">*</span></label>

                                                                    <input type="text" class="form-control"
                                                                        name="message" maxlength="50" required
                                                                        value="{{ $template->message ?? '' }}">
                                                                    <small class="form-text text-muted">Maximum 50
                                                                        characters</small>

                                                                    @error('message')
                                                                        <span class="text-danger">
                                                                            {{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-bs-dismiss="modal">Back</button>
                                                                <button type="submit" class="btn btn-primary">Save</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
