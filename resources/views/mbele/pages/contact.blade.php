@extends('mbele.app')
@section('content')
<!-- repair -->
<!-- newestUser -->
<!-- globalogistics@777@Rep -->
<div class="page-header--section text-center">
            <div class="page--title pd--80-0" data-bg-img="{{('frontend/img/repairs-img/mobile-repair.jpg')}}">
                <div class="container">
                    <h1 class="h1">Contact Us</h1>
                </div>
            </div>
            <div class="page--breadcrumb font--secondary">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">globalogistics</a></li>
                        <li class="active"><span>Contact</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="contact--section pd--100-0-40">
            <div class="container">
                <div class="row">
                    <div class="contact--content col-md-8 pb--60">
                        <h2 class="contact--title h4">Contact Information</h2>
                        <div class="row">
                            <div class="col-sm-7">
                            <h2 class="h2">Welcome to <span>Globalogistics Mobile Repairs</span></h2>
                                <p> We have a skilled service team available to assist you with any of your warehouse needs.</p>
                                <p>Even If a problem occurs even after our service technicians will short it out anyhow.</p>
                            </div>
                            <div class="col-sm-5">
                                <ul>
                                    <li class="fa-home">
                                        <p>GLOBAL Logistics Building,Tom Mboya Street,Nairobi,Kenya.</p>
                                    </li>
                                    <li class="fa-envelope">
                                        <p><a href="#">{{env('MAIL_FROM_ADDRESS')}}</a></p>
                                    </li>
                                    <li class="fa-phone-square">
                                        <p><a href="#">+25472000000</a></p>
                                    </li>
                                    <li class="fa-clock-o">
                                        <p>Monday - Satarday (09 am to 08 pm)<span>(Sunday Closed)</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="map" class="contact--map" style="padding:1%;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8162505863534!2d36.82208454960111!3d-1.284159999058773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d61a03ddc7%3A0x39b6e2de6cb0b6ea!2sSonalux%20House!5e0!3m2!1sen!2ske!4v1655762205318!5m2!1sen!2ske" width="99%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="contact--form col-md-4 pb--60" data-form="ajax">
                        <h2 class="contact--title h4">Get In Touch</h2>
                        <form  method="post">
                            <input type="hidden" name="submitType" value="ajax">
                            <div class="status"></div>
                            <div class="form-group"> <input type="text" name="name" class="form-control"
                                    placeholder="Name" required> </div>
                            <div class="form-group"> <input type="email" name="email" class="form-control"
                                    placeholder="E-mail Address" required> </div>
                            <div class="form-group"> <input type="text" name="subject" class="form-control"
                                    placeholder="Subject" required> </div>
                            <div class="form-group"> <textarea name="message" class="form-control"
                                    placeholder="Write Message" required></textarea> </div><button type="submit"
                                class="btn btn-default">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta--section bg--color-darkgray">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="cta--content">
                            <h2 class="h3">Looking For A Fast &amp; Reliable Repair Service</h2>
                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cta--btn"> <a href="{{url('appointment')}}" class="btn btn-default">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection