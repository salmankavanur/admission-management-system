@extends('layouts.app')
@section('title', 'Additional Fields')

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
                                    <h4>Additional Fields</h4>
                                </div>
                                @if($count < 1)
                                <div class="col-md-12">
                                    <div class="row">
                                      
                                        <div class="co-md-6">
                                            <a href="{{ route('forms.index') }}" class="btn btn-primary">Pre Define Form</a>
                                        </div>
                                        <div class="co-md-6">
                                            <p class="mb-0" style="float: left">
                                                <span
                                               class="required">Make Sure All the Questions Before Submission.This Form Is Not Editable</span> </p>
                                        </div>
                                    </div>
                                   
                                   
                                        
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--column-->
                        <div class="col-xl-12">
                            <div class="card" id="accordion-one">
                                @if($count > 0)
                                <table class="display table" style="min-width: 845px" id="example">
                                    <thead>
                                        <tr>
                                            <th>Questions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($form_data as $key => $item)
                                            <tr>
                                                <td class="mb-0">
                                                    {{ $item->questions }}
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <form name="add_name" id="add_name">

                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>


                                    <div class="alert alert-success print-success-msg" style="display:none">
                                        <ul></ul>
                                    </div>


                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                                <td><input type="text" name="que[]" placeholder="Question"
                                                        class="form-control name_list" required/></td>
                                                <td><button type="button" name="add" id="add"
                                                        class="btn btn-success">Add More</button></td>
                                            </tr>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="button" name="submit" id="submit" class="btn btn-info"
                                                    value="Submit" style="margin: 0 0 0 21px;" />

                                            </div>
                                        </div>

                                    </div>


                                </form>

                                @endif
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
        $(document).ready(function() {

            var postURL = "{{ route('forms.save') }}";
            var i = 1;

            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added"><td><input type="text" name="que[]" placeholder="Question" class="form-control name_list" required /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $('#submit').click(function() {
                $.ajax({

                    url: postURL,
                    method: "POST",
                    data: {
                        // Include CSRF token in the data
                        '_token': '{{ csrf_token() }}',
                        // Serialize form data
                        'formData': $('#add_name').serialize()
                    },
                    dataType: 'json', // Specify the dataType here
                    success: function(data) {
                        if (data.error) {
                            printErrorMsg(data.error);
                        } else {
                            // Show success message
                            $(".print-success-msg").find("ul").html('');
                            $(".print-success-msg").css('display', 'block');
                            $(".print-error-msg").css('display', 'none');
                            $(".print-success-msg").find("ul").append(
                                '<li>Record Inserted Successfully.</li>');

                            // Reset form and remove added rows
                            i = 1;
                            $('.dynamic-added').remove();
                            $('#add_name')[0].reset();

                            // Reload the page after 2 seconds
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    }

                });
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $(".print-success-msg").css('display', 'none');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });
    </script>

@stop
