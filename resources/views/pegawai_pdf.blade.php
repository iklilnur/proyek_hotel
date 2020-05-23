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
			font-size: 8.5pt;
		}
	</style>
        <center><h2>Laporan Pegawai Hotel</h2></center>
        <table style="width:1%" class="table table-bordered">
            <thead style="width:1px">
                <tr>
                    <th>No.</th>
                    <th>Nomor Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Tanggal Lahir</th>
                    <th style="width: 1px">Alamat Pegawai</th>
                    <th>Nomor HP</th>
                    <th>Jenis Kelamin</th>  
                    <th>Tanggal Diterima</th>
                </tr>
            </thead>
            @php $i=1 @endphp
            @foreach($pegawai as $p)
            <tr>
                <td >{{ $i++ }}</td>
                <td >{{ $p-> no_pegawai }}</td>
                <td >{{ $p-> nama_pegawai }}</td>
                <td >{{ $p-> jabatan_pegawai }}</td>
                <td >{{ $p-> tgl_lahir_pegawai }}</td>
                <td >{{ $p-> alamat_pegawai }}</td>
                <td >{{ $p-> nohp_pegawai }}</td>
                @if($p->jk_pegawai == true)
                    <td >Laki-laki</td>
                @else
                    <td >Perempuan</td>
                @endif
                <td >{{ $p-> tgl_diterima }}</td>
            </tr>
            @endforeach
        </table>
</body>
</html>