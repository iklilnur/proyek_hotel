<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | List Pegawai</title>    
</head>
<body>
    <style>
    table, th, td {
        width: 100px
    }
    </style>
    @section('content')
    <div class="container">
        <h1 class="judul-table-pegawai">List Pegawai Hotel</h1>
        <a href="/pegawai/tambah_pegawai" class="btn btn-success button-input-pegawai">Input Pegawai Baru</a>
        <a href="/pegawai/cetak_pdf_pegawai" class="btn btn-success button-input-pegawai">Cetak Laporan (PDF)</a>

        <form action="/pegawai/search_pegawai" method="get">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" name="search_pegawai">
                <input style="margin-top:10px;color:black;" type="submit" value="Search" class="btn btn-warning">
            </div>
        </form>
        <table class="table table-bordered table-pegawai">
            <tr class="head-table-pegawai isi-table-pegawai">
                <th>No.</th>
                <th>Nomor Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Tanggal Lahir</th>
                <th style="width:1px">Alamat Pegawai</th>
                <th>Nomor HP</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Diterima</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            @php $i = 1 @endphp
            @foreach($pegawai as $p)
            <tr class="isi-table-pegawai">
                <td >{{ $i++ }}</td>
                <td >{{ $p-> no_pegawai }}</td>
                <td >{{ $p-> nama_pegawai }}</td>
                <td >{{ $p-> jabatan_pegawai }}</td>
                <td >{{ $p-> tgl_lahir_pegawai }}</td>
                <td style="width: 100px">{{ $p-> alamat_pegawai }}</td>
                <td >{{ $p-> nohp_pegawai }}</td>
                @if($p->jk_pegawai == true)
                    <td >Laki-laki</td>
                @else
                    <td >Perempuan</td>
                @endif
                <td >{{ $p-> tgl_diterima }}</td>
                <td >{{ $p-> password_pegawai }}</td>
                <td >
                    <a href="/pegawai/edit_pegawai/{{ $p -> no_pegawai }}">Edit</a>
                    <a href="/pegawai/hapus_pegawai/{{ $p -> no_pegawai }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @endsection
</body>
</html>