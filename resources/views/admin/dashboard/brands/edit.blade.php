@extends('admin.app')
@section('title') Edit Brand @endsection
@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="container">
        <!-- New brand Div -->
        <div class="layout-px-spacing profil" id="new-brand">
            <div class="row layout-top-spacing">
                <div id="flFormsGrid" class="col-lg-12 layout-spacings">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-center">Edit Details For {{$brand->name}} Here</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div id="brand_errors"
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
                        <form id="formBrand" method="POST">
    <div class="form-row mb-4">
        <div class="form-group col-md-12 col-lg-12 col-sm-12">
            <label class="control-label">Brand Name</label>
            <input class="form-control input-lg" id="brand_name" name="brand_name" value="{{$brand->name}}" type="text">

        </div>
        <input type="hidden" name="hidden_brand_id" value="{{$brand->id}}">

        <!-- <div class="form-group col-md-6 col-lg-6 col-sm-12">
            <label class="control-label">Category</label>
            <select name="category_id" id="category_id" class="form-control input-lg">
                <option value="" disabled selected>.......</option>


            </select>
        </div> -->

    </div>
    <div class="form-row mb-4">
        <div class="form-group col-md-12 col-lg-12 col-sm-12">
            <label class="control-label">Meta Title</label>
            <textarea name="meta_title" id="meta_title" class="form-control" cols="30" rows="6">
            {{$brand->meta_name}}
            </textarea>
            
        </div>
        <div class="form-group col-md-12 col-lg-12 col-sm-12">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" id="" class="form-control" cols="30" rows="6">
            {{$brand->meta_title}}
            </textarea>

        </div>
        

    </div>
    <div class="form-row mb-4">
    <div class="form-group col-md-12 col-lg-12 col-sm-12">
            <label for="meta_keyword">Meta Keyword</label>
            <textarea name="meta_keyword" id="" class="form-control" cols="30" rows="6">
            {{$brand->meta_keyword}}
            </textarea>

        </div>
        <!-- <div class="form-group col-md-6 col-lg-6 col-sm-12">
            <label for="meta_keyword">Meta Image</label>
          <input type="file" class="form-control" name="img">

        </div> -->
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
        <button type="submit" id="buttonBrand" class="btn btn-primary mt-3 mx-5">UPDATE
        </button>
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
    loadCategories();

    //brand Registration 

    $("#formBrand").on('submit', (function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/brand-update",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#brandError").fadeOut();
                $("#buttonBrand").html('Updating.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Brand Successfully Updated",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formBrand').trigger("reset");
                    $("#buttonBrand").html('UPDATE');
                    setTimeout('window.location.href = "/admin/brands"; ',2000);
                  
                } else {
                    $("#brandError").fadeIn(1000, function() {
                        $("#brandError").html(response);
                    });
                    $("#buttonbrand").html('UPDATE');
                }
            }
        });
    }));
    //End brand Registration
})

function loadCategories() {
    $.ajax({
        type: "GET",
        url: "{{ route('categories-list') }}",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, val) {
                $('#category_id').append('<option value=' + val.id + '>'  +
                    val.name +
                    '</option>');

            });
        }
    })
}
</script>
@endpush