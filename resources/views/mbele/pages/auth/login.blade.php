@extends('mbele.app')
@section('content')
<div class="page-header--section text-center">
  
    <div class="page--breadcrumb font--secondary">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{('/')}}">globalogistics</a></li>
                <li class="active"><span>LOGIN</span></li>
            </ul>
        </div>
    </div>
</div>
 <div id="appointment" class="appointment--section pd--100-0-40">
        <div class="container">
          <div class="row">
            <div class="col-sm-3 col-lg-3 col-md-3"></div>
            <div class="appointment--form col-md-8 col-sm-8 col-lg-8 col-xs-12" data-form="ajax">
              <form
                method="post"
                id="loginUser"
              >
                <div class="section--title">
            <h2 class="h2">LOGIN </h2>
           
          </div>
                <div class="status"></div>
                <div class="row">
                  
                  
                 
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">

                  <label for="">Email</label>
                    <div class="form-group">
                      <input
                        type="email"
                        name="email"
                        placeholder="E-mail Address"
                        class="form-control"
                        required
                      />
                    </div>
                  </div>
                  
                
                  
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                  <label for="">Password</label>
                    <div class="form-group">
                      <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="form-control"
                        
                        required
                      />
                    </div>
                  </div>
                 
                </div>
                
                <button type="submit" class="btn btn-block btn-lg btn-default">
                  LOGIN
                </button>
              </form>
            </div>
           
          </div>
        </div>
      </div>

@endsection
@push('scripts')
<script>
            $(document).ready(function(){
               // Register New User
 $('#loginUser').on('submit',(function(e){
        //alert("You Are Good To Go");
        e.preventDefault();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url:"{{ route('user.login.post') }}",
            type:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function()
            {
                $('#loginButton').html('Checking Credentials');
            },
            success : function(response)
            {
                if($.isEmptyObject(response.login_errors))
                {
                  //$('#myModal').modal('toggle');
                  $("#login-message-error").fadeOut(1000,function(){
                       
                        
                    });

                    swal({
                    title: 'Success!',
                    text: "Credentials Right!",
                    type: 'success',
                    padding: '2em'
                    });
                    window.location.href="{{route('user.dashboard')}}"
                   $('#loginUser').trigger("reset");
                   
                    $("#loginButton").html('LOGIN');

                    // table.ajax.reload();
                }
                else
                {
                    $("#login-message-error").fadeOut(1000,function(){
                        $('#login-message-error').html('Invalid Credentials'); 
                    });
            
               
                }
            }
        });
        
       }));
            //End
				
            })
        </script>
@endpush