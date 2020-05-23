<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | List Reservasi</title>    
</head>
<body>
@section('content')
    <div class="container">
        <h1 class="judul-table-pegawai">List Reservasi</h1>
        <a href="/pegawai/tambah_reservasi" class="btn btn-success button-input-pegawai">Input Reservasi</a>

        <form action="/pegawai/search_kamar" method="get">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" name="search_kamar">
                <input style="margin-top:10px;color:black" type="submit" value="Search" class="btn btn-warning">
            </div>
        </form>

        <table class="table table-bordered table-responsive table-pegawai">
            <tr class="head-table-pegawai isi-table-pegawai">
                <th>No. Reservasi</th>
                <th>Nama Pemesan</th>
                <th>Nomor KTP Penanggung Jawab</th>
                <th>No. Customer</th>
                <th>No. Pegawai</th>
                <th>Tanggal Reservasi</th>
                <th>Tanggal Check-In</th>
                <th>Tanggal Check-Out</th>
                <th>Kamar</th>
                <th>Total Pembayaran</th>
                <th>Sisa Pembayaran</th>
                <th>Action</th>
            </tr>
            @foreach($data['reservasi'] as $r)
                    <tr class="isi-table-pegawai">
                        <td>{{ $r->no_reservasi }}</td>
                        <td>{{ $r->nama_penanggungjawab }}</td>
                        <td>{{ $r->nomor_ktp}}</td>
                        @if($r->no_customer == null)
                            <td>Reservasi ini dibuat oleh pegawai</td>
                        @else
                            <td>{{ $r->no_customer }}</td>
                        @endif
                        @if($r->no_pegawai == null)
                            <td>Reservasi ini dibuat oleh customer secara online</td>
                        @else
                            <td>{{ $r->no_pegawai }}</td>
                        @endif
                        <td>{{ $r->tgl_reservasi }}</td>
                        <td>{{ $r->tgl_checkin }}</td>
                        <td>{{ $r->tgl_checkout }}</td>
                        <td>
                        @foreach($data['detail'] as $d)
                            @if($r->no_reservasi == $d->no_reservasi)
                                @foreach($data['kamar'] as $k)
                                    @if($d->no_kamar == $k->no_kamar)
                                        <p>{{ $k->nama_kamar }}</p>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        </td>
                        <td>{{ $r->total_pembayaran }}</td>
                        <td>{{ $r->sisa_pembayaran }}</td>
                        <td>
                            <a href="/pegawai/edit_reservasi/{{ $r -> no_reservasi }}">Edit</a>
                            <a href="/pegawai/hapus_reservasi/{{ $r -> no_reservasi  }}">Delete</a>
                        </td>
                    </tr>
            @endforeach
        </table>
        

    @endsection
</body>
