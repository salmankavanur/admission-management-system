@extends('layouts.app')

@section('title', 'Notification')

@section('content')

    <div class="content-body">
        <div class="container-fluid">
            @include('common.alert')
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-0">Notify Template</h5>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-0" style="float: left"> Notification Template.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <form method="POST" enctype="multipart/form-data" action="{{ route('settings.template_store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-10 col-lg-8">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">



                                                <div class="mb-3">

                                                    <label for="fullname" class="form-label text-primary">Template Text<span
                                                            class="required">*</span></label>
                                                    <input type="text" class="form-control" name="message"
                                                        value="{{ $template->message ?? '' }}" maxlength="50">
                                                        <small class="form-text text-muted">Maximum 50 characters</small>
                                                    @error('message')
                                                        <span class="text-danger">
                                                            {{ $message }}</span>
                                                    @enderror
                                                    



                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    {{-- <button type="button" class="btn btn-outline-primary ms-3">Save as Draft</button> --}}
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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


@endsection
