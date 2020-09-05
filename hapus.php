<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'fungsi/functions.php';

$id = $_GET["id"];

if( hapus($id) > 0 ) {
	setcookie('hapusBerhasil', 'berhasil',time()+5);
	echo "
			<script>				
				document.location.href = 'datamhs.php';
			</script>
		";
}else {
	setcookie('hapusGagal', 'gagal',time()+5);
	echo "
			<script>				
				document.location.href = 'datamhs.php';
			</script>
		";
}

?>