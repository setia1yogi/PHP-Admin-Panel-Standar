<?php
// initialize session data
session_start();

// include file function
require 'functions.php';

// check session or login manage
if(!$_SESSION["login"]) header("Location: login.php");

if(isset($_POST["submit"])){
    
    if(register($_POST) > 0){
        echo "
        <script>
            confirm('Registrasi admin berhasil');
            document.location.href = 'index.php';
        </script>
        ";
    }else{
        echo "
        <script>
            alert('Registrasi admin gagal');
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register admin user</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-two.css">
</head>
<body>
<div class="container">

<h1 class="title">Register admin user</h1>
<h4 class="text-center mb-4">Universitas Pemulang</h4>

<!-- form -->
<form action="" method="post" autocomplete="off">
    <div class="form-group">
      <label for="nama">User Name</label>
      <input type="text" class="form-control" id="username" placeholder="Masukan User Name" name="username" required>
    </div>
    <div class="form-group">
      <label for="Email">Email</label>
      <input type="email" class="form-control" id="Email" placeholder="Masukan Email" name="email" required>
    </div>
    <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" class="form-control" id="Password" placeholder="Masukan Password" name="password" required>
    </div>
    <div class="form-group">
        <label for="konfirmasi_password">Konfirmasi Password</label>
        <input type="password" class="form-control" id="konfirmasi_password" placeholder="Masukan konfirmasi password" name="konfirmasi_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus mengandung setidaknya 8 karakter, termasuk angka, huruf besar, dan huruf kecil" required>
    </div>
    <button type="submit" class="btn btn-primary mb-2 submit" name="submit">Simpan</button>
</form>
<!-- end form -->
</div>
</body>
</html>