@extends('admin.app')
@section('title') Register Client @endsection
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
                                    <h4 class="text-center">Register Clients Details Here</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div id="clientError"
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
                            <form class="form-horizontal" id="formClient" method="post">
                                <div id="userErrors"
                                    class="alert alert-danger print-error-msg w3-padding-right w3-padding-left"
                                    style="display:none;">
                                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                    <ul class="w3-ul" style="list-style:none;">

                                    </ul>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-6 col-lg-6">
                                        <label class=" control-label">Client Name</label>
                                        <div class="">
                                            <input type="text" name="client_name" id="client_name"
                                                class="form-control input-lg" placeholder="Client Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label class=" control-label">Client Email</label>
                                        <div class="">

                                            <input type="email" id="email" name="email"
                                                class="form-control input-lg" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row mb-3">

                                   
                                </div> -->
                                <div class="row mb-3">

                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label class=" control-label">Phone Number</label>
                                        <div class="">

                                            <input id="client_phone_no" name="client_phone_no"
                                                class="form-control input-lg" type="number" placeholder="Phone Number">
                                        </div>
                                    </div>

                                </div>


                                <div style="margin-left: 50%;">
                                    <button type="submit" id="btnClient"
                                        class="btn btn-primary hvr-icon-float-away col-24">SAVE</button>
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

    $("#formClient").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{route('clients.store')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#clientError").fadeOut();
                $("#buttonClient").html('Adding.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Client Successfully Added",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formClient').trigger("reset");
                    $("#buttonClient").html('ADD CLIENT');
                    clients_table.ajax.reload();
                    fetchAll();
                } else {
                    $("#clientError").fadeIn(1000, function() {
                        $("#clientError").html(response);
                    });
                    $("#buttonClient").html('ADD CLIENT');
                }
            }
        });
    }));
    //End device Registration
})
</script>
@endpush