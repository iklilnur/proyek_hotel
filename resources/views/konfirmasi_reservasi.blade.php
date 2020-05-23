<!DOCTYPE html>
    @extends('master_'.($data['session_jabatan']))
<html>
<head>
    <title>Reservasi Hotel | Konfirmasi Reservasi</title>
</head>
<body>
    @section('content')
    <div class="container">
        <h1 class="judul-table-pegawai">Konfirmasi Reservasi</h1>
        <form action="/pegawai/store_reservasi" method="post" class="form-pegawai">
            {{ csrf_field() }}
            @foreach($kamarDB as $k)
                @if($k->no_kamar == ($data['kamar1']))
                    <h2 class="head-konfirmasi-reservasi">Kamar Pilihan 1</h2>
                    <h3>Kamar : {{$k->nama_kamar}} ({{$k->tipe_kamar}})</h3>
                    <h3>Harga = Rp{{$k->harga_kamar}} / malam</h3>
                
                @endif
                @if($k->no_kamar == ($data['kamar2']))
                    <h2 class="head-konfirmasi-reservasi">Kamar Pilihan 2</h2>
                    <h3>Kamar : {{$k->nama_kamar}} ({{$k->tipe_kamar}})</h3>
                    <h3>Harga = Rp{{$k->harga_kamar}} / malam</h3>
                @endif
                @if($k->no_kamar == ($data['kamar3']))
                    <h2 class="head-konfirmasi-reservasi">Kamar Pilihan 3</h2>
                    <h3>Kamar : {{$k->nama_kamar}} ({{$k->tipe_kamar}})</h3>
                    <h3>Harga = Rp{{$k->harga_kamar}} / malam</h3>
                @endif
            @endforeach
            <h2 class="head-konfirmasi-reservasi">Tanggal Check-In</h2>
            <h3>{{ $data['checkin'] }}</h3>
            <h2 class="head-konfirmasi-reservasi">Tanggal Check-Out</h2>
            <h3>{{ $data['checkout'] }}</h3>
            <h2 class="head-konfirmasi-reservasi">Lama Menginap</h2>
            <h3>{{ $data['lama_inap'] }} Malam</h3>
            <h2 class="head-konfirmasi-reservasi">Total Biaya</h2>
            <h3>Rp{{ $data['total_harga'] }}</h3>
            @if($data['jenis_pembayaran'] == "Bayar diakhir")
                <h2 class="head-konfirmasi-reservasi">Uang Muka</h2>
                <h3>(Minimal Sebesar Rp{{ $data['uang_muka'] }})</h3>
                <div class="form-group">
                    <input type="text" class="form-control" name="uang_muka" value="{{ old('uang_muka') }}" required>
                    @if($errors->has('uang_muka'))
                        <p class="form-error">
                            Uang muka yang diinput minimal sebesar Rp{{ $data['uang_muka']}} dan kurang dari Rp{{ $data['total_harga'] }} 
                        </p>
                    @endif
                </div>
            @endif
            <h2 class="head-konfirmasi-reservasi">NIK Penanggung Jawab</h2>
            <h3>{{ $data['no_ktp'] }}</h3>
            <h2 class="head-konfirmasi-reservasi">Atas Nama</h2>
            <h3>{{ $data['nama_penanggungjawab'] }}</h3>
            <div class="form-group">
                <input type="hidden" value="{{$data['kamar1']}}" name="kamar1">
                <input type="hidden" value="{{$data['kamar2']}}" name="kamar2">
                <input type="hidden" value="{{$data['kamar3']}}" name="kamar3">
                <input type="hidden" value="{{$data['checkin']}}" name="tgl_checkin">
                <input type="hidden" value="{{$data['checkout']}}" name="tgl_checkout">
                <input type="hidden" value="{{$data['total_harga']}}" name="total_harga">
                <input type="hidden" value="{{$data['no_ktp']}}" name="no_ktp">
                <input type="hidden" value="{{$data['jenis_pembayaran']}}" name="jenis_pembayaran">
                <input type="hidden" value="{{$data['nama_penanggungjawab']}}" name="nama_penanggungjawab">
                <a href="/pegawai/tambah_reservasi" class="btn btn-danger">Kembali</a>
                <input type="submit" value="Konfirmasi" class="btn btn-success">
            </div>
        </form>
    </div>
    @endsection
    
</body>
</html>