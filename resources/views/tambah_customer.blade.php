<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | Input Customer</title>    
</head>
<body>
    @section('content')
    <div class="container ">
        <h1>Input Customer</h1>
        
        <form action="/customer/store_customer" method="post" class="form-pegawai overflow-auto">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Nama :</label>
                <input type="text" class="form-control" value="{{ old ('nama_customer') }}" required name="nama_customer"> 
                @if($errors->has('nama_customer'))
                    <p class="form-error">Nama berisi minimal 8 karakter dan maksimal 30 karakter</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir :</label>
                <input type="date" class="form-control" min="1940-01-01" max="2002-12-31" value="{{ old ('tgl_lahir_customer') }}" required name="tgl_lahir_customer">
            </div>
            <div class="form-group">
                <label for="">Alamat :</label>
                <textarea name="alamat_customer" id="" rows="5" class="form-control">{{ old ('alamat_customer') }}</textarea>
                @if($errors->has('alamat_customer'))
                    <p class="form-error">Alamat berisi minimal 20 karakter dan maksimal 200 karakter</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Nomor Handphone :</label>
                <input type="text" class="form-control" required name="nohp_customer" value="{{ old ('nohp_customer') }}">
                <p class="form-error">{{ @Session::get('pesan_nohp_customer') }}</p>
                @if($errors->has('nohp_customer'))
                    <p class="form-error">Nomor handphone hanya boleh angka, minimal 12 angka dan maksimal 13 angka.</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin :</label>
                <label for="" class="radio-inline"><input type="radio" name="jk_customer" value=1 checked>Laki-laki</label>
                <label for="" class="radio-inline"><input type="radio" name="jk_customer" value=0>Perempuan</label>
            </div>
            <div class="form-group">
                <label for="">Username :</label>
                <input type="text" class="form-control" required name="username" value="{{ old ('username') }}">
                <p class="form-error">{{ @Session::get('pesan_username_customer') }}</p>
                @if($errors->has('username'))
                    <p class="form-error">Username berisi minimal 8 karakter dan maksimal 30 karakter</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Password :</label>
                <input type="password" class="form-control" required name="password">
                @if($errors->has('password'))
                    <p class="form-error">Password berisi minimal 8 karakter dan maksimal 30 karakter</p>
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