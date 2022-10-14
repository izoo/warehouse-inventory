 @extends('admin.app')
 @section('title') Create Device @endsection
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
                                     <h4 class="text-center">Register Warehouse Details Here</h4>
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
                             @include('admin.partials.warehouse_form')
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

    $("#formWarehouse").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{route('warehouses.store')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#deviceError").fadeOut();
                $("#buttonDevice").html('Adding.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Warehouse Successfully Registered",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formWarehouse').trigger("reset");
                    $("#buttonDevice").html('ADD');
                    devices_table.ajax.reload();
                    fetchAll();
                } else {
                    $("#deviceError").fadeIn(1000, function() {
                        $("#deviceError").html(response);
                    });
                    $("#buttonDevice").html('ADD');
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