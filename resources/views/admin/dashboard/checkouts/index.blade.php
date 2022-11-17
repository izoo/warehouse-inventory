@extends('admin.app')
@section('title') Bookings List @endsection
@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <!-- Add Receive Modal -->
<div id="receiveModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog" style="">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Receive Items </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">

                <form id="formWarehouseAssign" method="POST">
                    <input type="hidden" name="hidden_booking_id" id="hidden_booking_id">
                    <input type="hidden" name="hidden_user_id" id="hidden_user_id">
                    <input type="hidden" name="hidden_item_id" id="hidden_item_id">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label class="control-label">Select Warehouse</label>
                            <select name="warehouse_id" id="warehouse_id" class="form-control input-lg">
                                <option value="" disabled selected>--------</option>
                               
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Select Plan</label>
                            <select name="charge_plan" id="charge_plan" class="form-control input-lg">
                                <option value="" disabled selected>.......</option>
                                <option value="hour">Per Hour</option>
                                <option value="day">Per Day</option>
                                <option value="week">Per Week</option>
                                <option value="month">Per Month</option>
                                
                            </select>
                        </div>
                
                    </div>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6 col-lg-6 col-sm-6">
                            <label class="control-label">Check In Date</label>
                            <input class="form-control input-lg" id="check_in_date" name="check_in_date" type="date">
                            
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6">
                            <label class="control-label">Check Out Date</label>
                            <input class="form-control input-lg" id="check_out_date" name="check_out_date" type="date">
                            
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
                        <button type="submit" id="buttonReceive" class="btn btn-primary mt-3 mx-5">RECEIVE</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer md-button">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> CLOSE</button>

            </div>
        </div>
    </div>
</div>
<!-- End -->
    <div class="container">
        <div class="layout-px-spacing profil" id="appointments-list">
            <div class="row layout-top-spacing">
                <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>List Of Space Bookings</h4>
                                </div>
                            </div>

                        </div>
                        <div class="widget-content widget-content-area">
                            <table id="appointmentsTable" class="table table-hover non-hover" style="width:100%">
                                <thead class="table-heading">
                                    <tr>
                                        <th>#</th>
                                        <td>Client Details</td>
                                        <td>Item</td>
                                        <td>Quantity</td>
                                        <td>Units</td>
                                        <td>Address</td>
                                        <td>Date</td>
                                        <td>Time</td>
                                        <td>Booked On</td>
                                        <td>Action</td>
                                       
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

    //Warehouses Dropdown List
    $.ajax({
        url: "{{route('warehouse-list')}}",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, val) {

                $('#warehouse_id').prepend('<option value=' + val.id + '>' + val
                    .name +
                    '</option>');

            });
        }

    });
    //End

      //Warehouse Assignment
      $('#formWarehouseAssign').on('submit',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $.ajax({
          url:"{{route('warehouse-assignment.store')}}",
          type:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function()
          {
              $('#btnRequest').html('Receiving......');
          },
          success : function(response)
          {
			
		
			
              if($.isEmptyObject(response.errors))
              {
				//   var data = JSON.parse(response);
                  $("#userErrors").fadeOut('slow');
				 
                  swal({
                      title:"Success",
                      text:"Item Successfully Received",
                      icon:"success",
                      button:"OK"
                  });
                  $("#btnRequest").html("RECEIVE");
                  $('#formWarehouseAssign').trigger("reset");
				 
                  
                  
              }
              else
              {
                
			   $("#userErrors").fadeIn(1000,function(){
				$(".print-error-msg").find("ul").html(data.errors).css('display','block');
			    $("#btnRequest").html("RECEIVE");
               });
              }
          }
      });
    });
// End Warehouse Assignment Details
    
        
    // Fetch appointments Details
    var appointments_table = $('#appointmentsTable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        responsive: true,
        ajax: {
            url: "{{route('bookings.index')}}",
        },
        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'client_details',
                name: 'client_details'
            },
            {
                data: 'item_details',
                name: 'item_details'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'units',
                name: 'units'
            },
            {
                data: 'location',
                name: 'location'
            },
           
            {
                data: 'date_booked',
                name: 'date_booked'
            },
            {
                data: 'time_booked',
                name: 'time_booked'
            },
            {
                data: 'created_at',
                name: 'created_at',
               
            },
            {
                data: 'action',
                name: 'action',
               
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
                }
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

});

function receiveItem(booking_id,user_id,item_id) {

$('#receiveModal').modal('show');
$('#hidden_booking_id').val(booking_id);
$('#hidden_user_id').val(user_id);
$('#hidden_item_id').val(item_id);
}
</script>
@endpush