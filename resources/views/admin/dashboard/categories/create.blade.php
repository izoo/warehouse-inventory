@extends('admin.app')
 @section('title') Create Category @endsection
 @section('content')
 <!--  BEGIN CONTENT AREA  -->
 <div id="content" class="main-content">
     <div class="container">
         <!-- New Category Div -->
         <div class="layout-px-spacing profil" id="new-category">
             <div class="row layout-top-spacing">
                 <div id="flFormsGrid" class="col-lg-12 layout-spacings">
                     <div class="statbox widget box box-shadow">
                         <div class="widget-header">

                             <div class="row">
                                 <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                     <h4 class="text-center">Register Category Details Here</h4>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-xl-12 col-md-12 col-sm-12">
                                     <div id="category_errors"
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
                             @include('admin.partials.category_form')
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
    //category Registration 

    $("#formCategory").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{route('categories.store')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#categoryError").fadeOut();
                $("#buttonCategory").html('Adding.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Category Successfully Registered",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formCategory').trigger("reset");
                    $("#buttonCategory").html('ADD');
                    setTimeout('window.location.href = "/admin/categories"',3000)
                } else {
                    let errors = response.errors;
                    $.each(errors ,function(index,element){
                        toastr.error(errors[index], 'Error Alert', {timeOut: 4000})

                    })
                    $("#buttonCategory").html('ADD');
                }
            }
        });
    }));
    //End category Registration
})


 </script>
 @endpush