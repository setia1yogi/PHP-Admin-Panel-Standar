<?php
// initialize session data
session_start();

// include file function
require 'functions.php';

// check session or login manage
if(!$_SESSION["login"]) header("Location: login.php");

// get data mahasiswa
$mahasiswa = query("SELECT * FROM data_mahasiswa");

// search submit
if(isset($_POST["submit"])){
    // search data
    $mahasiswa = search($_POST["search"]);
}

// sorting
// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('nama', 'nim');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result
if ($mahasiswa = mysqli_query($link, 'SELECT * FROM data_mahasiswa ORDER BY ' .  $column . ' ' . $sort_order)) {
    // Some variables we need for the table.
    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Unpam</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="shortcut" href=""> -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6c03feffe3.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navigation -->
<nav class="navigation">
    <a href="#">
        <img src="img/unpam.png" alt="Logo-Unpam">
        <h3>Universitas Pamulang</h3>
    </a>
    <div class="panel-user">
        <i class="fa fa-user"></i>
        <div class="user-name">
            <h3>Selamat datang</h3>
            <h3><?= $_SESSION["user_name"]?></h3>
        </div>
    </div>
    <div class="button-nav">
        <a href="logout.php" class="button">Log out</a>
    </div>
</nav>
<!-- End navigation -->

<!-- container -->
<div class="container">

<img class="background-logo" src="img/unpam.png" alt="logo-unpam">

    <!-- Title -->
    <div class="title">
        <img src="img/unpam.png" class="logo-title" alt="Logo-Unpam">
        <img src="img/Seal_of_Ministry_of_Education_and_Culture_of_Indonesia.png" class="logo-title2" alt="Logo-kemdikbud">
        <h1>Data Mahasiswa<br>Universitas Pamulang</h1>
        <h2>Tahun ajaran 2019 / 2020</h2>
        <hr>
    </div>
    <!-- End title -->

    <!-- functional section -->
    <div class="functional-section">
        <div class="search-section">
            <form action="" method="POST">
                <input type="text" name="search" class="search" autocomplete="off" autofocus placeholder="cari disini...." id="keyword">
                <button type="submit" name="submit" id="button-search" class="button">Search</button>
            </form>
        </div>
        <div class="add-data">
            <a href="tambahData.php" class="button">Tambah Data Mahasiswa</a>
        </div>
    </div>
    <!-- End functional section -->

    <!-- Table -->
    <div class="table-wrap">
        <table class="content-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama
                        <a href="index.php?column=nama&order=<?= $asc_or_desc; ?>" style="color:white;">
                        <i class="fas fa-sort<?= $column == 'nama' ? '-' . $up_or_down : ''; ?>"></i></a>
                    </th>
                    <th>Nim
                        <a href="index.php?column=nim&order=<?= $asc_or_desc; ?>" style="color:white;">
                        <i class="fas fa-sort<?= $column == 'nim' ? '-' . $up_or_down : ''; ?>"></i></a>
                    </th>
                    <th>Alamat</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>No hp</th>
                    <th>Photo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- set variable for numbers  -->
                <?php $i = 1;?>
                <?php foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td <?= $column == "nama"; ?>><?= $mhs["nama"]; ?></td>
                    <td><?= $mhs["nim"];?></td>
                    <td><?= $mhs["alamat"];?></td>
                    <td><?= $mhs["jurusan"];?></td>
                    <td><?= $mhs["email"];?></td>
                    <td><?= $mhs["no_hp"];?></td>
                    <td>
                        <img src="img/<?= $mhs["photo"];?>" alt="" width="40">
                    </td>
                    <td>
                        <a href="updateData.php?id=<?= $mhs["id"]; ?>">Edit</a>
                        <a href="hapusData.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Yakin ingin hapus data ? '); ">Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- End table -->
</div>
<!-- End container -->

<!-- footer -->
<footer>
    <div class="footer">
        <div class="footer-left">
            <p>Copyright reserved by yogie setiawan 2020®</p>
        </div>
        <div class="footer-right">
                <a href="registrasi.php" class="button">Registrasi Admin</a>
        </div>
    </div>
</footer>
<!-- end footer -->

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>