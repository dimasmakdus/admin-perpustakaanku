<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'fungsi/functions.php';


$id = $_GET["id"];

if( hapusbuku($id) > 0 ) {
	echo "
			<script>
				alert('data berhasil dihapus');
				document.location.href = 'daftarbuku.php';
			</script>
		";
}else {
	echo "
			<script>
				alert('data gagal dihapus');
				document.location.href = 'daftarbuku.php';
			</script>
		";
}

?>