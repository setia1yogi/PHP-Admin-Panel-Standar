<?php
// initialize session data
session_start();

// include file function
require 'functions.php';

// check session or login manage
if(!$_SESSION["login"]) header("Location: login.php");

if(isset($_POST["submit"])) {
    if(update($_POST) > 0){
        echo "
            <script>
                alert('data berhasil diubah');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('data gagal diubah');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

// Get sampel data id for select data
$id = $_GET["id"];

// run queries to select data
$mahasiswa = query("SELECT * FROM data_mahasiswa WHERE id=$id")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-two.css">
</head>
<body>
<div class="container">

<h1 class="title">Update Data Mahasiswa</h1>
<h4 class="text-center mb-4">Universitas Pemulang</h4>

<!-- form -->
<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="id" value=<?= $mahasiswa["id"]?>>
    <input type="hidden" name="photoLama" value="<?= $mahasiswa["photo"]; ?>" >
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Mahasiswa" name="nama" value="<?= $mahasiswa["nama"]; ?>" required>
    </div>
    <div class="form-group">
      <label for="nim">Nim</label>
      <input type="number" class="form-control" id="nim" placeholder="Masukan Nim Mahasiswa" name="nim" value="<?= $mahasiswa["nim"]; ?>" min="12" max="12" title="Nim harus berjumlah 12" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat" name="alamat" value="<?= $mahasiswa["alamat"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <select class="form-control" id="jurusan" name="jurusan" aria-selected="<?= $mahasiswa["jurusan"]; ?>" required>
          <option>Teknik Industri</option>
          <option>Teknik Informatika</option>
          <option>Teknik Kimia</option>
          <option>Manajemen</option>
          <option>Matematika</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="<?= $mahasiswa["email"]; ?>" name="email" required>
    </div>
    <div class="form-group">
        <label for="no_hp">No. Hp</label>
        <input type="number" class="form-control" id="no_hp" value="<?= $mahasiswa["no_hp"]; ?>" name="no_hp" required>
    </div>
    <div class="form-group">
        <img src="img/<?= $mahasiswa["photo"]; ?>" alt="photo" width="150">
        <input type="file" class="form-control-file" id="photo" name="photo">
    </div>
    <button type="submit" class="btn btn-primary mb-2 submit" name="submit">Simpan</button>
</form>
<!-- end form -->
</div>
</body>
</html>