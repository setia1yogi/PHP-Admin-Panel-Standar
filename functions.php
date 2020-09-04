<?php

// Connect Database
$link = mysqli_connect("localhost", "root", "", "universitas_pamulang");

if(!$link) mysqli_error($link);


// Interacte Database

// Queries handler function
function query($query) {

    global $link;
    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);//Mengambil(fetch) hasil queri dan diubah ke dalam bentuk array assosiatif

    return $data;
}
 
// Insert data to database function
function add_data($data){
    
    global $link;

    // get data 
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $photo = upload();

    // check Nim 
    $result = mysqli_query($link, "SELECT nim FROM data_mahasiswa WHERE nim = '$nim' ");

    if ( mysqli_fetch_assoc($result) ){
        echo "
        <script>
            alert('Nim yang didaftarkan sudah ada!');
        </script>
        ";
        return false;
    }

    // run queries to insert data to database
    $query = "INSERT INTO data_mahasiswa VALUES ('', '$nama', '$nim', '$alamat', '$jurusan', '$email', '$no_hp', '$photo')";
    mysqli_query($link, $query);

    // Check succes insert
    return mysqli_affected_rows($link);
}

// Upload image handler
function upload(){
    global $link;

    $namaFile = $_FILES["photo"]["name"];
    $ukuranFile = $_FILES["photo"]["size"];
    $error = $_FILES["photo"]["error"];
    $tempName =  $_FILES["photo"]["tmp_name"];

    // error check
    if ($error === 4) {
        echo "<script>
                alert('silahkan masukan gambar terlebih dahulu');
            </script>";
        return false;
    }

    // set valid extension
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // check validation image extension
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
                alert('data yang diupload harus gambar!');
            </script>";
        return false;
    }

    // Limit size image
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('gambar yang diupload harus kurang dari 1MB !');
            </script>";
        return false;
    }

    // if pass the requirement
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tempName, 'img/'.$namaFileBaru);

    // return nama file untuk ditampilkan di table
    return $namaFileBaru;
}

// Update Data
function update($data){
    global $link;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $photoLama = htmlspecialchars($data["photoLama"]);

    // check Nim 
    $result = mysqli_query($link, "SELECT nim FROM data_mahasiswa WHERE nim = '$nim' ");

    if ( mysqli_fetch_assoc($result) ){
        echo "
        <script>
            alert('Nim yang didaftarkan sudah ada!');
        </script>
        ";
        return false;
    }

    // check image
    if ($_FILES["photo"]["error"] == 4) {
        $photo=$photoLama;
    } else {
        $photo = upload();
    }

    // run queries to update data
    $query = "UPDATE data_mahasiswa SET nama = '$nama', nim = '$nim', alamat = '$alamat', email = '$email', no_hp = '$no_hp', jurusan = '$jurusan', photo = '$photo' WHERE id = '$id' ";
    mysqli_query($link, $query);

    // check succes update
    return mysqli_affected_rows($link);
}

// Delete Data
function erase($data){
    global $link;

    mysqli_query($link, "DELETE FROM data_mahasiswa WHERE id = $data ");

    return mysqli_affected_rows($link);
}

// Search Data
function search($keyword){

    $query = "SELECT * FROM data_mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR email LIKE '%$keyword%' OR no_hp LIKE '%$keyword%' ";

    return query($query);
}

// Register admin user

function register($data){

    global $link;

    $username = strtolower(stripslashes($data["username"]));
    $email = $data["email"];
    $password = $data["password"];
    $konfirmasi_password = $data["konfirmasi_password"];

    // check username
    $result = mysqli_query($link, "SELECT username FROM admin_users WHERE username = '$username' ");

    if ( mysqli_fetch_assoc($result) ){
        echo "
        <script>
            alert('username yang didaftarkan sudah ada!');
        </script>
        ";
        return false;
    }

    // check confirm password
    if($password === $konfirmasi_password){

        // encryption password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO admin_users VALUES ('', '$username', '$email', '$password') ";
        mysqli_query($link, $query);

        // Check succes insert
        return mysqli_affected_rows($link);
    }else{
        echo "
        <script>
            alert('konfirmasi password salah!!');
        </script>
        ";
        return false;
    }

}
?>