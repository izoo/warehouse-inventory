 @extends('admin.app')
 @section('title') Create Charge @endsection
 @section('content')
 <!--  BEGIN CONTENT AREA  -->
 <div id="content" class="main-content">
     <div class="container">
         <!-- New Charge Div -->
         <div class="layout-px-spacing profil" id="new-charge">
             <div class="row layout-top-spacing">
                 <div id="flFormsGrid" class="col-lg-12 layout-spacings">
                     <div class="statbox widget box box-shadow">
                         <div class="widget-header">

                             <div class="row">
                                 <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                     <h4 class="text-center">Add Charge Plan Details Here</h4>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-xl-12 col-md-12 col-sm-12">
                                     <div id="charge_errors"
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
                             @include('admin.partials.charge_form')
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

    
   


    //charge Registration 

    $("#formCharge").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{route('charges.store')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#chargeError").fadeOut();
                $("#buttonCharge").html('Adding.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Charge Plan Successfully Added",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formCharge').trigger("reset");
                    $("#buttonCharge").html('ADD PLAN');
                    charges_table.ajax.reload();
                    fetchAll();
                } else {
                    $("#chargeError").fadeIn(1000, function() {
                        $("#chargeError").html(response);
                    });
                    $("#buttonCharge").html('ADD PLAN');
                }
            }
        });
    }));
    //End Charge Registration
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


 </script>
 @endpush