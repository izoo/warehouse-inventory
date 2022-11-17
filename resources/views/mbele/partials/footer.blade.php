<div class="footer--section bg--color-dark">
        <div class="footer--copyright-border"></div>
        <div class="container bg--overlay">
          <div class="row reset--gutter">
            <div class="col-md-3 bg--color-theme bg--overlay">
              <div class="footer--about">
                <div class="logo">
                  <img src="{{asset('frontend/img/ilogo.jpg')}}" alt="GLOBAL LOGISTICS LIMITED" data-rjs="2" />
                </div>
                <div class="content">
                  <p>
                  We Are Quality-Driven Professionals With Years Of Experience.We are one of the leading Logistics Company.
                  Pickup & Delivery Of Your Items Both Locally and Internationally Upon Request. Call Today! Long & Short Term Storage Solutions At Competitive Rates.
                  </p>
                </div>
              
                <div class="info">
                  <ul class="nav">
                    <li class="fa-home">
                      Global Logistics Building,Tom Mboya Street,Nairobi,Kenya.
                    </li>
                    <li class="fa-envelope">
                      <a href="#">{{env('MAIL_FROM_ADDRESS')}}</a>,
                     
                    </li>
                    <li class="fa-phone-square">
                      <a href="">+25472000111</a>,
                      
                    </li>
                    <li class="fa-clock-o">
                      Monday - Satarday (09 am to 08 pm)
                      <span>(Sunday Closed)</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="footer--widgets row">
                <div class="footer--widget col-md-4">
                  <div class="widget--title">
                    <h2 class="h4">Our Services</h2>
                  </div>
                  <div class="links--widget">
                    <ul class="nav">
                      <li>
                        <a href="#"
                          ><i class="fa fa-angle-double-right"></i>Warehousing and Storage.</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa fa-angle-double-right"></i>Select and Pack.</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa fa-angle-double-right"></i>Order Processing.</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa fa-angle-double-right"></i>Assembling and Kitting.</a
                        >
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa fa-angle-double-right"></i>Returns Processing.</a
                        >
                      </li>
                      
                    </ul>
                  </div>
                </div>
                <div class="footer--widget col-md-4">
                  <div class="widget--title">
                    <h2 class="h4">Quick Links</h2>
                  </div>
                  <div class="recent-posts--widget">
                    <ul class="nav">
                      <li class="clearfix">
                        <div class="content">
                          <h3 class="h6">
                            <a href="{{url('/')}}"
                              >Home</a
                            >
                          </h3>
                          
                        </div>
                      </li>
                      <li class="clearfix">
                        
                        <div class="content">
                          <h3 class="h6">
                            <a href="{{url('appointment')}}"
                              >Book Appointment</a
                            >
                          </h3>
                          
                        </div>
                      </li>
                     
                    </ul>
                  </div>
                </div>
                <div class="footer--widget col-md-4">
                  <div class="widget--title">
                    <h2 class="h4">Sign Up For Newsletter</h2>
                  </div>
                  <div class="subscribe--widget" data-form-validation="true">
                    <p>
                      Sign Up Our Newsletter to Get Notification Our New
                      Services
                    </p>
                    <form
                  
                    >
                      <div class="input-group">
                        <input
                          type="email"
                          name="EMAIL"
                          class="form-control"
                          placeholder="E-mail Address"
                          required
                        />
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default active">
                            <i class="fa fa-send"></i>
                          </button>
                        </span>
                      </div>
                    </form>
                    <div class="social">
                      <h3 class="h6">Find Us On</h3>
                      <ul class="nav">
                        <li>
                          <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                       
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="footer--copyright font--secondary clearfix">
                <p class="float--left">
                  &copy; Copyright {{date('Y')}} | All Rights Reserved
                </p>
                <p class="float--right">
                  <a href="#">Globa Logistics Limited</a> 
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="back-to-top-btn">
        <a href="#" class="btn btn-default active"
          ><i class="fa fa-angle-up"></i
        ></a>
      </div>
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


   
     <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
     <script src="{{ asset('backend/plugins/table/datatable/datatables.js')}}"></script>
      <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
      <script src="{{ asset('backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/vfs_fonts.js"
        integrity="sha256-UsYCHdwExTu9cZB+QgcOkNzUCTweXr5cNfRlAAtIlPY=" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/js/isotope.min.js')}}"></script>
    <script src="{{asset('frontend/js/fakeLoader.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.sticky.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.directional-hover.min.js')}}"></script>
 
    <script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('frontend/js/custom-color-switcher.min.js')}}"></script>
    <script src="{{asset('frontend/js/retina.min.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    
     
    </body>
</html>
