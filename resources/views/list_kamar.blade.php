<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | List Kamar</title>
</head>
<body>

    @section('content')
    <div class="container">
        <h1 class="judul-table-pegawai">List Kamar</h1>
        <a href="/pegawai/tambah_kamar" class="btn btn-success button-input-pegawai">Input Kamar Baru</a>

        <form action="/pegawai/search_kamar" method="get">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" name="search_kamar">
                <input style="margin-top:10px;color:black" type="submit" value="Search" class="btn btn-warning">
            </div>
        </form>

        <table class="table table-bordered table-responsive table-pegawai">
            <tr class="head-table-pegawai isi-table-pegawai">
                <th>Nomor Kamar</th>
                <th>Nama Kamar</th>
                <th>Tipe Kamar</th>
                <th>Status</th>
                <th>Harga Kamar</th>
                <th>Action</th>
            </tr>
            @foreach($kamar as $k)
            <tr class="isi-table-pegawai">
                <td>{{ $k->no_kamar }}</td>
                <td>{{ $k->nama_kamar }}</td>
                <td>{{ $k->tipe_kamar }}</td>
                <td>{{ $k->status_kamar }}</td>
                <td>{{ $k->harga_kamar }}</td>
                <td>
                    <a href="/pegawai/edit_kamar/{{ $k->no_kamar }}">Edit</a>
                    <a href="/pegawai/hapus_kamar/{{ $k->no_kamar }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endsection
    
</body>
</html>