@extends('mbele.app')
@section('content')

<!-- Payment Modal -->
<div id="fadeupModal" class="modal animated fadeInUp custo-fadeInUp" role="dialog">
    <div class="modal-dialog modal-lg" style="padding:5%;">
        <!-- Modal content-->
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title text-center" style="text-align:center;">Add Payment Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" style="padding:5%;">
                <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 widget">
                            <h2 class="widget--title h4 bg--overlay">PAY VIA MPESA</h2>
                            <div class="categories--widget">
                                
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-6 col-sm-6 offset-md-5" style="padding:10px;color:#000;">
                            <label for="phone">Enter Phone Number To Pay </label>
                                          <input type="number" placeholder="Enter Mpesa Phone No" class="form-control" id="phone_no_pay" name="phone_no_pay">
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 offset-md-5">
                                            <button class="btn btn-info"   id="pay-via-mpesa">PAY VIA MPESA<i
                                                    class="fa fa-fw fa-lg fa-money"></i></button>
                                        </div>
                                    </div>
                </div>
                <form class="mt-0" method="POST" id="paymentForm" style="padding:5%;">
                    <div id="paymentError">
                    </div>
                    <input type="hidden" name="hidden_payment_booking_id" id="hidden_payment_booking_id">
                    
                    <div class="form-group">
                        Amount Due
                        <input type="text" name="amount_due" id="amount_due" class="form-control mb-2"
                            style="font-size:18px;font-weight:bolder;" readonly>
                    </div>
                    
                    <div class="form-group">
                        Amount Paid
                        <input type="text" name="amount_paid" id="amount_paid" class="form-control mb-2">
                    </div>
                    


                    <button type="submit" class="btn btn-primary mt-2 mb-2 btn-block" id="buttonPayment">ADD
                        PAYMENT</button>
                </form>
            </div>
            <div class="modal-footer md-button">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> CLOSE </button>

            </div>
        </div>
    </div>

<!-- End Payment Modal -->
 
<div class="page-header--section text-center">
    <div class="page--title pd--80-0" data-bg-img="{{('frontend/img/repairs-img/appointment.jpeg')}}">
        <div class="container">
            <h1 class="h1">GLOBAL LOGISTICS  </h1>
           
        </div>
    </div>
    <div class="page--breadcrumb font--secondary">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{url('/')}}">globalogistics</a></li>
                <li class="active"><span>Appointment</span></li>
            </ul>
        </div>
    </div>
</div>

@include('mbele.partials.appointment_form')
@endsection

@push('scripts')
<script>
$(document).ready(function() {

  // Initiate MPESA
  $('#pay-via-mpesa').on('click',(function(e){
       // alert("You Are Good To Go");
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url:"{{route('v1/access/token')}}",
                    method:"POST",
                    beforeSend:function()
                    {
                        $('#pay-via-mpesa').val("INITIATING MPESA");
                    },
                    success : function(response)
                    {
                        let phone_no_pay =$('#phone_no_pay').val();
                        // let amount_pay = $('#input_total').val();
                        let amount_pay = 1;
                        let logged = $('#user_logged').val();
                        let order_no = Math.floor(1000 + Math.random() * 9000);
                        $.ajax({
                            url:"{{ route('v1/token/stk/push') }}",
                            type:"POST",
                            data:{phone_no_pay:phone_no_pay,amount_pay:amount_pay,logged:logged,order_no:order_no},
                            success : function(response)
                            {
                                $('#pay-via-mpesa').val("PAY VIA MPESA");
                                swal({
                            title: 'Success!',
                            text: "MPESA SUCCESSFULLY INITIATED,CONFIRM PAYMENT ON YOUR PHONE",
                            type: 'success',
                            padding: '2em'
                            });
                           
        
                            }
                        });
                    }
                });
        
       }));
            //End
    //Items Dropdown List
    $.ajax({
        url: "{{route('user-items')}}",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, val) {

                $('#selectItem').prepend('<option value=' + val.id + '>' + val
                    .item_name +
                    '</option>');

            });
        }

    });
    //End
