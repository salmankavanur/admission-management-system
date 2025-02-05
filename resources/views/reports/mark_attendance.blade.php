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
                       
                       
                       
                    </div>
                    <div class="card-body">
                        {{-- <video id="video" width="300" height="300" autoplay></video> --}}
                        
                        <video id="preview" style="width: -webkit-fill-available;"></video>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')


<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>



{{-- <script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function(content) {
        alert('Scanned: ' + content);
    });
    Instascan.Camera.getCameras().then(function(cameras) {
        let rearCamera = cameras.find(function(camera) {
            return camera.name.indexOf('back') !== -1 || camera.name.indexOf('rear') !== -1;
        });
        if (rearCamera) {
            scanner.start(rearCamera);
        } else if (cameras.length > 0) {
            // If no rear camera found, fallback to the first available camera
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
</script> --}}

<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function(content) {
        // Check if the scanned content is a valid URL
        if (isValidURL(content)) {
            // Redirect the user to the scanned URL
            window.location.href = content;
        } else {
            // If the scanned content is not a valid URL, display an alert
            alert('Scanned content is not a valid URL: ' + content);
        }
    });

    // Function to check if the scanned content is a valid URL
    function isValidURL(url) {
        // Regular expression to match a URL pattern
        let pattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
        // Check if the scanned content matches the URL pattern
        return pattern.test(url);
    }

    Instascan.Camera.getCameras().then(function(cameras) {
        let rearCamera = cameras.find(function(camera) {
            return camera.name.indexOf('back') !== -1 || camera.name.indexOf('rear') !== -1;
        });
        if (rearCamera) {
            scanner.start(rearCamera);
        } else if (cameras.length > 0) {
            // If no rear camera found, fallback to the first available camera
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
</script>



@endsection
