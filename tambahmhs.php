<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'fungsi/functions.php';

if ( isset($_POST["submit"] )) {

  // cek apakah data berhasil ditambahkan atau tidak?
  if ( tambah($_POST) > 0 ) {
    setcookie('tambahBerhasil', 'berhasil',time()+5);
    echo "
      <script>
        document.location.href = 'datamhs.php';
      </script>
    ";
  } else {
    setcookie('tambahGagal', 'gagal',time()+5);
    echo "
      <script>
        document.location.href = 'datahmhs.php';
      </script>
    ";
  }


}

?>