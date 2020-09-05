<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'fungsi/functions.php';

// cek apakah tombol submit udah ditekan atau belum?
if ( isset($_POST["submit"] )) {

        // cek apakah data berhasil diubah atau tidak?
        if ( ubah($_POST) > 0 ) {
            setcookie('ubahBerhasil', 'berhasil',time()+5); 
            echo "<script>
                      document.location.href = 'datamhs.php';
                  </script>
                  ";
        } else {
            setcookie('ubahGagal', 'gagal',time()+5); 
            echo "<script>
                      document.location.href = 'datamhs.php';
                  </script>
                  ";
        }
}


?>


           
  