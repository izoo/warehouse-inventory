<div id="appointment" class="appointment--section pd--100-0-40">
    <div class="container">
        <div class="row">

            @if(Auth::user())
            <div class="appointment--items col-md-2">
                <div class="widget">
                    <h2 class="widget--title h4 bg--overlay">Menu</h2>
                    <div class="categories--widget">
                        <ul id="navDiv">
                            <!-- <li><a href="#" data-id="myappointments" class="active">My Appointments</a><span
                                    id="myappointments_count">(02)</span></li> -->
                            <li><a href="#" data-id="mybookings">My Bookings</a><span id="bookings_count">(05)</span></li>
                            <li><a href="#" data-id="mycheckins">Received Items</a><span id="payments_count">(18)</span>
                            <li><a href="#" data-id="mypayments">My Payments</a><span id="payments_count">(18)</span>
                            </li>
                            <li><a href="#" data-id="make-appointments">Make Appointment</a><span
                                    id="appointments_count">(18)</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            <div id="make-appointments"
                class="appointment--form col-md-10 col-sm-12 col-lg-10 col-xs-12 container profil"
                style="display:block;">
                <div class="section--title">
                    <h2 class="h2">Book For Space </h2>
                   
                </div>
                <form method="post" id="bookAppointment">

                    @if(!Auth::user())
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Your Name</label>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">

                            <label for="">Your Phone Number</label>
                            <div class="form-group">
                                <input type="tel" name="phone_no" placeholder="Phone Number" class="form-control" />
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-4 col-lg-4 col-xs-12">

                            <label for="">Email</label>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-mail Address" class="form-control"
                                    required />
                            </div>
                        </div>

                    </div>
                    @endif
                    <div class="row">
                       <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12"> 
                                <div class="form-group">
                                    <label for="service">Select Item</label>
                                    <select class="form-control" name="item" id="selectItem">
                                       
                                        <option value="">Other</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                <label for="">Quantity To Store</label>
                                <div class="form-group">
                                    <input type="text" name="quantity" placeholder="Quantity"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                                <label for="">Units</label>
                                <div class="form-group">
                                    <select class="form-control" name="unit" id="unit">
                                        <option value="Pieces">Pieces</option>
                                        <option value="Kgs">Kgs</option>
                                        <option value="Grams">Grams</option>
                                        <option value="Meters">Meters</option>
                                        <option value="Sacks">Sacks</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Address/Nearest Town</label>
                                <div class="form-group">
                                    <input type="text" name="address" placeholder="Address/Nearest Town"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Time</label>
                                <div class="form-group">
                                    <input type="text" name="time" placeholder="Time" class="form-control"
                                        data-trigger="time" required />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Date</label>
                                <div class="form-group">
                                    <input type="text" name="date" placeholder="Date" class="form-control"
                                        data-trigger="date" required />
                                </div>
                            </div>

                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                <label for="issue_select">Select Service Type</label>
                                <div class="form-group">

                                    <select class="form-control" name="service_type">
                                        <option value=""></option>
                                        <option value="Home Pickup">Home/Office Pickup</option>
                                        <option value="Store Visit">Store Visit</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <label for="">Highlight Device Problem</label>
                                <div class="form-group">

                                    <textarea name="message" placeholder="Highlight Problem" class="form-control"
                                        required></textarea>
                                </div>
                            </div>
                        </div> --}}

                        <button type="submit" id="btnRequest" class="btn btn-block btn-lg btn-default">
                            Book Space
                        </button>
                </form>
            </div>
            <div class="appointment--items col-md-2 col-lg-2">
            </div>
            @if(Auth::user())
            <div id="mybookings" class="appointment--form col-md-10 col-sm-12 col-lg-10 col-xs-12 container profil">
                <div class="section--title">
                    <h2 class="h2">My List Of Bookings </h2>
                   
                </div>
                <table id="bookingsTable" class="table table-hover non-hover" style="width:100%">
                    <thead class="table-heading">
                        <tr>
                                        <th style="width: 20px;">#</th>
                                        <td>Item</td>
                                        <td>Quantity</td>
                                        <td>Units</td>
                                        <td>Address</td>
                                        <td>Date</td>
                                        <td>Time</td>
                                        <td>Booked On</td>

                            <th class="dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>

            <div id="mycheckins" class="appointment--form col-md-10 col-sm-12 col-lg-10 col-xs-12 container profil">
                <div class="section--title">
                    <h2 class="h2">My List Of Received Items</h2>
                   
                </div>
                <table id="checkinsTable" class="table table-hover non-hover" style="width:100%">
                    <thead class="table-heading">
                        <tr>
                            <th style="width: 20px;">#</th>
                            <td>Item Details</td>
                            <td>Warehouse</td>
                            <td>Booking Details</td>
                            <td>No Of Days</td>
                            <td>Total Cost</td>
                            <td>Check In Date</td>
                            <td>Check Out Date</td>

                            <th class="dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>

            <div id="mypayments" class="appointment--form col-md-10 col-sm-12 col-lg-10 col-xs-12 container profil">
                <div class="section--title">
                    <h2 class="h2">My List Of Payments </h2>
                
                </div>
                <table id="paymentsTable" class="table table-hover non-hover" style="width:100%">
                    <thead class="table-heading">
                        <tr>
                            <th style="width: 20px;">#</th>
                            <th>Item</th>
                            <th>Amount Due</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Mode Of Payment</th>
                            <th>Added On</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>


            @endif

        </div>
    </div>
</div>