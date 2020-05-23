@extends('master_'.($session_jabatan))
<!DOCTYPE html>
<html>
<head>
    <title>Reservasi Hotel | Edit Kamar</title>
</head>
<body>
    @section('content')
    <div class="container">
        <h1>Edit Kamar</h1>
        
        <form action="/pegawai/update_kamar" method="post" class="form-pegawai">
            {{ csrf_field() }}
            @foreach($kamar as $k)
            <div class="form-group">
                <label for="">Nama Kamar :</label>
                <input type="hidden" name="no_kamar" id="" value="{{ $k-> no_kamar }}">
                <input type="text" class="form-control" required name="nama_kamar" value="{{ $k -> nama_kamar }}"> 
                <p class="form-error">{{ @Session::get('pesan_nama_kamar') }}</p> 
                @if($errors->has('nama_kamar'))
                    <p class="form-error">Nama kamar harus angka sepanjang 3 digit.</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Tipe Kamar :</label>
                <select name="tipe_kamar" id="" class="form-control">
                    @if($k->tipe_kamar == "Single Bed")
                        <option value="Single Bed" selected>Single Bed</option>
                        <option value="Double Bed">Double Bed</option>
                    @else
                        <option value="Single Bed">Single Bed</option>
                        <option value="Double Bed" selected>Double Bed</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">Status Kamar :</label>
                <select name="status_kamar" id="" class="form-control">
                    @if($k->status_kamar == "Tersedia")
                        <option value="Tersedia" selected>Tersedia</option>
                        <option value="Dipesan">Dipesan</option>
                        <option value="Sedang Digunakan">Sedang digunakan</option>
                    @elseif($k->status_kamar == "Dipesan")
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipesan" selected>Dipesan</option>
                        <option value="Sedang Digunakan">Sedang digunakan</option>
                    @else
                        <option value="Tersedia" selected>Tersedia</option>
                        <option value="Dipesan">Dipesan</option>
                        <option value="Sedang Digunakan" selected>Sedang digunakan</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-success">
            </div>
            @endforeach
        </form>
    </div>
    @endsection
</body>
</html>