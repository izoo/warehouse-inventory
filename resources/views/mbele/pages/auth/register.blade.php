@extends('mbele.app')
@section('content')
<div class="page-header--section text-center">
    
    <div class="page--breadcrumb font--secondary">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{('/')}}">PHONE FIX</a></li>
                <li class="active"><span>REGISTER</span></li>
            </ul>
        </div>
    </div>
</div>
<div id="appointment" class="appointment--section ">
    <div class="">
        <div class="row pd--80-0-40">
            <div class="appointment--form col-md-12 col-sm-12 col-lg-12 col-xs-12" data-form="ajax">
                <form method="post" class="container" id="registerUser">
                    <!-- <input type="hidden" name="submitType" value="ajax" /> -->
                  <div class="section--title">
                  <h2 class="h2">REGISTER</h2>  
                  </div>
                    <div class="status"></div>
                    <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">
                            <label for="">Your Name</label>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name" class="form-control" required />
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">

                            <label for="">Your Phone Number</label>
                            <div class="form-group">
                                <input type="tel" name="phone_no" placeholder="Phone Number" class="form-control" />
                            </div>
                        </div>
                      



                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">

                            <label for="">Email</label>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-mail Address" class="form-control"
                                    required />
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                            <label for="">Password</label>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" data-trigger="time" required />
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                            <label for="">Confirm Password</label>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control"
                                    required />
                            </div>
                        </div>
                     

                    </div>

                    <button type="submit" id="btnUser" class="btn btn-block btn-lg btn-default">
                        REGISTER
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Register New User
    $('#registerUser').on('submit', (function(e) {
        //alert("You Are Good To Go");
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('register.store') }}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#btnUser').html('Creating Account....');
            },
            success: function(response) {
                if ($.isEmptyObject(response.user_errors)) {
                    //$('#myModal').modal('toggle');
                    $("#user_errors").fadeOut(1000, function() {


                    });

                    swal({
                        title: 'Success!',
                        text: "Account Successfully Created!",
                        type: 'success',
                        padding: '2em'
                    });
                    // $('#products_table').DataTable().ajax.reload();

                    $('#registerUser').trigger("reset");

                    $("#btnUser").html('REGISTER');
                    setTimeout(' window.location.href = "{{route("user.login")}}"; ',3000);


                    // table.ajax.reload();
                } else {
                    $("#user_errors").fadeIn(1000, function() {
                        printErrorMsg(response.user_errors, 'user_errors');
                        $("#btnUser").html('REGISTER');
                    });
                }
            }
        });

    }));
    //End

})
</script>

@endpush