<!DOCTYPE html>
    @extends('master_'.$data['status'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comfy Hotel | Reservasi</title>
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
                        <form action="/reservation_confirmation" method="get" class="form-pegawai">
                            <p class="label-login-customer">Reservation</p>
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
                                <input type="submit" value="Pesan" class="button-login">
                                @if(@Session::get('pesan_reservasi')!="")
                                    <p class="form-error">{{ @Session::get('pesan_reservasi') }}</p>
                                @endif
                            </div>
                        </form>
                        
                    </div>
                </th>
                <th>
                    <div class="tulisan-login">
                        @if( @Session::get('session_no_customer')==null)
                            <h1 class="judul-tulisan-login">Anda terdeteksi belum login.</h1>
                            <p class="isi-tulisan-login">Reservasi Anda dapat dilakukan jika Anda telah melakukan login.</p>
                            <a href="/customer/login" class="isi-tulisan-login">Login</a>
                        @else
                            <h1 class="judul-tulisan-login">My Reservation</h1>
                            <p class="isi-tulisan-login">Dibawah ini merupakan list reservasi yang telah Anda buat.</p>
                            <ul>
                            @foreach($data['reservasi'] as $r)
                                <li>    
                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>Nama Penanggungjawab</th>
                                            <th style="margin-left:30px">Tanggal Checkin</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $r->nama_penanggungjawab }}</td>
                                            <td style="margin-left:30px;">{{ $r->tgl_checkin }}</td>
                                        </tr>
                                    </table>
                                    <a href="#" class="button-back" data-toggle="modal" data-target="#detailReservasi{{ $r->no_reservasi }}">Lihat Detail</a>
                                    <p style="margin-top:30px;"></p>

                                    <!-- Modal -->
                                    <div id="detailReservasi{{ $r->no_reservasi }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content modal-reservasi">
                                                <div class="modal-header judul-modal-reservasi">
                                                    <button type="button" class="close" data-dismiss="modal" style="background-color:white;width:20px">&times;</button>
                                                    <h4 class="modal-title">Detail Reservasi</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <ul>
                                                        <li>
                                                            <h4>Nama Penanggungjawab</h4>
                                                            <p class="isi-modal-reservasi">{{ $r->nama_penanggungjawab }}</p>
                                                        </li>
                                                        <li>
                                                            <h4>NIK Penanggungjawab</h4>
                                                            <p class="isi-modal-reservasi">{{ $r->nomor_ktp }}</p>
                                                        </li>
                                                        <li>
                                                            <h4>Tanggal Reservasi</h4>
                                                            <p class="isi-modal-reservasi">{{ $r->tgl_reservasi }}</p>
                                                        </li>
                                                        <li>
                                                            <h4>Tanggal Check-in</h4>
                                                            <p class="isi-modal-reservasi">{{ $r->tgl_checkin }}</p>
                                                        </li>
                                                        <li>
                                                            <h4>Tanggal Check-out</h4>
                                                            <p class="isi-modal-reservasi">{{ $r->tgl_checkout }}</p>
                                                        </li>
                                                        <li>
                                                            <h4>Kamar Pilihan Anda</h4>
                                                            @foreach($data['detail_reservasi'] as $d)
                                                                @if($d->no_reservasi == $r->no_reservasi)
                                                                    @foreach($kamar as $k)
                                                                        @if($d->no_kamar == $k->no_kamar)
                                                                            <p class="isi-modal-reservasi">Kamar {{ $k->nama_kamar }}</p>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </li>
                                                    <ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-success" href="/reservation/cetak_nota/{{ $r->no_reservasi }}">Cetak Bukti Reservasi</a>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        @endif
                    </div>
                </th>
            </tr>
        </table>
    </div>
    @endsection
</body>
</html>