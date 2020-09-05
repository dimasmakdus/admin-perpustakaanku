<?php 
session_start();
require 'fungsi/functions.php';

// cek cookie
if ( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id' ");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ( $key === hash('sha256', $row["username"]) ) {
        $_SESSION["login"] = true;
    }
}


if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

    // cek password
      $row = mysqli_fetch_assoc($result);
      if ( password_verify($password, $row["password"]) ) { 

        // set session nya
        $_SESSION["login"] = true;
        setcookie('id', $row["id"]); 

       // cek remember me
       if( isset($_POST["remember"]) ) {
          // buat cookie
          setcookie('id', $row["id"], time()+60);
          setcookie('key', hash('sha256', $row["username"], time()+60));    
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
<link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Mahasiswa | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="dist/img/logoaplikasi.png" width="135px" align="center"><br>
    <p style="color:white">
      <b>Perpustakaan</b>
      <br>
    Mahasiswa
  </p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Masukan Username & Password</p>
     
      <form id="quickForm" action="" method="post" >
        <div class="input-group mb-3 form-group">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 form-group">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
          <?php if( isset($error) ) : ?>
            <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fas fa-exclamation-triangle"></i>Username / Password Salah!
                </div>
          <?php endif; ?>

          

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- validation -->
<script>
$(function () {
  $.validator.setDefaults({
    
  });
  $('#quickForm').validate({
    rules: {
      username: {
        required: true,        
      },
      password: {
        required: true,
        minlength: 5
      },      
    },
    messages: {
      username: {
        required: "Tolong masukkan username terlebih dahulu",        
      },
      password: {
        required: "Tolong masukkan password terlebih dahulu",
        minlength: "Password anda kurang dari 5 karakter"
      },
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

</body>
</html>
