@extends('layouts.app')
@section('title', 'Students')

@section('content')

    <div class="content-body">
            @if ($student)
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card h-auto">
                                <div class="card-header p-0">
                                    <div class="user-bg w-100">
                                        <div class="user-svg">
                                            <svg width="264" height="109" viewBox="0 0 264 109" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.0107422" y="0.6521" width="263.592" height="275.13" rx="20"
                                                    fill="#FCC43E" />
                                            </svg>
                                        </div>
                                        <div class="user-svg-1">
                                            <svg width="264" height="59" viewBox="0 0 264 59" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect y="0.564056" width="263.592" height="275.13" rx="20"
                                                    fill="#FB7D5B" />
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="user">
                                            <div class="user-media">
                                                <img src="{{ asset('profile/' . $student->profile_photo) }}" alt=""
                                                    class="avatar avatar-xxl">
                                            </div>
                                            <div>
                                                <h2 class="mb-0">{{ $student->name }} 
                                                    <span class="badge 
                                                        {{ $student->status == 0 ? 'badge-warning' : ($student->status == 1 ? 'badge-primary' : 'badge-danger') }}">
                                                        {{ $student->status == 0 ? 'Pending' : ($student->status == 1 ? 'Processed' : 'Rejected') }}
                                                    </span>
                                                </h2>

                                                <p class="text-primary font-w600">Institute: {{ $student->institute->name }}
                                                    <br>Department: {{ $student->department->name }}</p>
                                            </div>
                                        </div>
                                        <div class="">
                                            Admission To:  <span class="badge badge-success">
                                                      {{ $student->grade }}
                                                    </span>
                                        </div>
                                        <div class="dropdown custom-dropdown">
                                            <div class="btn sharp tp-btn " data-bs-toggle="dropdown">
                                                <svg width="24" height="6" viewBox="0 0 24 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.0012 0.359985C11.6543 0.359985 11.3109 0.428302 10.9904 0.561035C10.67 0.693767 10.3788 0.888317 10.1335 1.13358C9.88829 1.37883 9.69374 1.67 9.56101 1.99044C9.42828 2.31089 9.35996 2.65434 9.35996 3.00119C9.35996 3.34803 9.42828 3.69148 9.56101 4.01193C9.69374 4.33237 9.88829 4.62354 10.1335 4.8688C10.3788 5.11405 10.67 5.3086 10.9904 5.44134C11.3109 5.57407 11.6543 5.64239 12.0012 5.64239C12.7017 5.64223 13.3734 5.36381 13.8686 4.86837C14.3638 4.37294 14.6419 3.70108 14.6418 3.00059C14.6416 2.3001 14.3632 1.62836 13.8677 1.13315C13.3723 0.637942 12.7004 0.359826 12 0.359985H12.0012ZM3.60116 0.359985C3.25431 0.359985 2.91086 0.428302 2.59042 0.561035C2.26997 0.693767 1.97881 0.888317 1.73355 1.13358C1.48829 1.37883 1.29374 1.67 1.16101 1.99044C1.02828 2.31089 0.959961 2.65434 0.959961 3.00119C0.959961 3.34803 1.02828 3.69148 1.16101 4.01193C1.29374 4.33237 1.48829 4.62354 1.73355 4.8688C1.97881 5.11405 2.26997 5.3086 2.59042 5.44134C2.91086 5.57407 3.25431 5.64239 3.60116 5.64239C4.30165 5.64223 4.97339 5.36381 5.4686 4.86837C5.9638 4.37294 6.24192 3.70108 6.24176 3.00059C6.2416 2.3001 5.96318 1.62836 5.46775 1.13315C4.97231 0.637942 4.30045 0.359826 3.59996 0.359985H3.60116ZM20.4012 0.359985C20.0543 0.359985 19.7109 0.428302 19.3904 0.561035C19.07 0.693767 18.7788 0.888317 18.5336 1.13358C18.2883 1.37883 18.0937 1.67 17.961 1.99044C17.8283 2.31089 17.76 2.65434 17.76 3.00119C17.76 3.34803 17.8283 3.69148 17.961 4.01193C18.0937 4.33237 18.2883 4.62354 18.5336 4.8688C18.7788 5.11405 19.07 5.3086 19.3904 5.44134C19.7109 5.57407 20.0543 5.64239 20.4012 5.64239C21.1017 5.64223 21.7734 5.36381 22.2686 4.86837C22.7638 4.37294 23.0419 3.70108 23.0418 3.00059C23.0416 2.3001 22.7632 1.62836 22.2677 1.13315C21.7723 0.637942 21.1005 0.359826 20.4 0.359985H20.4012Z" fill="#A098AE"/>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @hasanyrole('Student')
                                                    @if($student->created_at->diffInDays(now()) <= 3)
                                                        <a class="dropdown-item" href="{{ route('student.edit',$student->id) }}">Edit Application</a>
                                                    @endif
                                                @endhasanyrole
                                                    <a class="dropdown-item" href="{{ route('student.dowload_application',$student->id) }}" target="_blank">Download Application</a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xl-6 col-xxl-6 col-sm-6">
                                            <ul class="student-details">
                                                <li class="me-2">
                                                    <a class="icon-box bg-secondary">
                                                        <img src="{{ asset('images/profile.svg') }}" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <span>Nationality:</span>
                                                    <h5 class="mb-0">{{ $student->nationality }}</h5>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6 col-sm-6">

                                            <ul class="student-details">
                                                <li class="me-2">
                                                    <a class="icon-box bg-secondary">
                                                        <img src="{{ asset('images/svg/location.svg') }}" alt="">
                                                    </a>

                                                </li>
                                                <li><span>Address:</span>
                                                    <h5 class="mb-0">{{ $student->address }}</h5>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6 col-sm-6">
                                            <ul class="student-details">
                                                <li class="me-2">
                                                    <a class="icon-box bg-secondary">
                                                        <img src="{{ asset('images/svg/phone.svg') }}" alt="">
                                                    </a>
                                                </li>
                                                <li><span>Phone:</span>
                                                    <h5 class="mb-0">{{ $student->mobile }}</h5>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-6 col-xxl-6 col-sm-6">
                                            <ul class="student-details">
                                                <li class="me-2">
                                                    <a class="icon-box bg-secondary">
                                                        <img src="{{ asset('images/svg/email.svg') }}" alt="">
                                                    </a>

                                                </li>
                                                <li><span>Email:</span>
                                                    <h5 class="mb-0">{{ $student->email }}</h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="card h-auto schedule-card">
                                <div class="card-body">
                                    <h4 class="mb-0">Personal</h4>
                                    <p>Parents</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul>
                                                <li class="mb-2"><span class="text-primary font-w600">Father Name:</span>
                                                    {{ $student->father_name }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Father
                                                        Ocuupation:</span> {{ $student->father_occupation }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Mother Name:</span>
                                                    {{ $student->mother_name }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Mother
                                                        Ocuupation:</span> {{ $student->mother_occupation }}</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card h-auto schedule-card">
                                <div class="card-body">
                                    <h4 class="mb-0">Attachemnts</h4>
                                    <p>Documents</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul>
                                                <li class="mb-2"><span class="text-primary font-w600">AADHAR Card:</span>
                                                    @if ($student->aadhar)
                                                        <a href="{{ asset('aadhar/' . $student->aadhar) }}">Download</a>
                                                    @endif
                                                </li>
                                                <li class="mb-2"><span class="text-primary font-w600">SSLC Certificate:</span>
                                                    @if ($student->sslc)
                                                        <a href="{{ asset('sslc/' . $student->sslc) }}">Download</a>
                                                    @endif
                                                </li>
                                                <li class="mb-2"><span class="text-primary font-w600">Previous Education
                                                        certificate:</span>
                                                    @if ($student->previous_certificate)
                                                        <a
                                                            href="{{ asset('academic/' . $student->previous_certificate) }}">Download</a>
                                                    @endif
                                                    </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-sm-6">
                            <div class="card h-auto schedule-card-1">
                                <div class="card-body">
                                    <h4 class="mb-0">Basics</h4>
                                    <p>Basics</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul>
                                                <li class="mb-2"><span class="text-primary font-w600">Date Of Birth:</span>
                                                    {{ $student->dob }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Nationality:</span>
                                                    {{ $student->nationality }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Religion:</span>
                                                    {{ $student->religion }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Gender:</span>
                                                    {{ $student->gender == 1 ? 'Male' : 'Female' }}
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="card h-auto schedule-card-2">
                                <div class="card-body">
                                    <h4 class="mb-0">Contact</h4>
                                    <p>Address</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul>
                                                <li class="mb-2"><span class="text-primary font-w600">City:</span>
                                                    {{ $student->city }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">District:</span>
                                                    {{ $student->district }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">State:</span>
                                                    {{ $student->state }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">PIN:</span>
                                                    {{ $student->pin }}
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="card h-auto schedule-card-1">
                                <div class="card-body">
                                    <h4 class="mb-0">Qualification</h4>
                                    <p>Education</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul>
                                                <li class="mb-2"><span class="text-primary font-w600">Last Islamic
                                                        Degree:</span> {{ $student->islamic_qualfication }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Degree Year:</span>
                                                    {{ $student->islamic_year }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Last Secular
                                                        Degree:</span> {{ $student->secular_qualfication }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Degree Year:</span>
                                                    {{ $student->secular_year }}
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="card h-auto schedule-card-2">
                                <div class="card-body">
                                    <h4 class="mb-0">Others</h4>
                                    <p>Aims/Hobbies</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul>
                                                <li class="mb-2"><span class="text-primary font-w600">AIMS:</span>
                                                    {{ $student->aim_1 }} .<br>{{ $student->aim_2 }}
                                                    .<br>{{ $student->aim_3 }}.</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Hobbies:</span>
                                                    {{ $student->hobbies }}</li>
                                                <li class="mb-2"><span class="text-primary font-w600">Extracurricular
                                                        Activities:</span> {{ $student->activites }}</li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($student->previous_education == 1)
                            <div class="col-xl-4 col-sm-6">
                                <div class="card h-auto schedule-card">
                                    <div class="card-body">
                                        <h4 class="mb-0">Relevant Education</h4>
                                        <p>Islamic</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <ul>
                                                    <li class="mb-2"><span
                                                            class="text-primary font-w600">Details:</span>{{ $student->previous_education_details }}
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($count > 0)
                            <div class="col-xl-12 col-sm-6">
                                <div class="card h-auto schedule-card">
                                    <div class="card-body">
                                        <h4 class="mb-0">Additional Information</h4>
                                        @foreach ($additional_form as $key=>$form )
                                        <span class="text-primary font-w600">{{ $form->questions }}</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <ul>
                                                    <li class="mb-2">{{ $additional_form_result[$key]->answers }}
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                        @endforeach
                                      
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
           
                <div class="authincation h-100" style="background-image: url(images/student-bg.jpg); background-repeat:no-repeat; background-size:cover;">
                     <div class="container h-100">
                         <div class="row">
                             <div class="col-lg-6 col-sm-12">
                                 <div class="form-input-content  error-page">
                                     <h4>Application Doesn't Exist</h4>
                                     <p>You have not applied Yet!</p>
                                     <a class="btn btn-primary" href="{{ route('student.add') }}">Go To Application Form</a>
                                 </div>
                             </div>
                             <div class="col-lg-6 col-sm-12">
                                 <img  class="w-100" src="{{ asset('images/svg/student.svg') }}" alt="">
                             </div>
                         </div>
                     </div>
                 </div>
             
          
             
            
            @endif
       
    </div>


@endsection
