@extends('admin.app')
@section('title') Change Password @endsection
@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="container">
        <!-- New device Div -->
        <div class="layout-px-spacing profil" id="new-device">
            <div class="row layout-top-spacing">
                <div id="flFormsGrid" class="col-lg-12 layout-spacings">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-center">Change Password</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div id="passwordError"
                                        class="alert alert-danger print-error-msg w3-padding-right w3-padding-left"
                                        style="display:none;">
                                        <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                        <ul class="w3-ul" style="list-style:none;">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content">
                            <form class="form-horizontal" id="formPassword" method="post">
                                <input type="hidden" name="hidden_user_id" value="{{ Auth::user()->id}}">
                                <div id="userErrors"
                                    class="alert alert-danger print-error-msg w3-padding-right w3-padding-left"
                                    style="display:none;">
                                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                    <ul class="w3-ul" style="list-style:none;">

                                    </ul>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-6 col-lg-6">
                                        <label class=" control-label">Old Password</label>
                                        <div class="">
                                            <input type="password" name="old_password" id="old_password"
                                                class="form-control input-lg">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label class=" control-label">New  Password</label>
                                        <div class="">

                                            <input type="password" id="new_password" name="new_password"
                                                class="form-control input-lg">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mb-3">

                                   
                                </div> -->
                                <div class="row mb-3">

                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label class=" control-label">Confirm New Password</label>
                                        <div class="">

                                            <input id="confirm_password" name="confirm_password"
                                                class="form-control input-lg" type="password">
                                        </div>
                                    </div>

                                </div>


                                <div style="margin-left: 50%;">
                                    <button type="submit" id="btnClient"
                                        class="btn btn-primary hvr-icon-float-away col-24">CHANGE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END -->
        @include('admin.partials.footer')
    </div>

</div>
<!-- END MAIN CONTAINER -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {

    //client Registration 

    $("#formPassword").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{route('update_password')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#passwordError").fadeOut();
                $("#btnClient").html('Updating.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Password Successfully Updated",
                        icon: "success",
                        button: "OK"
                    });
                    // $('#formPassword').trigger("reset");
                    $("#btnClient").html('CHANGE');
                    clients_table.ajax.reload();
                    fetchAll();
                } else {
                    $("#passwordError").fadeIn(1000, function() {
                        $("#passwordError").html(response.errors);
                    });
                    $("#btnClient").html('CHANGE');
                }
            }
        });
    }));
    //End device Registration
})
</script>
@endpush