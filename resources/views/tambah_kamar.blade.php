<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | Input Kamar</title>    
</head>
<body>
    @section('content')
    <div class="container">
        <h1>Input Kamar</h1>
        
        <form action="/pegawai/store_kamar" method="post" class="form-pegawai">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Nama Kamar (Angka paling depan menunjukkan lantai tempat kamar berada) :</label>
                <input type="text" class="form-control" value="{{ old('nama_kamar') }}" required name="nama_kamar">
                <p class="form-error">{{ @Session::get('pesan_nama_kamar') }}</p> 
                @if($errors->has('nama_kamar'))
                    <p class="form-error">Nama kamar harus angka sepanjang 3 digit.</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Tipe Kamar :</label>
                <select name="tipe_kamar" id="" class="form-control">
                    <option value="Single Bed">Single Bed</option>
                    <option value="Double Bed">Double Bed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Status Kamar :</label>
                <select name="status_kamar" id="" class="form-control">
                    <option value="Tersedia">Tersedia</option>
                    <option value="Dipesan">Dipesan</option>
                    <option value="Sedang Digunakan">Sedang digunakan</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-success">
            </div>
        </form>
    </div>
    @endsection
</body>
</html>