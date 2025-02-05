<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
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

</head>
<body>
    <div class="content-body">
      
      


        <div class="col-md-12">
            <div class="widget-stat card" style="max-width: 400px;">
                <div class="user-media">
                    <img src="{{ asset('profile/' . $student->profile_photo) }}" alt=""
                        class="avatar avatar-xxl">
                </div>
                <div class="card-body">
                    <div class="media ai-icon">
                        <h2  style="text-align: center">{{ $student->name }}</h2>
                        <div class="media-body" style="margin: 0 0 0 55px;">
                           
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

                        {!! QrCode::size(250)->generate($encryptedStudentID) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
  
</div>
<script>
     window.onload = function() {
         window.print();
    };
</script>
</body>
</html>
   


