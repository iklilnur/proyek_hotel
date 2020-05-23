<!DOCTYPE html>
@extends('master_'.($data['session_jabatan']))
<html>
<head>
    <title>Reservasi Hotel | Input Reservasi</title>    
</head>
<body>
    @section('content')
    <div class="container">
        <h1>Input Reservasi</h1>
        
        <form action="/pegawai/konfirmasi_reservasi" method="get" class="form-pegawai">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Kamar Pilihan 1 (Angka paling depan menunjukkan lantai) :</label>
                <select name="kamar1" id="" class="form-control" required>
                    @foreach($kamar as $k)
                        @if(($k->status_kamar) == "Tersedia")
                            <option value="{{ $k -> no_kamar }}" >{{ $k -> nama_kamar }} ({{ $k ->tipe_kamar }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Kamar Pilihan 2 :</label>
                <select name="kamar2" id="" class="form-control">
                    <option value="tidak_dipesan">Tidak Dipesan</option>
                    @foreach($kamar as $k)
                        @if(($k->status_kamar) == "Tersedia")
                            <option value="{{ $k -> no_kamar }}" >{{ $k -> nama_kamar }} ({{ $k ->tipe_kamar }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Kamar Pilihan 3 :</label>
                <select name="kamar3" id="" class="form-control">
                    <option value="tidak_dipesan">Tidak Dipesan</option>
                    @foreach($kamar as $k)
                        @if(($k->status_kamar) == "Tersedia")
                            <option value="{{ $k -> no_kamar }}" >{{ $k -> nama_kamar }} ({{ $k ->tipe_kamar }})</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Lama Menginap :</label>
                <select name="lama_inap" id="" class="form-control">
                    @for($i=1;$i<"8";$i++)
                        <option value="{{ $i }}">{{ $i }} Malam</option>
                    @endfor
                </select>
                @if($errors->has('lama_inap'))
                    <p class="form-error">Lama inap harus sesuai dengan perbedaan tanggal check-in dan check-out</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Tanggal Check-In :</label>
                <input type="date" class="form-control" min="{{ $data['date_now'] }}" value="{{ old('tgl_checkin') }}" required name="tgl_checkin"> 
                @if($errors->has('tgl_checkin'))
                    <p class="form-error">Tanggal checkin harus lebih awal dari tanggal checkout</p>
                @endif 
            </div>
            <div class="form-group">
                <label for="">Tanggal Check-Out :</label>
                <input type="date" class="form-control" min="{{ $data['date_now'] }}" value="{{ old('tgl_checkout') }}" required name="tgl_checkout">
                @if($errors->has('tgl_checkout'))
                    <p class="form-error">Tanggal checkout harus lebih akhir dari tanggal checkin</p>
                @endif 
            </div>
            <div class="form-group">
                <label for="">Jenis Pembayaran :</label>
                <select name="jenis_pembayaran" id="" class="form-control">
                    <option value="Bayar diawal">Bayar diawal (Pelunasan pembayaran saat check-in)</option>
                    <option value="Bayar diakhir">Bayar diakhir (Membayar uang muka minimal 50% saat check-in dan melunasi pembayaran saat check-out)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">NIK Penanggung Jawab :</label>
                <input type="text" class="form-control" value="{{ old('no_ktp') }}" required name="no_ktp">
                @if($errors->has('no_ktp'))
                    <p class="form-error">NIK (Nomor KTP) hanya terdiri dari angka sepanjang 16 digit</p>
                @endif 
            </div>
            <div class="form-group">
                <label for="">Atas Nama :</label>
                <input type="text" class="form-control" value="{{ old('nama_penanggungjawab') }}" required name="nama_penanggungjawab"> 
                @if($errors->has('nama_penanggungjawab'))
                    <p class="form-error">Nama penanggungjawab untuk reservasi ini minimal 8 karakter dan maksimal 50 karakter</p>
                @endif
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-success">
            </div>
        </form>
    </div>
    @endsection
</body>
</html>