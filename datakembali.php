<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'fungsi/functions.php';
require 'tampilusers.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$kembali = query("SELECT * FROM peminjaman WHERE id = $id")[0];


if( datakembali($kembali) && hapuspinjaman($id) > 0 ) {
	echo "
			<script>
				alert('data berhasil dikembalikan');
				document.location.href = 'pengembalian.php';
			</script>
		";
}else {
	echo "
			<script>
				alert('data gagal dikembalikan');
				document.location.href = 'pengembalian.php';
			</script>
		";
}

?>