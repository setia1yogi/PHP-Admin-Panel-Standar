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
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $result = mysqli_query($link, "SELECT * FROM admin_users WHERE email = '$email' ");
    
    // check username
    if(mysqli_num_rows($result) === 1) {

        // put username to show at index
        $put = mysqli_query($link, "SELECT username FROM admin_users WHERE email = '$email' ");
        $username = mysqli_fetch_all($put, MYSQLI_ASSOC)[0]["username"];

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
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                        </svg></span>
                    </div>
                    <input type="email" class="form-control" id="email" placeholder="Masukan Email Anda" name="email">
                </div>
                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
                        <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                        </svg></span>
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