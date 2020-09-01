<?php
// initialize session
session_start();

// include functions 
require 'functions.php';

// check cookie
if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])){
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $result = mysqli_query($link, "SELECT username FROM admin_users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION["login"] = true;
    }
}

// check session
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
} 

// login check
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $result = mysqli_query($link, "SELECT * FROM admin_users WHERE username = '$username' ");
    
    // check username
    if(mysqli_num_rows($result) === 1) {

        // check password
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            $_SESSION["user_name"] = $username;
            // set cookie if checked
            if(isset($_POST["remember"])){
                //buat cookie
                setcookie('id', $row['id']);
                setcookie('key', hash('sha256', $row['username']));
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Login</title>
    <link rel="stylesheet" href="css/style-login.css">
    <!-- Linked font awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
  </head>
  <body>

      
      <div class="container">
          <h1 class="text-center">User Login</h1>
          <hr>
          <?php if (isset($error)) : ?>
              <div class="alert alert-danger" role="alert">
                  Username / password salah !!!
              </div>
          <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="user-name">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="user-name" placeholder="Masukan Username Anda" autocomplete="off" name="username">
                </div>
                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-unlock-alt"></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" placeholder="Masukan Password Anda" autocomplete="off" name="password">
                </div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="cookie" name="cookie">
                <label class="form-check-label" for="cookie">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3 button" name="login">Login</button>
            <button type="reset" class="btn btn-danger mt-3 button">Reset</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>