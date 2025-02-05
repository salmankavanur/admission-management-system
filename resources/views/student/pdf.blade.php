<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway&display=swap">

    <style>
        * {
            box-sizing: border-box
        }

        html {
            background: url(//css-tricks.com/examples/OnePageResume/images/noise.jpg)
        }

        body {
            margin: 2.2rem;
            /* font-family: 'Raleway', sans-serif; */
            line-height: 0;
        }

        div#resume {
            min-width: 310px;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            /* This sets the font weight to Thin */
            /* line-height: 0px; */
            color: #000
        }

        div#resume h1 {
            margin: 0 0 16px 0;
            padding: 0 0 16px 0;
            font-size: 42px;
            font-weight: bold;
            letter-spacing: -2px;
           
        }

      

        div#resume p {
            margin: 0 0 16px 0
        }

        div#resume a {
            color: #999;
            text-decoration: none;
            border-bottom: 1px dotted #999
        }

       

        div#resume p.objective {
            font-family: Georgia, serif;
            font-style: italic;
            color: #666
        }

        div#resume dt {
            font-style: italic;
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            padding: 0 26px 0 0;
            width: 150px;
            border-right: 1px solid #999
        }

     

       

        .profile {
            float: right;
            padding: 10px;
            background: #fff;
            margin: 0 30px;
            transform: rotate(-4deg);
            box-shadow: 0 0 4px rgba(0, 0, 0, .3);
            width: 30%;
            max-width: 220px
        }

        .declare {
                margin: 0;
                width: 100%;
                float: left;
                text-align: center;
                line-height: 26px;
                padding: 0 4%;
                border: solid;
                border-width: 1px;
                border-radius: 16px;
                margin-top: 6%;
                width: 100%;
                float: left
            }

            .footer {
                margin: 0;
                width: 100%;
                float: left;
                text-align: center;
                line-height: 26px;
                padding: 0 4%;
                
                margin-top: 2%;
                width: 100%;
                float: left
            }
            .image{
                
            padding: 10px;
            background: #fff;
            margin: 0 30px;
          
            box-shadow: 0 0 4px rgba(0, 0, 0, .3);
            width: 14%;
            max-width: 220px;
            border-radius: 34px
            }
            .image1{
                float: right;
            padding: 10px;
            background: #fff;
            margin: 0 30px;
          
            box-shadow: 0 0 4px rgba(0, 0, 0, .3);
            width: 30%;
            max-width: 220px
            }

      
    </style>
</head>

