<header class="header--section">
    <div class="header--topbar bg--color-dark">
        <div class="container">
            <ul class="nav links float--left">
                <!-- <li><a href="#">FAQ</a></li> -->
                @if(!Auth::user())
                <li><a href="{{ route('register.create') }}">Register</a></li>
                <li><a href="{{ route('user.login') }}">Login</a></li>
                @endif
            </ul>
            <!-- <ul class="nav cart float--right">
              <li>
                <a href="cart.html"><i class="fa fa-shopping-basket"></i> 3</a>
              </li>
            </ul> -->
            <ul class="nav social float--right">
                 <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </li>
                 <li>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </li>

            </ul>
        </div>
    </div>
    <div class="header--navbar-top">
        <div class="container">
            <div class="logo float--left">
                <div class="vc--parent">
                    <div class="vc--child">
                        <a href="{{url('/')}}"><img src="{{asset('frontend/img/ilogo.jpg')}}"
                                alt="GLOBAL LOGISTICS NAIROBI" data-rjs="2" /></a>
                    </div>
                </div>
            </div>
            <div class="float--right">
                <div class="header--navbar-top-info float--left">
                    <div class="vc--parent">
                        <div class="vc--child">
                            <ul class="nav">
                                <li>
                                    <div class="icon text--primary">
                                        <i class="fa fa-vcard-o"></i>
                                    </div>
                                    <div class="content" style="display:none;" >
                                    <h1>Pickup & Delivery Of Your Items Both Locally and Internationally Upon Request. Call Today! Long & Short Term Storage Solutions At Competitive Rates.</h1>

                                    </div>
                                    <div class="content">
                                        <p>
                                            <a href="#">+25472000111</a>
                                        </p>
                                        <p>
                                            <a href="#">{{env('MAIL_FROM_ADDRESS')}}</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon text--primary">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="content">
                                        <p>Tom Mboya Street, Global Logistics Building,</p>
                                        <p>Nairobi, Kenya.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon text--primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="content">
                                        <p>Mon - Sat (09 am to 08 pm)</p>
                                        <p class="text--primary">(Sunday Closed)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header--navbar-top-btn float--left">
                    <div class="vc--parent">
                        <div class="vc--child">
                            @if(Auth::user())
                            <a href="{{route('user.dashboard')}}" class="btn btn-default">Make An Appoinment</a>
                            @else
                            <a href="{{url('appointment')}}" class="btn btn-default">Make An Appoinment</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="header--navbar navbar" data-trigger="sticky">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#headerNav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="headerNav" class="navbar-collapse collapse float--left">
                <ul class="header--nav-links nav navbar-nav font--secondary">
                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                    
                    <li>

                        @if(Auth::user())
                        <a href="{{route('user.dashboard')}}">Appointment</a>
                        @else
                        <a href="{{url('appointment')}}">Appointment</a>
                        @endif

                    </li>
                    
                    <li><a href="{{url('contact')}}">Contact Us</a></li>
                    @if(Auth::user())
                    <li class="pull-right" style="margin-left:20px;"><a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                class="bx bx-right-arrow-alt"></i>Logout
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a></li>

                    @endif



                </ul>
            </div>
            
            <div class="header--nav-search dropdown float--right">

                <div class="dropdown-menu" data-form-validation="true">

                </div>
            </div>
        </div>
    </nav>
</header>