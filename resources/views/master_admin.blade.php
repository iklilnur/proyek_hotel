<!DOCTYPE html>
<html>
<head>
    <title>Master Pegawai</title>    

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <nav class="navbar-pegawai">
        <center>
            <a href="/pegawai/home_pegawai" class="dropdown-content-head">Home</a>
            <div class="dropdown" href="#">
                <a href="#" class="dropdown-content-head">Tabel</a>
                <div class="dropdown-content">
                    <a href="/pegawai/list_customer">Customer</a>
                    <a href="/pegawai/list_reservasi">Reservasi</a>
                    <a href="/pegawai/list_kamar">Kamar</a>
                </div>
            </div>
            <div class="dropdown" href="#">
                <a href="#" class="dropdown-content-head">Input</a>
                <div class="dropdown-content">
                    <a href="/pegawai/tambah_customer">Customer</a>
                    <a href="/pegawai/tambah_reservasi">Reservasi</a>
                    <a href="/pegawai/tambah_kamar">Kamar</a>
                </div>
            </div>
            <a href="/pegawai/logout_pegawai" class="dropdown-content-head">Logout</a>
        </center>
    </nav>
    
    <div class="background-pegawai container-pegawai">
        @yield('content')

    </div>


</body>
</html>