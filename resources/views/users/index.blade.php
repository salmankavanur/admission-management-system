@extends('layouts.app')
@section('title', 'Users')

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
                                    <h4>All Users</h4>
                                </div>
                                <div>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        + New User
                                    </button>
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
                                                            <th>User Name</th>
                                                            <th>Email</th>
                                                            <th>Contact</th>
                                                            <th>Institute</th>
                                                            @hasanyrole('Manager')
                                                            <th>Department</th>
                                                            @endhasanyrole
                                                            <th>Status</th>
                                                            <th>Role</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($users as $key => $item)
                                                            @if ($item->role->name != 'Super Admin')
                                                                <tr>
                                                                    <td class="mb-0">
                                                                        {{ $item->name }}
                                                                    </td>
                                                                    <td class="mb-0">
                                                                        {{ $item->email }}
                                                                    </td>
                                                                    <td class="mb-0">
                                                                        {{ $item->mobile_number ?? '--' }}
                                                                    </td>
                                                                    <td class="mb-0">
                                                                        {{ $item->institute_name ?? '--' }}
                                                                    </td>
                                                                    @hasanyrole('Manager')
                                                                        @if($item->role->name == 'Staff')
                                                                            <td class="mb-0">
                                                                                {{ $item->department_name ?? '--' }}
                                                                            </td>
                                                                        @else
                                                                        <td class="mb-0">
                                                                            --
                                                                        </td>
                                                                        @endif
                                                                    @endhasanyrole
                                                                    <td>
                                                                        @if ($item->status == 1)
                                                                            <button
                                                                                class="btn light btn-success">Active</button>
                                                                        @else
                                                                            <button class="btn light btn-danger">
                                                                                Disable</button>
                                                                        @endif

                                                                    </td>
                                                                    <td class="mb-0">
                                                                        @if ($item->role->name == 'Admin')
                                                                            <span
                                                                                class="badge badge-success">{{ $item->role->name }}</span>
                                                                        @elseif($item->role->name == 'Manager')
                                                                            <span
                                                                                class="badge badge-warning">{{ $item->role->name }}</span>
                                                                        @elseif($item->role->name == 'Staff')
                                                                            <span
                                                                                class="badge badge-danger">{{ $item->role->name }}</span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-primary">{{ $item->role->name }}</span>
                                                                        @endif

                                                                    </td>
                                                                    <td>
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#deleteModal{{ $key }}"
                                                                            class="btn btn-danger"><i class="fa fa-trash"
                                                                                aria-hidden="true"></i></a>
                                                                        <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#statusmodal{{ $key }}"
                                                                            class="btn btn-info"><i
                                                                                class="fa fa-toggle-on"
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
                                                                                        id="exampleModalLabel">Are You
                                                                                        Sure??
                                                                                        </h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><strong>This action cannot be undone.
                                                                                            The
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


                                                                     {{-- Update Status --}}

                                                                     <div class="modal fade"
                                                                     id="statusmodal{{ $key }}" tabindex="-1"
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                     <div class="modal-dialog modal-dialog-center">
                                                                         <div class="modal-content">
                                                                             <div class="modal-header">
                                                                                 <h5 class="modal-title"
                                                                                     id="exampleModalLabel">Are You
                                                                                     Sure??
                                                                                     </h5>
                                                                                 <button type="button" class="btn-close"
                                                                                     data-bs-dismiss="modal"
                                                                                     aria-label="Close"></button>
                                                                             </div>
                                                                             <div class="modal-body">
                                                                                 <p><strong>This action will @if($item->status==1) <span class="btn light btn-danger">disable</span> @else <span class="btn light btn-success"> Enable</span> @endif the user.  </strong></p>
                                                                             </div>
                                                                             <div class="modal-footer">
                                                                                 <button type="button"
                                                                                     class="btn btn-danger light"
                                                                                     data-bs-dismiss="modal">Back</button>
                                                                                 <a href="{{ route('users.status', $item->id) }}"
                                                                                     class="btn btn-primary">Go Ahead</a>

                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>



                                                                </tr>
                                                            @endif
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

         <!--  Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New User Deatils</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">User Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="User"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput3" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email"
                                        required>

                                       
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block">Role</label>
                                    <select class="form-control" id="role" name="role">
                                        @foreach ($roles as $key=>$role )
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>                                       
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          
                            <div class="col-xl-6">
                                
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label">Contact</label>
                                    <input type="text" class="form-control" name="contact" placeholder="Contact">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput3" class="form-label">Institute</label>
                                    <select class="form-control"  name="institute" id="institute" required>
                                        <option selected disabled>Select Institite</option>
                                        @foreach ($institutes as $key => $institute)
                                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('institute')
                                    <span class="text-danger">
                                                {{ $message }}</span>
                                    @enderror
                                </div>
                                @hasanyrole('Manager')
                                <div class="mb-3" style="margin: 56px 0 0 0;">
                                    <label for="exampleFormControlInput3" class="form-label">Department</label>
                                    <select class="form-control"  name="department" id="department" required>
                                        <option selected disabled>Select Department</option>
                                        @foreach ($departments as $key => $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <span class="text-danger">
                                                {{ $message }}</span>
                                    @enderror
                                </div>
                                @endhasanyrole
                              
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection
@section('scripts')

<script>
      $('select').niceSelect();
</script>
@endsection