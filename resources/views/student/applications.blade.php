@extends('layouts.app')
@section('title', 'Applications')

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
                                    <h4>All Applications</h4>
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
                                                        <th>Payment Mode</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($students as $key => $student)
                                                        <tr>
                                                            
                                                            <td class="mb-0">
                                                                {{ $student->name }}
                                                            </td>
                                                            <td class="mb-0">
                                                                {{ $student->institute->name }}
                                                            </td>
                                                            <td class="mb-0">
                                                                {{ $student->department->name }}
                                                            </td>
                                                            <td class="mb-0">
                                                                {{ $student->email }}
                                                            </td>
                                                            <td class="mb-0">
                                                                @hasanyrole('Super Admin|Manager')
                                                                    @if ($student->free == 1)
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#freemodal{{ $key }}"
                                                                            class="badge badge-success"><span>Free</span></a>
                                                                    @elseif($student->free == 0)
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#freemodal{{ $key }}"
                                                                            class="badge badge-success"><span>Regular</span></a>
                                                                    @else
                                                                        --
                                                                    @endif
                                                                @endhasanyrole
                                                                @hasanyrole('Staff')
                                                                    @if ($student->free == 1)
                                                                        <a href="#"
                                                                            class="badge badge-success"><span>Free</span></a>
                                                                    @elseif($student->free == 0)
                                                                        <a href="#"
                                                                            class="badge badge-success"><span>Regular</span></a>
                                                                    @else
                                                                        --
                                                                    @endif
                                                                @endhasanyrole
                                                                {{-- Free Modal --}}

                                                                <div class="modal fade" id="freemodal{{ $key }}"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-center">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Are You Sure??
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p><strong>Are You Sure You Want To Swap
                                                                                        This
                                                                                        Student's Payment Mode</strong></p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger light"
                                                                                    data-bs-dismiss="modal">Back</button>
                                                                                <a href="{{ route('student.paid_free', $student->id) }}"
                                                                                    class="btn btn-primary">Proceed</a>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                @if ($student->status == 1)
                                                                    <span class="badge badge-success">Approved</span>
                                                                @elseif($student->status == 0)
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @elseif($student->status == 3)
                                                                    <span class="badge badge-success">Qualified</span>
                                                                @else
                                                                    <span class="badge badge-danger">Rejected</span>
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @hasanyrole('Super Admin|Manager')
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal{{ $key }}"
                                                                        class="btn btn-danger"><i class="fa fa-trash"
                                                                            aria-hidden="true"></i></a>
                                                                            @if ($student->status != 2 && $student->status != 3)
                                                                            <a data-bs-toggle="modal"
                                                                                data-bs-target="#update_statusmodal{{ $key }}"
                                                                                class="btn btn-info">Update Status</a>
                                                                        @endif
                                                                @endhasanyrole
                                                                <a href="{{ route('student.view', $student->user_id) }}"
                                                                    class="btn btn-primary"><i class="fa fa-eye"
                                                                        aria-hidden="true"></i></a>

                                                                
                                                                   
                                                              
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
                                                                         <a href="{{ route('student.delete', $student->id) }}"
                                                                             class="btn btn-primary">Delete</a>

                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                         

                                                          {{-- Update Status Modal --}}

                                                          <div class="modal fade"
                                                          id="update_statusmodal{{ $key }}" tabindex="-1"
                                                          aria-labelledby="exampleModalLabel"
                                                          aria-hidden="true">
                                                          <div class="modal-dialog modal-dialog-center">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                      <h5 class="modal-title">
                                                                        
                                                                      </h5>
                                                                      <button type="button" class="btn-close"
                                                                          data-bs-dismiss="modal"
                                                                          aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('student.update',$student->id) }}"
                                                                        method="post" id="{{ $key }}">
                                                                        @csrf
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <select class="form-control"
                                                                                        name="update" id="update">
                                                                                        <option value="1">Approve
                                                                                        </option>
                                                                
                                                                                        <option value="2">Reject
                                                                                        </option>
                                                                                        <option value="3">
                                                                                            Qualified
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('update')
                                                                                        <span class="text-danger">
                                                                                            {{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger light"
                                                                                    data-bs-dismiss="modal">Back</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Update</a>
                                                                            </div>
                                                                     </form>
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

    </div>
    </div>


@endsection
@section('scripts')

    <script>
        $('select').niceSelect();
    </script>


    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },

                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },

                    ]
                }
            }
        });
    </script>
@endsection

