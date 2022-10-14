@extends('admin.app')
@section('title') Register Service @endsection
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
                        <a style="margin-left:80%;" class="btn btn-primary mb-4 mr-2"
                                                   href="{{route('items.index')}}">Items List
                                                  </a>

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-center">Register New Item</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div id="productError"
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
                       
                            @include('admin.partials.item_form')
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
CKEDITOR.replace('description');


$(document).ready(function() {




    //Load Brands
    loadBrands();
    //Load Categories
    loadCategories();

    //Product Registration 

    $("#formProduct").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            url: "{{route('items.store')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#productError").fadeOut();
                $("#buttonProduct").html('Adding.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Item Successfully Added",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formProduct').trigger("reset");
                    $("#buttonProduct").html('SAVE');
                    setTimeout('window.location.href = "/admin/items"',3000)

                } else {
                    let errors = response.errors;
                    $.each(errors ,function(index,element){
                        toastr.error(errors[index], 'Error Alert', {timeOut: 4000})

                    })
                    $("#buttonProduct").html('SAVE');
                }
            }
        });
    }));
    //End Spare Registration




})

function loadCategories() {
    $.ajax({
        type: "GET",
        url: "{{ route('categories-list') }}",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, val) {
                $('#category_id').append('<option value=' + val.id + '>' +
                    val.name +
                    '</option>');

            });
        }
    })
}
//Dropdown Brands List
function loadBrands() {
    $.ajax({
        type: "GET",
        url: "{{ route('brands-list') }}",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, val) {
                $('#brand_id').append('<option value=' + val.id + '>' +
                    val.name +
                    '</option>');

            });
        }
    })
}
</script>
@endpush