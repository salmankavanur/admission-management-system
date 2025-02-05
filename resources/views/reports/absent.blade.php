@extends('layouts.app')
@section('title', 'Absentees Report')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            @include('common.alert')
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="page-title flex-wrap">
                                <div class="mb-md-0 mb-3">
                                    <h4>Absentees</h4>
                                </div>
                                <div>


                                </div>
                            </div>
                        </div>
                        <!--column-->
                        <div class="col-xl-12">
                            <div class="card" id="accordion-one">

                                <!--tab-content-->
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="Preview" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">

                                                <table class="display table" style="min-width: 845px" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Institute</th>
                                                            <th>Attendance Time</th>
                                                            <th>Attendance Taken By</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($students as $key => $item)
                                                        <tr>
                                                            <td class="mb-0">
                                                                {{ $item->name }}
                                                            </td>
                                                            <td class="mb-0">
                                                                {{ $item->institute->name }}
                                                            </td>
                                                            <td class="mb-0">
                                                                {{ $item->attendance_time ?? 'Not Available' }}
                                                            </td>
                                                            <td class="mb-0">
                                                                {{ $item->attendance_taken_by ?? 'Not Available'}}
                                                            </td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                     
                        <!--/column-->
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('scripts')

    <script>
        $('#update').niceSelect();
    </script>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, ':visible']
                            }
                        },
    
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, ':visible']
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, ':visible']
                            }
                        },
    
                    ]
                }
            }
        });
    </script>
@endsection
