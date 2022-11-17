@extends('admin.app')
 @section('title') Update  Device @endsection
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
                                     <h4 class="text-center">Update Device Details Here</h4>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-xl-12 col-md-12 col-sm-12">
                                     <div id="device_errors"
                                         class="alert alert-danger print-error-msg w3-padding-right w3-padding-left"
                                         style="display:none;">
                                         <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                         <ul class="w3-ul" style="list-style:none;">

                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="widget-content container">
                         <form id="formDevice" method="POST">
                            <input type="hidden" name="hidden_device_id" value="{{$device->id}}">
    <div class="form-row mb-4">
        <div class="form-group col-md-6">
            <label class="control-label">Brand</label>
           <input type="text" class="form-control input-lg" value="{{$device->brand}}" name="brand" id="brand">
        </div>
        <div class="form-group col-md-6">
            <label class="control-label">Model</label>
           <input type="text" class="form-control input-lg" value="{{$device->model}}" name="model" id="model">
        </div>

    </div>
    <div class="form-row mb-4">
        <div class="form-group col-md-6 col-lg-6 col-sm-12">
            <label class="control-label">Device Serial/Unique Number</label>
            <input class="form-control input-lg" id="device_number" value="{{$device->device_serial_no}}" name="device_serial_no" type="text">
            <div class="input-group-append">
                <a href="#" class="input-group-text" id="generate-number">Generate</a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="product_quantity">Device Owner</label>
            <select name="product_owner" id="product_owner"  class="form-control input-lg">

                <option value="{{$device->users->id}}">{{$device->users->phone_no}} / {{$device->users->name}}</option>

            </select>
        </div>

    </div>

    <!-- <div class="form-row mb-4">
                                         
                                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                        <label for="product_desc">Product Description</label>
                                        <input type="text" class="form-control" name="product_desc" id="product_desc" placeholder="Product Description">
                                    </div>
                                        <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                            <label for="product_photo">Product Photo</label>
                                            <input type="file" class="form-control" name="product_photo" id="product_photo">
                                        </div>
                   
                                        
                                    </div> -->

    <div style="margin-left:40%;">
        <button type="submit" id="buttonDevice" class="btn btn-primary mt-3 mx-5">UPDATE
            DEVICE</button>
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

    //Load Clients To Dropdown List
    loadUsers();

    //Generate Device Number
    $(document).on('click','#generate-number',function(e){
        e.preventDefault();
        randomId();
    })
   


    //device Registration 

    $("#formDevice").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "/admin/update_device",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#deviceError").fadeOut();
                $("#buttonDevice").html('Updating.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Device Successfully Updated",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formDevice').trigger("reset");
                    $("#buttonDevice").html('UPDATE DEVICE');
                    setTimeout('window.location.href = "/admin/devices"; ',2000);
                   
                } else {
                    $("#deviceError").fadeIn(1000, function() {
                        $("#deviceError").html(response);
                    });
                    $("#buttonDevice").html('UPDATE DEVICE');
                }
            }
        });
    }));
    //End device Registration
})

function loadUsers() {
    $.ajax({
        type: "GET",
        url: "{{ route('users-list') }}",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, val) {
                $('#product_owner').append('<option value=' + val.id + '>' + val.phone_no + '/' + val.name + 
                    '</option>');

            });
        }
    })
}

function randomId() {
  const uint32 = window.crypto.getRandomValues(new Uint32Array(1))[0];
  document.getElementById("device_number").value= uint32.toString(16);
 // alert(uint32.toString(16));
}
 </script>
 @endpush