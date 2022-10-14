@extends('admin.app')
@section('title') Products List @endsection
@section('content')

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="container">
        <!-- New product Div -->
        <div class=" profil" id="new-product">
            <div class="row">
                <div id="flFormsGrid" class="col-lg-12">
                    <div class="statbox box box-shadow">
                        <div class="widget-header">

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <div id="product_errors"
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
                            <!-- products List Div -->
                            <div class=" profil" id="products-list">
                                <div class="row">
                                    <div id="flFormsGrid" class="col-lg-12">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">

                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4>List Of Items</h4>
                                                        <a style="margin-left:80%;" class="btn btn-primary"
                                                            href="{{route('items.create')}}">Add Item
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="widget-content">

                                                <table id="productsTable" class="table table-hover non-hover"
                                                    style="width:100%">
                                                    <thead class="table-heading">
                                                        <tr>
                                                            <th class="checkbox-column dt-no-sorting"> Record Id </th>
                                                            <th style="width: 20px;">#</th>

                                                            <th class="dt-no-sorting">Action</th>
                                                            <th>Item Name</th>
                                                            <th>Brand</th>
                                                            <th>Description</th>
                                                            <th>Unit</th>
                                                            <th>Added On</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>

                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- END -->
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



    // Fetch Products Details
    var products_table = $('#productsTable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        headerCallback: function(e, a, t, n, s) {
            e.getElementsByTagName("th")[0].innerHTML =
                '<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label><button class="btn btn-sm delete_all" id="delete_all" style="display:none">DELETE ALL</button>'
        },
        columnDefs: [{
            targets: 0,
            width: "30px",
            className: "",
            orderable: !1
        }],
        responsive: true,

        ajax: {
            url: "{{route('items.index')}}",
        },
        columns: [

            {
                data: 'id',
                name: 'id',
                render: function(data, a, t, n) {
                    return '<label class="new-control new-checkbox checkbox-outline-info  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" value="' +
                        data +
                        '" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                }
            },
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
            {
                data: 'item_name',
                name: 'item_name'
            },
            {
                data: 'brands.name',
                name: 'brands.name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'unit',
                name: 'unit'
            },
           
            {
                data: 'date',
                name: 'date'
            }

        ],
        buttons: {
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-sm'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-sm'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-sm'
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm'
                },

            ]
        },
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7

    });
    // End

    multiCheck(products_table);

    $(document).on('click', '.select-customers-info', function() {
        // let id = $(this).attr('data-id') ? $(this).attr('data-id') : "It is Empty" ;
        $('#delete_all').fadeIn('slow');
        // alert(id);
        // let ids = [];
    });

    //Delete All Records 
    $(document).on('click', '#delete_all', function(e) {
        e.preventDefault();

        let ids = [];


        if (confirm("Are you sure you want to delete this product(s)")) {
            $(".select-customers-info:checked").each(function() {
                let id = $(this).val();
                if (id !== "on") {
                    ids.push(id);

                }

            })

            if (ids.length > 0) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                let _url = `products/${ids}`;
                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                        _token: _token,
                        id: ids
                    },
                    success: function(response) {
                        swal({
                            title: "Success",
                            text: "Spares Successfully Removed",
                            icon: "success",
                            button: "OK"
                        });
                        $('#productsTable').DataTable().ajax.reload();
                    }
                });
            }


        }

    })

});

function addImages(id) {

    $('#imagesModal').modal('show');
}

function removeProduct(id) {
    let _url = `products/${id}`;
    if (confirm("Are You sure want to remove this Product!") == true) {
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
                _token: _token,
                id: id
            },
            success: function(response) {
                swal({
                    title: "Success",
                    text: "Spare Part Successfully Removed",
                    icon: "success",
                    button: "OK"
                });
                $('#productsTable').DataTable().ajax.reload();
            }
        });
    }

}
</script>
@endpush