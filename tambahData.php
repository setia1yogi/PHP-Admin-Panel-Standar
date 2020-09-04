<?php
// initialize session data
session_start();

// include file function
require 'functions.php';

// check session or login manage
if(!$_SESSION["login"]) header("Location: login.php");

// check submit
if(isset($_POST["submit"])){
    add_data($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-two.css">
</head>
<body>
<div class="container">

<h1 class="title">Tambah Data Mahasiswa</h1>
<h4 class="text-center mb-4">Universitas Pemulang</h4>

<!-- form -->
<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Mahasiswa" name="nama" required>
    </div>
    <div class="form-group">
      <label for="nim">Nim</label>
      <input type="number" class="form-control" id="nim" placeholder="Masukan Nim Mahasiswa" name="nim" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat" name="alamat" required>
    </div>
    <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <select class="form-control" id="jurusan" name="jurusan" required>
          <option>Teknik Industri</option>
          <option>Teknik Informatika</option>
          <option>Teknik Kimia</option>
          <option>Manajemen</option>
          <option>Matematika</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="nama@gmail.com" name="email" required>
    </div>
    <div class="form-group">
        <label for="no_hp">No. Hp</label>
        <input type="number" class="form-control" id="no_hp" placeholder="Masukan No.Hp" name="no_hp" required>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" class="form-control-file" id="photo" name="photo" required>
    </div>
    <button type="submit" class="btn btn-primary mb-2 submit" name="submit">Simpan</button>
</form>
<!-- end form -->
</div>
</body>
</html>