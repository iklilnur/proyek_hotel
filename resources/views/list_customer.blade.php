<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | List Customer</title>    
</head>
<body>

    @section('content')
    <div class="container">
        <h1 class="judul-table-pegawai">List Customer</h1>
        <a href="/pegawai/tambah_customer" class="btn btn-success button-input-pegawai">Input Customer</a>

        <form action="/pegawai/search_customer" method="get">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" name="search_customer">
                <input style="margin-top:10px;color:black;" type="submit" value="Search" class="btn btn-warning">
            </div>
        </form>
        <table class="table table-bordered table-responsive table-pegawai">
            <tr class="head-table-pegawai isi-table-pegawai">
                <th>Nomor Customer</th>
                <th>Nama Customer</th>
                <th>Tanggal Lahir</th>
                <th>Alamat Customer</th>
                <th>Nomor HP</th>
                <th>Jenis Kelamin</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            @foreach($customer as $c)
            <tr class="isi-table-pegawai">
                <td >{{ $c-> no_customer }}</td>
                <td >{{ $c-> nama_customer }}</td>
                <td >{{ $c-> tgl_lahir_customer }}</td>
                <td >{{ $c-> alamat_customer }}</td>
                <td >{{ $c-> nohp_customer }}</td>
                @if($c->jk_customer == 1)
                    <td >Laki-laki</td>
                @else
                    <td >Perempuan</td>
                @endif
                <td>{{ $c-> username }}</td>
                <td>{{ $c-> password }}</td>
                <td >
                    <a href="/pegawai/edit_customer/{{ $c -> no_customer }}">Edit</a>
                    <a href="/pegawai/hapus_customer/{{ $c -> no_customer }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @endsection
</body>
</html>