//show hide div
    $('#navDiv li a').click(function (e) {

e.preventDefault();
//remove the active state from all links
$('#navDiv li a').removeClass("active");
//add the active state to the clicked link
$(this).addClass("active");
//fade out the current container
$('.profil').fadeOut(600, function () {
    //fade in the clicked container
    $('#' + profileID).fadeIn(600);
    //$('#img').fadeOut(1000);
});
var profileID = $(this).attr("data-id");

});
// End

// Fetch Client Bookings Details
var bookings_table = $('#bookingsTable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        responsive: true,
        ajax: {
            url: "{{route('client-bookings')}}",
        },
        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
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
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
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

    // Fetch Client CheckIns Details
var checkins_table = $('#checkinsTable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        responsive: true,
        ajax: {
            url: "{{route('client-checkins')}}",
        },
        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            
            {
                data: 'item_details',
                name: 'item_details'
            },
            {
                data: 'warehouse_details',
                name: 'warehouse_details'
            },
            {
                data: 'bookings_details',
                name: 'bookings_details'
            },
            {
                data: 'no_days',
                name: 'no_days'
            },
            {
                data: 'total_charge',
                name: 'total_charge'
            },
           
            {
                data: 'check_in_date',
                name: 'check_in_date'
            },
            {
                data: 'check_out_date',
                name: 'check_out_date'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
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

      // Fetch Payments Details
      var payments_table = $('#paymentsTable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        responsive: true,
        ajax: {
            url: "{{route('client-payment-list')}}",
        },
        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'device_details',
                name: 'device_details'
            },
            {
                data: 'repairs[0].repair_total_cost',
                name: 'repairs[0].repair_total_cost'
            },
            {
                data: 'amount_paid',
                name: 'amount_paid'
            },
            {
                data: 'balance',
                name: 'balance'
            },
            {
               data:'mode_payment',
               name:'mode_payment'
            },
            {
                data: 'created_at',
                name: 'created_at'
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

     //Add Payment
     $("#paymentForm").on('submit', (function(e) {
        e.preventDefault();
        var payment = $('#hidden_payment_repair_id').val();
        let user_phone_no = $('#phone_no').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('client-payment')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#paymentError").fadeOut();
                $("#buttonPayment").html('Adding Payment.......');
            },
            success: function(response) {
                if($.isEmptyObject(response.errors)) {
                    swal({
                        title: "Success",
                        text: "PAYMENT SUCCESSFULLY ADDED",
                        icon: "success",
                        button: "OK"
                    });

                    $('#paymentForm').trigger("reset");
                    $("#buttonPayment").html('ADD PAYMENT');
                    $('#fadeupModal').modal('hide');

                    GetRepairIssue(payment);

                } else {
                    $("#paymentError").fadeIn(1000, function() {
                        $("#paymentError").html(response);
                    });
                    $("#buttonPayment").html('ADD PAYMENT');
                }
            }
        });
    }));
    //End Payment

    //Book Appointment
    $('#bookAppointment').on('submit',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $.ajax({
          url:"{{route('bookings.store')}}",
          type:"POST",
          data:new FormData(this),
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function()
          {
              $('#btnRequest').html('Placing Booking......');
          },
          success : function(response)
          {
			
		
			
              if($.isEmptyObject(response.errors))
              {
				//   var data = JSON.parse(response);
                  $("#userErrors").fadeOut('slow');
				 
                  swal({
                      title:"Success",
                      text:"Appointment Successfully Booked ,Will Get Back To You Shortly",
                      icon:"success",
                      button:"OK"
                  });
                  $("#btnRequest").html("SUBMIT REQUEST");
                  $('#bookAppointment').trigger("reset");
				 
                  
                  
              }
              else
              {
                
			   $("#userErrors").fadeIn(1000,function(){
				$(".print-error-msg").find("ul").html(data.errors).css('display','block');
			    $("#btnRequest").html("SUBMIT REQUEST");
               });
              }
          }
      });
    });
// End Appointment Details
})

//Get Repairs Issue Details
function makePayment(id,amount) {
    $('#hidden_payment_booking_id').val(id);
    $('#amount_due').val(amount);
    $('#fadeupModal').modal('show');

}


</script>
@endpush