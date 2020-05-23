<!DOCTYPE html>
@extends('master_customer')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comfy Hotel | Login</title>
</head>
<body>
    <nav class="navbar-position">
        <a class="navbar-position-link" href="/">Home / </a>
        <a href="/customer/login" class="navbar-position-link"> Login</a>
    </nav>
    @section('content')
    <div class="container">
        <table>
            <tr>
                <th>
                    <div class="container-login-customer">
                        <form action="/customer/cek_customer" method="post">
                            {{ csrf_field() }}
                            <p class="label-login-customer">Welcome</p>
                            <div class="form-group">
                                <input type="text" class="form-username-customer" name="username" value="{{ old('username') }}" placeholder="Username">
                            </div>
                            <div class="form-group" style="margin-bottom: 30px;">
                                <input type="password" class="form-password-customer" name="password" placeholder="Password">
                                @if($errors->has('username'))
                                    <p class="form-error">Username atau password salah</p>
                                @endif
                                <a href="" class="forgot-password">Lupa kata sandi?</a>
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" class="button-login" value="Login">
                            </div>
                        </form>
                        
                    </div>
                </th>
                <th>
                    <div class="tulisan-login">
                        <h1 class="judul-tulisan-login">Selamat datang</h1>
                        <p class="isi-tulisan-login">Login dengan akun milik Anda. </p>
                        <p class="isi-tulisan-login">Apabila anda belum memiliki akun, silahkan lakukan pendaftaran terlebih dahulu.</p>
                        <p class="isi-tulisan-login">Belum punya akun? <a href="/customer/signup">Daftar</a></p>
                    </div>
                </th>
            </tr>
        </table>
    </div>
    @endsection
</body>
</html>