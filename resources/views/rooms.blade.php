<!DOCTYPE html>
    @extends('master_'.$data_session['status'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comfy Hotel | Rooms</title>
</head>
<body>
    <nav class="navbar-position">
        <a class="navbar-position-link" href="/">Home / </a>
        <a class="navbar-position-link" href="/rooms">Rooms </a>
    </nav>
    @section('content')
    <div class="background-home-customer"></div>
    <div class="container">
        <div class="welcome-home-customer">
            <h2 class="head-welcome-home-customer">Our Rooms</h2>
            <p class="isi-welcome-home-customer">
                Kami menyediakan kamar-kamar dengan tempat tidur yang nyaman dan beberapa fasilitas terbaik.
                Terdapat dua tipe kamar yang dapat Anda pilih, keduanya akan mendapat pelayanan terbaik oleh 
                staff-staff kami.
            </p>
        </div>
   
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active carousel-rooms">
                    <div class="carousel-layer">
                        <p class="carousel-text-title">
                            Single Bed
                        </p>
                        <p class="carousel-text">
                            Pilihan yang baik jika Anda ingin berlibur seorang diri maupun membawa pasangan.
                            Kasur yang empuk dan kamar yang luas akan memberi Anda kenyamanan.
                        </p>
                    </div>
                    <center><img src="{{ asset('single_bed.jpg') }}" alt="Single Bed"></center>
                </div>

                <div class="item carousel-rooms">
                    <div class="carousel-layer">
                        <p class="carousel-text-title">
                            Double Bed
                        </p>
                        <p class="carousel-text">
                            Pilihan terbaik untuk Anda dan sahabat!
                            Dapatkan liburan yang menyenangkan bersama teman terbaik Anda. 
                        </p>
                    </div>
                    <center><img src="{{ asset('double_bed.jpg') }}" alt="Double Bed"></center>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="welcome-home-customer">
            <h2 class="head-welcome-home-customer">Detail Kamar</h2>
            <p class="isi-welcome-home-customer">
                <ul>
                    <li class="rooms-detail-title">Single Bed</li>
                    <ol>
                        <li class="rooms-detail">Tersedia satu bed berukuran besar untuk 2 orang dewasa</li>
                        <li class="rooms-detail">Free breakfast (sarapan pagi) untuk 2 orang</li>
                        <li class="rooms-detail">Kamar luas untuk 2 orang dewasa</li>
                        <li class="rooms-detail">Layanan pembersihan kamar setiap hari</li>
                        <li class="rooms-detail">Akses ke semua fasilitas hotel (kolam renang, fitness, playground)</li>
                        <li class="rooms-detail">Welcome drink</li>
                        <li class="rooms-detail">Harga : Rp500.000/malam</li>
                    </ol>
                    <li class="rooms-detail-title">Double Bed</li>
                    <ol>
                        <li class="rooms-detail">Tersedia dua bed berukuran sedang untuk 2 orang dewasa</li>
                        <li class="rooms-detail">Free breakfast (sarapan pagi) untuk 2 orang</li>
                        <li class="rooms-detail">Kamar luas untuk 2 orang dewasa</li>
                        <li class="rooms-detail">Layanan pembersihan kamar setiap hari</li>
                        <li class="rooms-detail">Akses ke semua fasilitas hotel (kolam renang, fitness, playground)</li>
                        <li class="rooms-detail">Welcome drink</li>
                        <li class="rooms-detail">Harga : Rp750.000/malam</li>
                    </ol>
                </ul>
            </p>
        </div>
    </div>
    @endsection
</body>
</html>