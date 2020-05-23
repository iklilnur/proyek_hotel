<!DOCTYPE html>
<html>
<head>
    <title>Reservasi Hotel | Laporan Pegawai</title>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9.5pt;
        }
        body{
            border: dashed 5px black;
            padding: 20px;
        }
	</style>
        <center><h2>Bukti Reservasi Comfy Hotel</h2></center>
        <center><h3>Mohon tunjukkan bukti ini pada resepsionis yang bertugas.</h3></center>
        <div class="container">
            @foreach($data['reservasi'] as $r)
                <h3>Nomor Reservasi</h3>
                <h4>{{ $r->no_reservasi }}</h4><br>
                <h3>Nama Penanggungjawab</h3>
                <h4 >{{ $r->nama_penanggungjawab }}</h4><br>
                <h3>NIK Penanggungjawab</h3>
                <h4 >{{ $r->nomor_ktp }}</h4><br>
                <h3>Tanggal Reservasi Dibuat</h3>
                <h4 >{{ $r->tgl_reservasi }}</h4><br>
                <h3>Tanggal Check-In</h3>
                <h4 >{{ $r->tgl_checkin }}</h4><br>
                <h3>Tanggal Check-Out</h3>
                <h4 >{{ $r->tgl_checkout }}</h4><br>
                <h3>Kamar yang Dipesan</h3>
                <ul>
                @foreach($data['detail_reservasi'] as $d)
                    @if($d->no_reservasi == $r->no_reservasi)
                        @foreach($kamar as $k)
                            @if($d->no_kamar == $k->no_kamar)
                                <li><h4>Kamar {{ $k->nama_kamar }}</h4></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </ul>
            @endforeach
        </div>
    </body>
</html>