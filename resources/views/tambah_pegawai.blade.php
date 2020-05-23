<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | Input Pegawai</title>    
</head>
<body>
    @section('content')
    <div class="container ">
        <h1>Input Pegawai</h1>
        
        <form action="/pegawai/store_pegawai" method="post" class="form-pegawai overflow-auto">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Nama :</label>
                <input type="text" class="form-control" value="{{ old('nama_pegawai') }}" required name="nama_pegawai">
                <p class="form-error">{{ @Session::get('pesan_nama_pegawai') }}</p>
                @if($errors->has('nama_pegawai'))
                    <p class="form-error">Nama pegawai minimal 8 karakter dan maksimal 30 karakter</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Jabatan</label>
                <select class="form-control" name="jabatan_pegawai" id="">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tanggal Lahir :</label>
                <input type="date" class="form-control" min="1990-01-01" max="2002-12-12" value="{{ old('tgl_lahir_pegawai') }}" required name="tgl_lahir_pegawai">
            </div>
            <div class="form-group">
                <label for="">Alamat :</label>
                <textarea name="alamat_pegawai" id="" rows="5" class="form-control">{{ old('alamat_pegawai') }}</textarea>
                @if($errors->has('alamat_pegawai'))
                    <p class="form-error">Alamat pegawai minimal 20 karakter dan maksimal 200 karakter</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Nomor HP :</label>
                <input type="text" class="form-control" value="{{ old('nohp_pegawai') }}" required name="nohp_pegawai">
                <p class="form-error">{{ @Session::get('pesan_nohp_pegawai') }}</p>
                @if($errors->has('nohp_pegawai'))
                    <p class="form-error">Nomor handphone pegawai harus angka, minimal 12 angka dan maksimal 13 angka</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin :</label>
                <label for="" class="radio-inline"><input type="radio" name="jk_pegawai" value=true checked>Laki-laki</label>
                <label for="" class="radio-inline"><input type="radio" name="jk_pegawai" value=false>Perempuan</label>
            </div>
            <div class="form-group">
                <label for="">Tanggal Diterima :</label>
                <input type="date" class="form-control" min="2020-03-01" value="{{ old('tgl_diterima') }}" required name="tgl_diterima">
            </div>
            <div class="form-group">
                <label for="">Password :</label>
                <input type="password" class="form-control" required name="password_pegawai">
                @if($errors->has('password_pegawai'))
                    <p class="form-error">Password pegawai minimal 8 karakter dan maksimal 30 karakter</p>
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