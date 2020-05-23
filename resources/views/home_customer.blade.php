<!DOCTYPE html>
   @extends('master_'.$data_session['status'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comfy Hotel | Home</title>
</head>
<body>
    <nav class="navbar-position">
        <a class="navbar-position-link" href="/">Home / </a>
    </nav>
    @section('content')
    <div class="background-home-customer"></div>
    <div class="container">
        <div class="welcome-home-customer">
            <h2 class="head-welcome-home-customer">Sempurnakan liburan Anda bersama kami!</h2>
            <p class="isi-welcome-home-customer">
                Kami mengedepankan kenyamanan anda dalam 
                berlibur dengan menyediakan segala fasilitas yang mendukung hal tersebut. Segera lakukan reservasi dan buat liburan
                Anda berjalan senyaman mungkin!
            </p>
            <p class="isi-welcome-home-customer">
                <i>
                    We will ensure your comfortness on holiday by serving all the facilities to support it. 
                    Do the reservation immediately and make your holiday be great!
                </i>
            </p>
        </div>
        <div class="welcome-home-customer">
            <h2 class="head-welcome-home-customer">About Us</h2>
            <p class="isi-welcome-home-customer">
                Comfy Hotel adalah hotel yang didirikan pada tahun 2020 dan terbuka untuk umum. Untuk saat ini, kami hanya beroperasi 
                di Surabaya, Jawa Timur, Indonesia.
                
            </p>
            <p class="isi-welcome-home-customer">
                <i>
                    Comfy Hotel was built at 2020 and opened for everyone. For this time, we only operate at Surabaya, East Java, Indonesia.
                </i>
            </p>
        </div>
        <div class="list-home-customer">
            <h2 class="head-list-home-customer">Our Facilities</h2>
            <div class="row div-list-home-customer">
                <div class="col-md-2">
                    <div class="gambar-list-home-customer">
                        <img class="img-list" src="{{ asset('living-room.png') }}" alt="Rooms">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="isi-list-home-customer">
                        <p>Kami menyediakan kamar hotel ternyaman dengan pelayanan terbaik bagi Anda.</p>
                        <p><i>We serve the most comfort hotel's room with best service for you.</i></p>
                    </div>
                </div>
            </div>
            <div class="row div-list-home-customer">
                <div class="col-md-2">
                    <div class="gambar-list-home-customer">
                        <img class="img-list" src="{{ asset('gym.png') }}" alt="Fitness">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="isi-list-home-customer">
                        <p>Jaga kebugaran tubuh Anda dengan fasilitas fitness dari kami.</p>
                        <p><i>Keep your body healthy by using our fitness facilities.</i></p>
                    </div>
                </div>
            </div>
            <div class="row div-list-home-customer">
                <div class="col-md-2">
                    <div class="gambar-list-home-customer">
                        <img class="img-list" src="{{ asset('child.png') }}" alt="Fitness">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="isi-list-home-customer">
                        <p>Beri kegembiraan pada anak tanpa harus keluar dari area hotel kami.</p>
                        <p><i>Give happiness to your childs without go out from our hotel.</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
