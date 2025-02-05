<!DOCTYPE html>
<html lang="en">

{{-- Head Before AUTH--}}
@include('auth.includes.head')

<body class="body  h-100">

    <div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="login-aside text-center  d-flex flex-column flex-row-auto">
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <div class="text-center mb-lg-4 mb-2 pt-5 logo">
                  <h3><span style="color: #FB7D5B">A</span><span style="color: white">dmission</span> <span style="color: #FB7D5B">M</span><span style="color: white">anagement</span> <span style="color: #FB7D5B">S</span><span style="color: white">ystem</span></h3> 
                </div>
                <h3 class="mb-2 text-white">Welcome Back! <br/> Take a step ahead :)</h3>
                <p class="mb-4">An Unique & Centralized <br>Admission Management System</p>
            </div>
      
            <div class="aside-image position-relative" style="background-image:url(images/background/asset1.svg);background-size: 50% 50%; background-repeat: no-repeat; background-position: center;">
                <img class="img1 move-1" src="{{ asset('images/background/asset2.svg') }}" alt="">
                <img class="img2 move-2" src="{{ asset('images/background/asset3_no_bg.svg') }}" alt="">
                <img class="img3 move-3" src="{{ asset('images/background/asset4.svg') }}" alt="">
                
            </div>
        </div>
        
        {{-- Content Goes Here FOR Before AUTH --}}
        @yield('content')
    </div>
   


    @yield('scripts')

    {{-- Scripts Before AUTH --}}
    @include('auth.includes.scripts')

</body>

</html>
