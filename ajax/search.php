<?php
// include functions
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM data_mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR email LIKE '%$keyword%' OR no_hp LIKE '%$keyword%' ";

$mahasiswa = query($query);

?>

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
        <!-- set variable for numbers -->
        <?php $i = 1;?>
        <?php foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $mhs["nama"]; ?></td>
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