<!DOCTYPE html>
<html>
<head>
    <title>Master Logged In</title>    

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-customer.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body class="body-customer">
    <nav class="navbar-position">
        <a class="navbar-position-link" href="/">Home / </a>
        <a href=""></a>
    </nav>
    <nav class="navbar-customer">
        <p class="navbar-customer-head">Comfy Hotel</p>
        <a href="/" class="navbar-customer-link">Home</a>
        <a href="/rooms" class="navbar-customer-link">Rooms</a>
        <a href="#" class="navbar-customer-link">Facilities</a>
        <a href="/reservation" class="navbar-customer-link">Reservation</a>
        
        <a href="/customer/logout" class="navbar-customer-link-right">Logout</a>
        <a href="#" class="navbar-customer-link-right">{{ @Session::get('session_nama_customer') }}</a>
    </nav>
    @yield('content');
    <div class="footer-customer">
        <div class="container">
            <h2 style="margin-bottom: 30px;">Comfy Hotel</h2>
            <div class="row">
                <div class="col-md-4">
                    <h3>Location</h3>
                    <a href="https://www.google.com/maps/place/Jl.+Mojo+Kidul+Blok+B+No.59,+Mojo,+Kec.+Gubeng,+Kota+SBY,+Jawa+Timur+60285/@-7.2719149,112.7686197,18z/data=!3m1!4b1!4m5!3m4!1s0x2dd7fa2e97a43363:0x975cd5c8eeb30527!8m2!3d-7.2719176!4d112.769714?hl=id"><img style="width:50px;height:50px;margin-top: 30px;" src="{{ asset('periscope.png') }}" alt="Location"></a>
                    <h4>Jl. Mojokidul Blok B No.60A </h4>
                    <h4>Surabaya, East Java, Indonesia</h4>
                </div>
                <div class="col-md-4">
                    <h3>Contact Us!</h3>
                    <img class="footer-icon" src="{{ asset('instagram.png') }}" alt="">
                    <img class="footer-icon" src="{{ asset('facebook.png') }}" alt="">
                    <img class="footer-icon" src="{{ asset('whatsapp.png') }}" alt="">
                    <img class="footer-icon" src="{{ asset('twitter.png') }}" alt="">
                    <img class="footer-icon" src="{{ asset('snapchat.png') }}" alt="">
                </div>
                <div class="col-md-4">
                    <h3></h3>
                </div>
            </div>
        </div>   
    </div>
    <div class="footer-policy">
        <p>@Copyright 2020 by Ahmad Iklil Nur | 081811633018</p>
    </div> 
</body>
</html>