@extends('layouts.app')
@section('title', 'Institute')

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
                                    <h4>All Institutes</h4>
                                </div>
                                <div>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        + New Institute
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
                                                            <th>Name</th>
                                                            <th>City</th>
                                                            <th>Address</th>
                                                            <th>Contact</th>
                                                           
                                                            
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($institutes as $key => $item)
                                                            <tr>
                                                                <td class="mb-0">

                                                                    <div class="user-img">

                                                                        <img src="{{ asset('institute/logo/'.$item->logo) }}" alt=""
                                                                            class="avatar avatar-xl">
                                                                        {{ $item->name }}
                                                                    </div>
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->city }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->address }}
                                                                </td>
                                                                <td class="mb-0">
                                                                    {{ $item->contact }}
                                                                </td>
                                                                
                                                                
                                                                <td>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal{{ $key }}"
                                                                        class="btn btn-danger"><i class="fa fa-trash"
                                                                            aria-hidden="true"></i></a>
                                                                    <a href="#" class="btn btn-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editModal{{ $key }}"><i
                                                                            class="fa fa-pen" aria-hidden="true"></i></a>
                                                                </td>

                                                                {{-- Delete Modal --}}

                                                                <div class="modal fade" id="deleteModal{{ $key }}"
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
                                                                                <p><strong>This action cannot be undone. The
                                                                                        data will be permanently
                                                                                        deleted.</strong></p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger light"
                                                                                    data-bs-dismiss="modal">Back</button>
                                                                                <a href="{{ route('institute.delete', $item->id) }}"
                                                                                    class="btn btn-primary">Delete</a>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                 {{-- status Modal --}}

                                                                


                                                                <!--  Edit Modal -->
                                                                <div class="modal fade" id="editModal{{ $key }}"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-center">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="exampleModalLabel">Edit Institute
                                                                                    Deatils</h1>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('institute.update') }}"
                                                                                    method="post" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden"
                                                                                        value="{{ $item->id }}"
                                                                                        name="id">
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleFormControlInput1"
                                                                                                    class="form-label">Institute
                                                                                                    Name</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="name"
                                                                                                    placeholder="Institute"
                                                                                                    required
                                                                                                    value="{{ $item->name }}">
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleFormControlInput3"
                                                                                                    class="form-label">City</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="city"
                                                                                                    placeholder="City"
                                                                                                    required
                                                                                                    value="{{ $item->city }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div class="mb-3">
                                                                                                <label
                                                                                                    for="exampleFormControlInput2"
                                                                                                    class="form-label">Contact</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="contact"
                                                                                                    placeholder="Contact"
                                                                                                    required
                                                                                                    value="{{ $item->contact }}">
                                                                                            </div>
                                                                                            <label
                                                                                                class="form-label d-block">Address</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="address"
                                                                                                placeholder="Address"
                                                                                                required
                                                                                                value="{{ $item->address }}">
                                                                                        </div>
                                                                                       


                                                                                        <div class="col-xl-6">
                                                                                            <div class="mb-3">
                                                                                                <label class="form-label text-primary">Logo</label><span class="required">*</span>
                                                                                                <input type="file" class="form-control" name="logo" accept=".png,.jpg,.jpeg">
                                                                
                                                                                                @error('logo')
                                                                                                    <span class="text-danger">
                                                                                                        {{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                               
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div class="mb-3">
                                                                                                
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <div class="user-img">

                                                                                                    <img src="{{ asset('institute/logo/'.$item->logo) }}" alt=""
                                                                                                        class="avatar avatar-xl" style="width: 4rem;
                                                                                                        height: 4rem;">
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger light"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Save</button>
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



    <!--  Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Institute Deatils</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('institute.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Institute Name</label><span
                                        class="required">*</span>
                                    <input type="text" class="form-control" name="name" placeholder="Institute"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput3" class="form-label">City</label><span
                                        class="required">*</span>
                                    <input type="text" class="form-control" name="city" placeholder="City"
                                        required>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput2" class="form-label">Contact</label><span
                                        class="required">*</span>
                                    <input type="text" class="form-control" name="contact" placeholder="Contact"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label><span class="required">*</span>
                                    <input type="text" class="form-control" name="address" placeholder="Address"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-primary">Logo</label><span class="required">*</span>
                                <input type="file" class="form-control" name="logo" accept=".png,.jpg,.jpeg">

                                @error('logo')
                                    <span class="text-danger">
                                        {{ $message }}</span>
                                @enderror
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


@endsection
@section('scripts')
<script>



    new DataTable('#example', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
               
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                
            ]
        }
    }
});
</script>

@endsection
