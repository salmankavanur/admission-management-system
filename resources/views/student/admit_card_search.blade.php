@extends('layouts.app')
@section('title', 'Students')

@section('content')

    <div class="content-body">


        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                @include('common.alert')
                <div class="widget-stat card" style="max-width: 500px;text-align:center;">
                   
                    <div class="card-body">
                        <div class="media ai-icon">
                            <div class="media-body">
                                Search Admit Card With Application ID or Mobile Number
                                <form action="{{ route('student.admit_card_result') }}" method="post">
                                    @csrf
                                    <div class="mb-3" style="margin: 26px 0;">
    
    
    
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Application No./Mobile No." required>
                                        @error('search')
                                            <span class="text-danger">
                                                {{ $message }}</span>
                                        @enderror
    
    
    
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Search</button>
    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        




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
@endsection
