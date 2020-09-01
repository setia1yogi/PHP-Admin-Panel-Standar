<?php
// initialize session data
session_start();

// include file function
require 'functions.php';

// check session or login manage
if(!$_SESSION["login"]) header("Location: login.php");

$id = $_GET["id"];

if(erase($id) > 0){
    echo "
            <script>
                alert('data berhasil dihapus');
                document.location.href = 'index.php';
            </script>
        ";
}else{
    echo "
            <script>
                alert('data gagal dihapus');
                document.location.href = 'index.php';
            </script>
        ";
}


?>