<body style="background: url(//css-tricks.com/examples/OnePageResume/images/noise.jpg);">
    <div id="resume">
        <img src="{{ asset('profile/' . $student->profile_photo) }}" alt="NA" class="profile">
        <h1 style="color: green">{{ $student->name }}</h1>
        <h2 style="margin: 0 0 18px 0;">{{ $student->institute->name }} - {{ $student->department->name }}</h2>
        <hr>
        <h3 style="color: green">Personal - Basics</h3>
        <table style="line-height: 1;">
            <tr>
                <td style="width: 50%">
                    <h4>Address:</h4>
                </td>
                <td style="line-height: 130%;">{{ $student->address }} <br>
                    {{ $student->city }} <br>
                    {{ $student->state }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <h4> Phone/Whatsapp:</h4>
                </td>
                <td>{{ $student->mobile ?? '--' }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <h4> Email:</h4>
                </td>
                <td>{{ $student->email ?? '--' }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <h4>Date Of Birth:</h4>
                </td>
                <td>{{ $student->dob ?? '--' }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <h4>Nationality:</h4>
                </td>
                <td>{{ $student->nationality ?? '--' }}

                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <h4>Religion:</h4>
                </td>
                <td>{{ $student->religion ?? '--' }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <h4>Gender:</h4>
                </td>
                <td>{{ $student->gender == 1 ? 'Male' : 'Femaile' }}
                </td>
            </tr>

        </table>

        <hr>
        <div style="width: 100%">
            <div style="width: 50%;float: left;">

                <h3 style="color: green">Personal - Parents</h3>
                <table style="line-height: 1;">
                    <tr>
                        <td style="width: 60%">
                            <h4>Father/Guardian Name</h4>
                        </td>
                        <td>{{ $student->father_name ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Occupation</h4>
                        </td>
                        <td>{{ $student->father_occupation ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Mother Name</h4>
                        </td>
                        <td>{{ $student->mother_name ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Occupation</h4>
                        </td>
                        <td>{{ $student->mother_occupation ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            
                        </td>
                        <td></td>
                    </tr>
                </table>

            </div>
            <div style="width: 50%; float: right;">
                <h3 style="color: green">Qualification Education</h3>
                <table style="line-height: 1;">
                    <tr>
                        <td style="width: 60%">
                            <h4>Admission To</h4>
                        </td>
                        <td>{{ $student->grade ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Last Islamic Education</h4>
                        </td>
                        <td>{{ $student->islamic_qualfication ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Passed Out Year</h4>
                        </td>

                        <td>{{ $student->islamic_year ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Last Secular Education</h4>
                        </td>

                        <td>{{ $student->secular_qualfication ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Passed Out Year</h4>
                        </td>
                        <td>{{ $student->secular_year ?? '--' }}</td>
                    </tr>
                </table>
            </div>
        </div>
       

        <div style="width: 100%;float:left">
            <hr>
            <div style="width: 50%;float: left;">

                <h3 style="color: green">Aims/Hobbies</h3>
                <table style="line-height: 1;">
                    <tr>
                        <td style="width: 60%">
                            <h4>Aim 1</h4>
                        </td>
                        <td>{{ $student->aim_1 ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Aim 2</h4>
                        </td>
                        <td>{{ $student->aim_2 ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Aim 3</h4>
                        </td>
                        <td>{{ $student->aim_3 ?? '--' }}</td>
                    </tr>

                </table>

            </div>
            <div style="width: 50%; float: right;">
                <h3 style="color: green"></h3>
                <table style="line-height: 1;">
                    <tr>
                        <td style="width: 60%">
                            <h4>Hobbies:</h4>
                        </td>
                        <td>{{ $student->hobbies ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <h4>Activities:</h4>
                        </td>
                        <td>{{ $student->activites ?? '--' }}</td>
                    </tr>


                </table>
            </div>
        </div>
        
        <div style="" class="declare">
            <h3 style="color: red">DECLARATION</h3>
            <p>
                I hereby declare that the information provided above is true to the best of my knowledge
                and belief. In case any information is found to be false, my admission may be canceled and I agree with
                all rules and regulations of this institution from the time of admission.
                <br>
                <div style="width: 100%;float:left;text-align:justify">
                    <div style="width: 50%;float: left;">
                        Date & Time: {{ $student->created_at }}
                    </div>
                    <div style="width: 19%;float: right;">
                        Signature: 
                        <img src="{{ asset('signature/' . $student->signature) }}" alt="NA" class="profile">
                    </div>
                </div>
                 
            </p>

        </div>

        <div style="" class="footer">
           
                
                    <div style="width: 100%;float: left;text-align:center">
                        <div style="width:50%;float:left">
                            <img src="{{ asset('institute/logo/' . $student->institute->logo) }}" alt="NA" class="image">
                        </div>
                        <div style="width:50%;float:right">
                            <img src="{{ asset('department/logo/' . $student->department->logo) }}" alt="NA" class="image">
                        </div>
                        
                       
                       
                        
                   
                    </div>
                    <div style="width: 100%;float: left;text-align:center">
                       
                        <div style="width:50%;float:left;line-height: 0;">
                            <h3>{{ $student->institute->name }}</h3> <br>
                            <h4>{{ $student->institute->address }} - {{ $student->institute->city }}</h4>
                        </div>
                        <div style="width:50%;float:right;line-height: 0;">
                            <h3>{{ $student->department->name }}</h3>
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
