@extends('layouts.app')
@section('title', 'Students')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            @include('common.alert')
            <!-- Row -->
          
            @hasanyrole('Manager|Super Admin|Staff')
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="page-title flex-wrap">
                                <div class="mb-md-0 mb-3">
                                    <h4>All Students</h4>
                                </div>
                                <div>

                                
                                 </div>
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
                                                            <th>Department</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($students as $key => $item)
                                                            <tr>
                                                                <td class="mb-0">
                                                                    {{ $item->name }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->institute }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->department }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->email }}
                                                                </td>
                                                                <td> 
                                                                    @if($item->department_id)
                                                                    <form action="{{ route('student.admin_add') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $item->institute_id }}" name="id">
                                                                        <input type="hidden" value="{{ $item->id }}" name="user_id">
                                                                        <input type="hidden" value="{{ $item->department_id}}" name="department_id">
                                                                        <button type="submit" class="btn btn-primary">Apply</button>
                                                                        @hasanyrole('Super Admin')
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#deleteModal{{ $key }}"
                                                                            class="btn btn-danger"><i class="fa fa-trash"
                                                                                aria-hidden="true"></i></a>
                                                                        @endhasanyrole
                                                                    </form>
                                                                    @else
                                                                    --
                                                                    @endif
                                                                   
                                                                </td>
                                                                {{-- Delete Modal --}}

                                                         <div class="modal fade"
                                                         id="deleteModal{{ $key }}" tabindex="-1"
                                                         aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                         <div class="modal-dialog modal-dialog-center">
                                                             <div class="modal-content">
                                                                 <div class="modal-header">
                                                                     <h5 class="modal-title"
                                                                         id="exampleModalLabel">
                                                                         Are You Sure??
                                                                     </h5>
                                                                     <button type="button" class="btn-close"
                                                                         data-bs-dismiss="modal"
                                                                         aria-label="Close"></button>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                     <p><strong>This action cannot be undone. The
                                                                             data will be permanently
                                                                             deleted.</strong></p>
                                                                 </div>
                                                                 <div class="modal-footer">
                                                                     <button type="button"
                                                                         class="btn btn-danger light"
                                                                         data-bs-dismiss="modal">Back</button>
                                                                     <a href="{{ route('users.destroy', $item->id) }}"
                                                                         class="btn btn-primary">Delete</a>

                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>

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
            @endhasanyrole
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
                                    columns: [0, 1, 2, 3]
                                }
                            },
    
                            {
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
    
                        ]
                    }
                }
            });
        </script>
@endsection
