<!DOCTYPE html>
    @extends('master_customer')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comfy Hotel | Sign Up</title>
</head>
<body>
    <nav class="navbar-position">
        <a class="navbar-position-link" href="/">Home </a> / 
        <a href="signup" class="navbar-position-link"> Sign Up</a>
    </nav>
    @section('content')
    <div class="container">
        <table>
            <tr>
                <th>
                    <div class="container-signup-customer">
                        <form action="/customer/signup_customer" method="post">
                            {{ csrf_field() }}
                            <p class="label-login-customer">Buat akun</p>
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
                                <p class="form-error">{{ @Session::get('pesan_nohp') }}</p>
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
                                <p class="form-error">{{ @Session::get('pesan_username') }}</p>
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
                                <input type="submit" value="Daftar" class="button-login">
                            </div>
                        </form>
                    </div>
                </th>
                <th>
                    <div class="tulisan-login">
                        <h1 class="judul-tulisan-login">Daftarkan diri Anda!</h1>
                        <p class="isi-tulisan-login">Dengan mendaftarkan diri, Anda dapat melakukan reservasi, melihat riwayat reservasi Anda, dan berbagai penawaran lain yang kami miliki.</p>
                    </div>
                </th>
            </tr>
        </table>
    </div>
    @endsection
</body>
</html>