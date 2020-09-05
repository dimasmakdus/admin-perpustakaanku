<?php 

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$row = namauser($_COOKIE);
$user = $row["username"];


?>