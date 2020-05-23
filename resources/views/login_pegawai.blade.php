<!DOCTYPE html>
<html>
<head>
    <title>Reservasi Hotel | Login Pegawai</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <center>
        <div class="box-login-pegawai">
            <form action="/pegawai/cek_pegawai" method="post">
            {{ csrf_field() }}
            <h2>Login Pegawai</h2>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Login">
            </div>
            </form>
            <p>{{ @Session::get('pesan_login') }}</p>
        </div>
        </center>
    </div>
</body>
</html>