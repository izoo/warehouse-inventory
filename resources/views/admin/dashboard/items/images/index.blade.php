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

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-center"> Edit Images For
                                        {{ !empty($product->product_name) ? $product->product_name : "Product" }}
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
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" class="dropzone" id="dropzone"
                                        style="border: 2px dashed rgba(0,0,0,0.3)">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        {{ csrf_field() }}


                                    </form>
                                </div>
                            </div>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="button" id="uploadButton">
                                        <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                                    </button>
                                </div>
                            </div>
                            @if ($product->images)
                            <hr>
                            <div class="row">
                                @foreach($product->images as $image)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{ asset('uploads/thumbnail/products/'.$image->image_name.'.webp') }}"
                                                id="brandLogo" class="img-fluid" alt="img">
                                            <a class="card-link float-right text-danger"
                                                href="{{ route('product_images.delete', $image->id) }}">
                                                Delete
                                                <i class="fa fa-fw fa-lg fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
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
   
    Dropzone.autoDiscover = false;
    $(document).ready(function() {


        let myDropzone = new Dropzone("#dropzone", {
            paramName: "image",
            addRemoveLinks: true,
            maxFilesize: 4,
            parallelUploads: 4,
            uploadMultiple: false,
            url: "{{ route('product_images.store') }}",
            autoProcessQueue: false,
        }, );
        myDropzone.on("queuecomplete", function(file) {
            //  alert("Images Successfully Uploaded Uploaded")
             window.location.reload();

            showNotification('Completed', 'All product images uploaded', 'success');
        });
        $('#uploadButton').click(function(e) {
            e.preventDefault();
            //  alert("You Are Good To Go");
            if (myDropzone.files.length === 0) {
                showNotification('Error', 'Please select files to upload.', 'danger');
            } else {
                myDropzone.processQueue();
            }
        });

        function showNotification(title, message,icon) {
            swal({
                title: title,
                text: message,
                icon: icon,
                button: "OK"
            });
        }

        
    })
    </script>
    @endpush