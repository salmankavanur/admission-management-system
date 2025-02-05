<!DOCTYPE html>
<html lang="en">

{{-- Include Head --}}
@include('common.head')

<body>
    @yield('styles')
    <!-- Page Wra  pper -->
    <div id="main-wrapper" class="wallet-open active">

        <!-- Sidebar -->
        @include('common.sidebar')
        <!-- End of Sidebar -->




        <!-- Topbar -->
        @include('common.header')
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->


        <!-- Footer -->
        @include('common.footer')
        <!-- End of Footer -->


    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    @include('common.logout-modal')

    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <!-- Apex Chart -->
    <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <!--swiper-slider-->
    <script src="{{ asset('vendor/swiper/js/swiper-bundle.min.js') }}"></script>


    <!-- Datatable -->

    <!-- Datatable -->
    {{-- <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script> --}}


    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src=" https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>





    
    
    
    
    
    
    
    








    <!-- Dashboard 1 -->
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('vendor/wow-master/dist/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }}"></script>

    <script src="{{ asset('js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>



    @yield('scripts')
</body>

</html>
