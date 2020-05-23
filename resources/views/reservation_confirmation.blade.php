<!DOCTYPE html>
    @extends('master_loggedin')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comfy Hotel | Konfirmasi Reservasi</title>
</head>
<body>
    <nav class="navbar-position">
        <a class="navbar-position-link" href="/">Home / </a>
        <a href="/reservation" class="navbar-position-link"> Reservation</a>
    </nav>
    @section('content')
    <div class="container">
        <table>
            <tr>
                <th>
                    <div class="container-signup-customer">
                        <form action="/customer/store_reservation" method="post" class="form-pegawai">
                            <p class="label-login-customer">Reservation Confirmation</p>
                            {{ csrf_field() }}
                            @foreach($kamarDB as $k)
                                @if($k->no_kamar == ($data['kamar1']))
                                    <h3 class="head-konfirmasi-reservasi">Kamar Pilihan 1</h2>
                                    <div class="isi-konfirmasi-reservasi">
                                        <h4 >Kamar : {{$k->nama_kamar}} ({{$k->tipe_kamar}})</h3>
                                        <h4 >Harga = Rp{{$k->harga_kamar}} / malam</h3>
                                    </div>                            
                                @endif
                                @if($k->no_kamar == ($data['kamar2']))
                                    <h3 class="head-konfirmasi-reservasi">Kamar Pilihan 2</h2>
                                    <h3 class="head-konfirmasi-reservasi">Kamar Pilihan 1</h2>
                                    <div class="isi-konfirmasi-reservasi">
                                        <h4 >Kamar : {{$k->nama_kamar}} ({{$k->tipe_kamar}})</h3>
                                        <h4 >Harga = Rp{{$k->harga_kamar}} / malam</h3>
                                    </div>  
                                @endif
                                @if($k->no_kamar == ($data['kamar3']))
                                    <h3 class="head-konfirmasi-reservasi">Kamar Pilihan 3</h2>
                                    <h3 class="head-konfirmasi-reservasi">Kamar Pilihan 1</h2>
                                    <div class="isi-konfirmasi-reservasi">
                                        <h4 >Kamar : {{$k->nama_kamar}} ({{$k->tipe_kamar}})</h3>
                                        <h4 >Harga = Rp{{$k->harga_kamar}} / malam</h3>
                                    </div>  
                                @endif
                            @endforeach
                            <h3 class="head-konfirmasi-reservasi">Tanggal Check-In</h2>
                            <h4 class="isi-konfirmasi-reservasi">{{ $data['checkin'] }}</h3>
                            <h3 class="head-konfirmasi-reservasi">Tanggal Check-Out</h2>
                            <h4 class="isi-konfirmasi-reservasi">{{ $data['checkout'] }}</h3>
                            <h3 class="head-konfirmasi-reservasi">Lama Menginap</h2>
                            <h4 class="isi-konfirmasi-reservasi">{{ $data['lama_inap'] }} Malam</h3>
                            <h3 class="head-konfirmasi-reservasi">Total Biaya</h2>
                            <h4 class="isi-konfirmasi-reservasi">Rp{{ $data['total_harga'] }}</h3>
                            @if($data['jenis_pembayaran'] == "Bayar diakhir")
                                <h3 class="head-konfirmasi-reservasi">Masukkan Uang Muka</h2>
                                <h4>(Minimal Sebesar Rp{{ $data['uang_muka'] }})</h3>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="uang_muka" value="{{ old('uang_muka') }}" required>
                                    @if($errors->has('uang_muka'))
                                        <p class="form-error">
                                            Uang muka yang diinput minimal sebesar Rp{{ $data['uang_muka']}} dan kurang dari Rp{{ $data['total_harga'] }} 
                                        </p>
                                    @endif
                                </div>
                            @endif
                            <h3 class="head-konfirmasi-reservasi">NIK Penanggung Jawab</h2>
                            <h4 class="isi-konfirmasi-reservasi">{{ $data['no_ktp'] }}</h3>
                            <h3 class="head-konfirmasi-reservasi">Atas Nama</h2>
                            <h4 class="isi-konfirmasi-reservasi">{{ $data['nama_penanggungjawab'] }}</h3>
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
                                <a href="/reservation" class="button-back">Kembali</a>
                                <input type="submit" value="Save" class="button-login">
                            </div>
                        </form>
                    </div>
                </th>
                <th>
                    <div class="tulisan-login">
                        <h1 class="judul-tulisan-login">Konfirmasi Reservasi</h1>
                        <p class="isi-tulisan-login">Silahkan cek reservasi yang telah Anda buat.</p>
                        <p class="isi-tulisan-login">Jika sudah yakin, silahkan tekan tombol "Save" pada bagian bawah kotak disamping.</p>
                        <p class="isi-tulisan-login">Jika Anda ingin kembali ke tahap pengisian, tekan tombol "Kembali" disebelah tombol "Save".</p>
                    </div>
                </th>
            </tr>
        </table>
    </div>
    @endsection
</body>
</html>