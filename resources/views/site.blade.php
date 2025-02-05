@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            @include('common.alert')
            <!-- Row -->
            <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                <div class="widget-stat card bg-primary">
                    <div class="card-body p-4">
                        <div class="media">
                           
                            <div class="media-body text-white">
                                <p class="mb-1 text-white"><a type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Update Site Logo</a></p>

                            </div>
                            <span class="me-3">
                                <div class="user-img">
                                    @if(isset($logo->site_logo))
                                        <img src="{{ asset('site/logo/'.$logo->site_logo ) }}" alt="" class="avatar avatar-xl">
                                    @endif
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
                 <!--  Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Site Logo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('settings.logo_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
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
    </div>

@endsection

