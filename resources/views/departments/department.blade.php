@extends('layouts.app')
@section('title', 'Departments')

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
                <h4>All Departments</h4>
              </div>
              <div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  + New Department
                </button>
              </div>
            </div>
          </div>
          <!--column-->
          <div class="col-xl-12">
            <div class="card" id="accordion-one">

              <!--tab-content-->
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                  <div class="card-body p-0">
                    <div class="table-responsive">

                      <table class="display table" style="min-width: 845px" id="example">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institute</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Last Submission Date</th>
                            <th>Interview Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($departments as $key => $item)
                          <tr>
                            <td class="mb-0">
                              <div class="user-img">

                                <img src="{{ asset('department/logo/' . $item->logo) }}" alt="" class="avatar avatar-xl">
                                {{ $item->name }}
                              </div>
                            </td>
                            <td class="mb-0">
                              {{ $item->institute->name }}
                            </td>
                            <td class="mb-0">
                              <span class="badge 
                                {{ $item->payment_type == 0 ? 'badge-warning' :'badge-primary' }}">
                                {{ $item->payment_type == 0 ? 'Free' : 'Paid' }}
                              </span>
                            </td>
                            <td class="mb-0">
                              {{ $item->amount ?? '--' }}
                            </td>
                            <td class="mb-0">
                              {{ $item->last_date ?? '--' }}
                            </td>
                            <td class="mb-0">
                              {{ $item->interview_date ?? '--' }}
                            </td>
                            <td class="mb-0">
                              @if($item->status=='0')
                              <a href="#" data-bs-toggle="modal"
                              data-bs-target="#statuseModal{{ $key }}"
                              class="btn btn-danger">Pending</i></a>
                              @elseif($item->status=='1')
                              <a href="#" data-bs-toggle="modal"
                              data-bs-target="#statuseModal{{ $key }}"
                              class="btn btn-success">Complete</i></a>
                              @else
                              <a href="#"
                              class="btn btn-info">Unknown</i></a>
                              @endif
                          </td>
                            <td>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $key }}"><i class="fa fa-pen" aria-hidden="true"></i></a>
                            </td>
                            {{-- Delete Modal --}}

                            <div class="modal fade" id="deleteModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-center">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure??
                                      {{ $key }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p><strong>This action cannot be undone. The
                                        data will be permanently
                                        deleted.</strong></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Back</button>
                                    <a href="{{ route('department.delete', $item->id) }}" class="btn btn-primary">Delete</a>

                                  </div>
                                </div>
                              </div>
                            </div>


                            <!--  Edit Modal -->
                            <div class="modal fade" id="editModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-center">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Institute
                                      Deatils</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('department.update') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      <input type="hidden" value="{{ $item->id }}" name="id">
                                      <div class="row">
                                        <div class="col-xl-6">
                                          <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Institute
                                              Name</label>

                                            <input type="text" class="form-control" name="" placeholder="" required value="{{ $item->institute->name }}" readonly>




                                          </div>

                                          <div class="mb-3">
                                            <label for="exampleFormControlInput3" class="form-label">Department</label>
                                            <input type="text" class="form-control" name="department" placeholder="Department" required value="{{ $item->name }}">
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

                                                <img src="{{ asset('department/logo/' . $item->logo) }}" alt="" class="avatar avatar-xl" style="width: 4rem;
                                                        height: 4rem;">

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-xl-6">
                                          <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Institute Type</label>
                                            <select class="form-control" name="institute_type" id="institute_type" required>
                                              <option value="0" {{ $item->payment_type == '0' ? 'selected' : '' }}>Free</option>
                                              <option value="1" {{ $item->payment_type == '1' ? 'selected' : '' }}>Paid</option>
                                          </select>
                                          </div>
                                          <div class="mb-3" style="margin: 54px 0 0 0;">
                                            <label for="exampleFormControlInput3" class="form-label">Amount</label>
                                            <input type="number" class="form-control" name="amount" placeholder="Amount" value="{{ $item->amount }}">
                                          </div>
                            
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

                            <div class="modal fade" id="statuseModal{{ $key }}"
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
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"
                                            class="btn btn-danger light"
                                            data-bs-dismiss="modal">Back</button>
                                        <a href="{{ route('department.status_update', $item->id) }}"
                                            class="btn btn-primary">Update</a>

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
        <form action="{{ route('department.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-xl-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Institute Name</label>
                <select class="form-control" name="institute_id" id="institute_id" required>
                  @foreach ($institutes as $key => $institute)
                  <option value="{{ $institute->id }}">
                    {{ $institute->name }}
                  </option>
                  @endforeach


                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput3" class="form-label">Department</label>
                <input type="text" class="form-control" name="department" placeholder="Department" required>
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
            <div class="col-xl-6">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Institute Type</label>
                <select class="form-control" name="institute_type" id="institute_type" required>

                  <option value="0">Free</option>
                  <option value="1">Paid</option>



                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput3" class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount" placeholder="Amount">
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
    $('select').niceSelect();
    // $('#institute_type').niceSelect();
  </script>

<script>



  new DataTable('#example', {
  layout: {
      topStart: {
          buttons: [
              {
                  extend: 'csvHtml5',
                  exportOptions: {
                      columns: [0,1,2,3,4,5,6]
                  }
              },
             
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                  }
              },
              {
                  extend: 'pdfHtml5',
                  exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                  }
              },
              
          ]
      }
  }
});
</script>

  @endsection