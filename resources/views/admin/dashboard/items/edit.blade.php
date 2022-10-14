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
                                                   href="{{route('items.index')}}">Spares List
                                                  </a>

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-center">Update SparePart Details Here</h4>
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
                        <div class="widget-content">
                            
                            <form class="form-horizontal" id="formProduct" method="post">
                                <div id="userErrors"
                                    class="alert alert-danger print-error-msg w3-padding-right w3-padding-left"
                                    style="display:none;">
                                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                    <ul class="w3-ul" style="list-style:none;">

                                    </ul>
                                </div>
                                <input type="hidden" name="hidden_product_id" value="{{$product->id}}">
                                <div class="row mb-3">

                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                        <label class=" control-label">Product Name</label>
                                        <div class="">
                                            <input type="text" name="product_name" id="product_name"
                                                class="form-control input-lg" value="{{$product->product_name}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                        <label class="control-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-control input-lg">
                                            <option value="{{$product->categories->id}}">{{$product->categories->name}}
                                            </option>


                                        </select>

                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                        <label class="control-label">Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control input-lg">
                                            <option value="{{$product->brands->id}}">{{$product->brands->name}}</option>


                                        </select>
                                    </div>

                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                        <label class=" control-label">Purchase Price</label>
                                        <div class="">
                                            <input type="text" name="purchase_price" id="purchase_price"
                                                class="form-control input-lg" value="{{$product->unit_cost}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                                        <label class=" control-label">Sell Price</label>
                                        <div class="">
                                            <input type="text" name="sell_price" id="sell_price"
                                                class="form-control input-lg" value="{{$product->selling_cost}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                        <label class=" control-label">Product Quantity</label>
                                        <div class="">
                                            <input type="text" name="product_quantity" id="product_quantity"
                                                class="form-control input-lg" value="{{$product->quantity}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">


                                    <div class="form-group col-md-12  col-lg-12  col-sm-12">
                                        <label class="control-label">Product Description/Specifications</label>
                                        <textarea name="description" id="description" class="description form-control"
                                            cols="30" rows="6">
    {{$product->description}}
    </textarea>

                                    </div>
                                </div>
                                <div class="form-row mb-4">

                                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                        <label class="control-label">Meta Title</label>
                                        <textarea name="meta_title" id="meta_title" class="ckeditor form-control"
                                            cols="30" rows="6"></textarea>

                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="" class="ckeditor form-control" cols="30"
                                            rows="6">{{$product->meta_description}}</textarea>

                                    </div>


                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                        <label for="meta_keyword">Meta Keywords</label>
                                        <textarea name="meta_keyword" id="" class="ckeditor form-control" cols="30"
                                            rows="6">{{$product->meta_keyword}}</textarea>

                                    </div>
                                    <!-- <div class="form-group col-md-6 col-lg-6 col-sm-12">
    <label for="meta_keyword">Meta Image</label>
  <input type="file" class="form-control" name="img">

</div> -->
                                </div>

                                <div style="margin-left: 50%;">
                                    <button type="submit" id="buttonProduct"
                                        class="btn btn-primary hvr-icon-float-away col-24">UPDATE</button>
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
    CKEDITOR.replace('description');


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
            url: "/admin/product-update",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#productError").fadeOut();
                $("#buttonProduct").html('Updating.......');
            },
            success: function(response) {
                if ($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "Spare Part Successfully Updated",
                        icon: "success",
                        button: "OK"
                    });
                    $('#formProduct').trigger("reset");
                    $("#buttonProduct").html('UPDATE');
                    setTimeout('window.location.href = "/admin/products"; ', 3000);



                } else {
                    $("#productError").fadeIn(1000, function() {
                        $("#productError").html(response);
                    });
                    $("#buttonProduct").html('UPDATE');
                }
            }
        });
    }));
    //End device Registration

})

//load categories
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