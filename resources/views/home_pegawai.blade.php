<!DOCTYPE html>
<html>
<head>
@extends('master_'.($session_jabatan))
    <title>Reservasi Hotel | Home Pegawai</title>
</head>
<body>
    @section('content')
        <div class="home-pegawai">
            <p class="judul-home-pegawai">Selamat datang, {{ $session_nama }}.</p>
            <p class="sub-judul-home-pegawai">Anda adalah seorang {{ $session_jabatan }}.</p>
        </div>
        <div class="container">
            <p class="judul-home-pegawai" style="margin-top:1vw">Job Desk</p>
            <div class="row">
                @if($session_jabatan == "admin")
                    <div class="col-md-4">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Customer
                            </p>
                             <div class="dropdown-home-content">
                                <a href="/pegawai/list_customer" class="dropdown-home-link">List Customer</a>
                                <a href="/pegawai/tambah_customer" class="dropdown-home-link">Input Customer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Reservasi
                            </p>
                            <div class="dropdown-home-content">
                                <a href="/pegawai/list_reservasi" class="dropdown-home-link">List Reservasi</a>
                                <a href="/pegawai/tambah_reservasi" class="dropdown-home-link">Input Reservasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Kamar
                            </p>
                            <div class="dropdown-home-content">
                                <a href="/pegawai/list_kamar" class="dropdown-home-link">List Kamar</a>
                                <a href="/pegawai/tambah_kamar" class="dropdown-home-link">Input Kamar</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-3">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Customer
                            </p>
                            <div class="dropdown-home-content">
                                <a href="/pegawai/list_customer" class="dropdown-home-link">List Customer</a>
                                <a href="/pegawai/tambah_customer" class="dropdown-home-link">Input Customer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Reservasi
                            </p>
                            <div class="dropdown-home-content">
                                <a href="/pegawai/list_reservasi" class="dropdown-home-link">List Reservasi</a>
                                <a href="/pegawai/tambah_reservasi" class="dropdown-home-link">Input Reservasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Kamar
                            </p>
                            <div class="dropdown-home-content">
                                <a href="/pegawai/list_kamar" class="dropdown-home-link">List Kamar</a>
                                <a href="/pegawai/tambah_kamar" class="dropdown-home-link">Input Kamar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown-home">
                            <p class="judul-dropdown-home">
                                Pegawai
                            </p>
                            <div class="dropdown-home-content">
                                <a href="/pegawai/list_pegawai" class="dropdown-home-link">List Pegawai</a>
                                <a href="/pegawai/tambah_pegawai" class="dropdown-home-link">Input Pegawai</a>
                            </div>
                        </div>
                    </div>
                @endif
              
            </div>
        </div>
    @endsection
</body>
</html>