<!DOCTYPE html>
@extends('master_'.($session_jabatan))
<html>
<head>
    <title>Reservasi Hotel | Edit Reservasi</title>    
</head>
<body>
    @section('content')
    <div class="container">
        <h1>Edit Reservasi</h1>
        
        <form action="/pegawai/konfirmasi_edit_reservasi" method="get" class="form-pegawai">
            {{ csrf_field() }}
            @foreach($data['reservasi'] as $r)
                <input type="hidden" value="{{ $r->no_reservasi }}" name="no_reservasi">
                <div class="form-group">
                    <label for="">Kamar Pilihan 1 (Angka paling depan menunjukkan lantai) :</label>
                    <select name="kamar1" id="" class="form-control" required>
                        @foreach($data['kamar1'] as $k1)
                            <option value="{{ $k1->no_kamar }}">{{ $k1->nama_kamar }}</option>
                        @endforeach
                        @foreach($data['kamar'] as $k)
                            @if($k->status_kamar == "Tersedia")
                                <option value="{{ $k->no_kamar }}">{{ $k->nama_kamar }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Kamar Pilihan 2 :</label>
                    <select name="kamar2" id="" class="form-control">
                        @if($data['kamar2'] != "Tidak Dipesan")
                            @foreach($data['kamar2'] as $k2)
                                <option value="{{ $k2->no_kamar }}">{{ $k2->nama_kamar }}</option>
                            @endforeach
                        @else
                            <option value="Tidak Dipesan">Tidak Dipesan</option>
                        @endif
                        @foreach($data['kamar'] as $k)
                            @if($k->status_kamar == "Tersedia")
                                <option value="{{ $k->no_kamar }}">{{ $k->nama_kamar }}</option>
                            @endif
                        @endforeach
                        <option value="Tidak Dipesan">Tidak Dipesan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Kamar Pilihan 3 :</label>
                    <select name="kamar3" id="" class="form-control">
                        @if($data['kamar3'] != "Tidak Dipesan")
                            @foreach($data['kamar3'] as $k3)
                                <option value="{{ $k3->no_kamar }}">{{ $k3->nama_kamar }}</option>
                            @endforeach
                        @else
                            <option value="Tidak Dipesan">Tidak Dipesan</option>
                        @endif
                        @foreach($data['kamar'] as $k)
                            @if($k->status_kamar == "Tersedia")
                                <option value="{{ $k->no_kamar }}">{{ $k->nama_kamar }}</option>
                            @endif
                        @endforeach
                        <option value="Tidak Dipesan">Tidak Dipesan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Lama Menginap :</label>
                    <select name="lama_inap" id="" class="form-control">
                        <option value="{{ $data['lama_inap'] }}">{{ $data['lama_inap'] }} Malam</option>
                        @for($i=1;$i<"8";$i++)
                            @if($i != $data['lama_inap'])
                                <option value="{{ $i }}">{{ $i }} Malam</option>
                            @endif
                        @endfor
                        @if($errors->has('lama_inap'))
                            <p class="form-error">Lama inap harus sesuai dengan perbedaan tanggal check-in dan check-out</p>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Check-In :</label>
                    <input type="text" class="form-control" required min="{{ $data['date_now'] }}" name="tgl_checkin" value="{{ $r->tgl_checkin }}" placeholder="{{ $r->tgl_checkin }}" onfocus="(this.type='date')" onblur="(this.type='text')"> 
                    @if($errors->has('tgl_checkin'))
                        <p class="form-error">Tanggal checkin harus lebih awal dari tanggal checkout</p>
                    @endif 
                </div>
                <div class="form-group">
                    <label for="">Tanggal Check-Out :</label>
                    <input type="text" class="form-control" required min="{{ $data['date_now'] }}" name="tgl_checkout" value="{{ $r->tgl_checkout }}" placeholder="{{ $r->tgl_checkout }}" onfocus="(this.type='date')" onblur="(this.type='text')">
                    @if($errors->has('tgl_checkout'))
                        <p class="form-error">Tanggal checkout harus lebih akhir dari tanggal checkin</p>
                    @endif  
                </div>
                <div class="form-group">
                    <label for="">Jenis Pembayaran (Bayar diakhir akan dikenakan uang muka minimal 50%) :</label>
                    <select name="jenis_pembayaran" id="" class="form-control">
                        @if($r->sisa_pembayaran == 0)
                            <option value="Bayar diawal" selected>Bayar diawal</option>
                            <option value="Bayar diakhir">Bayar diakhir</option>
                        @else
                            <option value="Bayar diawal" >Bayar diawal</option>
                            <option value="Bayar diakhir" selected>Bayar diakhir</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="">NIK Penanggung Jawab :</label>
                    <input type="text" class="form-control" required name="no_ktp" value="{{ $r->nomor_ktp }}"> 
                    @if($errors->has('no_ktp'))
                        <p class="form-error">NIK (Nomor KTP) hanya terdiri dari angka sepanjang 16 digit</p>
                    @endif 
                </div>
                <div class="form-group">
                    <label for="">Atas Nama :</label>
                    <input type="text" class="form-control" required name="nama_penanggungjawab" value="{{ $r->nama_penanggungjawab }}"> 
                    @if($errors->has('nama_penanggungjawab'))
                        <p class="form-error">Nama penanggungjawab untuk reservasi ini minimal 8 karakter dan maksimal 50 karakter</p>
                    @endif
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