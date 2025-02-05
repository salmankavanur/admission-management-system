@extends('layouts.app')
@section('title', 'Students')

@section('content')

    <div class="content-body">
      
            @if ($check > 0)


            <div class="col-md-12">
                <div class="widget-stat card" style="max-width: 400px;">
                    <div class="user-media">
                        @if(isset($student->profile_photo))
                        <img src="{{ asset('profile/' . $student->profile_photo) }}" alt="NA"
                            class="avatar avatar-xxl">
                            @endif
                    </div>
                    <div class="card-body">
                        <div class="media ai-icon">
                        
                            <div class="media-body" style="text-align: justify">
                                <h2  style="text-align: center">{{ $student->name }}</h2>
                                <div class="info">
                                    <p>Institute: {{ $student->institute->name }}</p> 
                                    <p>Department: {{ $student->department->name }}</p> 
                                    <p>Student ID: {{ $student->id }}</p>
                                    <p>Email: {{ $student->email }}</p>
                                    <p>Contact Number: {{ $student->mobile }}</p>
                                </div>
                                @php
                                $encryptedStudentID = encrypt($student->id); // Encrypt the student ID
                                @endphp
                                {!! QrCode::size(300)->generate(route('attendance.attendance_marked', ['id' => $student->id])) !!}
                                {{-- {!! QrCode::size(300)->generate($encryptedStudentID) !!} --}}
                                <div class="row" style="text-align: center; margin-top:20px">
                                    <a href="{{ route('student.dowload_admit_card',$student->id) }}" class="btn btn-info" target="blank">Download Admit Card</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            @else
           
                <div class="authincation h-100" style="background-image: url(images/student-bg.jpg); background-repeat:no-repeat; background-size:cover;">
                     <div class="container h-100">
                         <div class="row">
                             <div class="col-lg-6 col-sm-12">
                                 <div class="form-input-content  error-page">
                                     <h4>Admit Card Is Not Available Yet</h4>
                                     <p>You have not paid the fee yet. Once the fee is paid, the admit card will be uploaded.</p>
                                     <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                        @csrf 
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{ env('RAZORPAY_KEY') }}"
                                                data-amount="10000"
                                                data-buttontext="Pay 100 INR"
                                                data-name="AMS"
                                                data-description="AMS Payment"
                                                data-image="/images/logo-icon.png"
                                                data-prefill.name="ABC"
                                                data-prefill.email="abc@gmail.com"
                                                data-theme.color="#ff7529">
                                        </script>
                                        
                                    </form>
                                     {{-- <a class="btn btn-primary" href="{{ route('student.add') }}">Go To Application Form</a> --}}
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

@section('styles')

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f3f3f3;
    }

    .card {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        max-width: 300px;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
    }

    .avatar {
        width: 120px;
        height: 120px;
        border: 4px solid #3498db;
        border-radius: 50%;
        margin: 0 auto 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f9f9f9;
    }

    .avatar i {
        font-size: 60px;
        color: #3498db;
    }

    h2 {
        margin: 10px 0;
        font-size: 24px;
        color: #333;
    }

    .info p {
        margin: 5px 0;
        font-size: 16px;
        color: #666;
    }

    .social {
        margin-top: 20px;
    }

    .social a {
        font-size: 16px;
        padding: 5px 60px;
        text-decoration: none;
        background-color: #3498db;
        color: #fff;
        border-radius: 5px;
        margin: 0 5px;
        transition: background-color 0.3s;
    }

    .social a:hover {
        background-color: #2980b9;
    }
</style>


<style>
    /* Target the Razorpay button based on its attributes */
    .razorpay-payment-button {
        /* Add your custom styles here */
        background-color: #007bff; /* Blue background color */
        color: #fff; /* White text color */
        border: none; /* No border */
        padding: 10px 20px; /* Padding */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Cursor style */
    }

    /* Hover effect */
    .razorpay-payment-button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
</style>
@endsection
