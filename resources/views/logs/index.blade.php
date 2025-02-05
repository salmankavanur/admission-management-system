@extends('layouts.app')
@section('title', 'Logs')

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
                                    <h4>Logs</h4>
                                </div>
                                <div>

                                    <!-- Button trigger modal -->
                                  
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
                                                            <th>User</th>
                                                            <th>Description</th>
                                                            <th>Admin/Manager</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($logs as $key => $item)
                                                            <tr>
                                                                <td class="mb-0">
                                                                    {{ $item->user->name }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->description }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    @if($item->user_id != $item->admin_id)
                                                                    {{ $item->admin->name }}
                                                                    @else
                                                                    --
                                                                    @endif
                                                                </td>
                                                               
                                                               


                                                            </tr>
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