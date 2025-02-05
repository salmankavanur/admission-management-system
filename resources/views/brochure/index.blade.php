@extends('layouts.app')
@section('title', 'Prospectus')

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
                <h4>All Prospectus</h4>
              </div>
              <div>
                @hasanyrole('Manager')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  + New Prospectus
                </button>
                @endhasanyrole
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
                            <th>Institute Name</th>
                            <th>Department Name</th>
                            <th>Prospectus</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($brochures as $key => $item)
                          <tr>
                            <td class="mb-0">

                              {{ $item->institute->name }}

                            </td>
                            <td class="mb-0">
                              {{ $item->department->name }}
                            </td>
                            <td class="mb-0">
                              <a href="{{ asset('brochure/'.$item->file) }}" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i></a>
                            </td>



                            <td>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              
                            </td>
                            {{-- Delete Modal --}}

                            <div class="modal fade" id="deleteModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-center">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Are You Sure??
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
                                      <a href="{{ route('brochures.delete', $item->id) }}" class="btn btn-primary">Delete</a>

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
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Prospectus Deatils</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('brochures.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">


            <div class="mb-3">
              <label for="department" class="form-label text-primary">Department<span class="required">*</span></label>
              <select class="form-control" name="department" id="department">

                @foreach ($departments as $key=>$department )
                <option value="{{ $department->id }}">
                  {{ $department->name }}
                </option>
                @endforeach


              </select>
              @error('department')
              <span class="text-danger">
                {{ $message }}</span>
              @enderror

              </select>
              {{-- @endhasanyrole --}}
            </div>


            <div class="mb-3">
              <label class="form-label text-primary">Brochure</label><span class="required">*</span>
              <input type="file" class="form-control" name="brochure" accept=".pdf">


              @error('brochure')
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
  $('select').niceSelect();


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