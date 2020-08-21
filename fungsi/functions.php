<?php 

// koneksi ke database
// mysqli_connect("nama_host_database", "username_mysql", "passw_mysql", "nama_database" );
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$fakultas = htmlspecialchars($data["fakultas"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	// upload gambar
	$gambar = upload();
	if ( !$gambar ) {
		return false;
	}

	// query insert data
	$query = "INSERT INTO mahasiswa VALUES ('', '$nim', '$nama', '$fakultas', '$jurusan', '$gambar')";

	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}

function tambahbuku($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;
	$judul = htmlspecialchars($data["judul"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$penulis = htmlspecialchars($data["penulis"]);
	$penerbit = htmlspecialchars($data["penerbit"]);

	// query insert data
	$query = "INSERT INTO buku VALUES ('', '$judul', '$kategori', '$penulis', '$penerbit')";

	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}


function upload() {
	// fugsi upload gambar
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
					alert('Pilih gambar terlebih dahulu...');
				</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
					alert('Yang anda upload bukan gambar..');
				</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ( $ukuranFile > 1000000 ) {
		echo "<script>
					alert('Ukuran gambar terlalu besar!');
				</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'foto/'. $namaFileBaru);
	return $namaFileBaru;

}


function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function hapusbuku($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM buku WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function hapuspinjaman($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM peminjaman WHERE id = $id");
	return mysqli_affected_rows($conn);
}


function ubah($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$id = $data["id"];
	$nama = $data["nama"];
	$nim = $data["nim"];
	$fakultas = $data["fakultas"];
	$jurusan = $data["jurusan"];
	$gambarLama = $data["gambarLama"];

	// cek apakah user pilih gambar baru atau tidak
	if ( $_FILES["gambar"]["error"] === 4) {
		$gambar = $gambarLama;
	}else {
		$gambar = upload();
	}


	// query insert data
	$query = "UPDATE mahasiswa SET 
        nim = '$nim', 
        nama = '$nama',
        fakultas = '$fakultas',
        jurusan = '$jurusan',
        gambar = '$gambar'
      WHERE id = $id
      ";

	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}

function ubahbuku($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$id = $data["id"];
	$judul = $data["judul"];
	$kategori = $data["kategori"];
	$penulis = $data["penulis"];
	$penerbit = $data["penerbit"];

	// query insert data
	$query = "UPDATE buku SET 
       	judul = '$judul', 
        kategori = '$kategori',
        penulis = '$penulis',
        penerbit = '$penerbit'
      WHERE id = $id
      ";

	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}


function cari($keyword) {
	$query = "SELECT * FROM mahasiswa WHERE
				nim LIKE '%$keyword%' OR 
				nama LIKE '%$keyword%' OR 
				fakultas LIKE '%$keyword%' OR 
				jurusan LIKE '%$keyword%' 
			";
	return query($query);
}



function registrasi($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$email = $data["email"];


	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");
	if ( mysqli_fetch_assoc($result) ) {
		echo "<script>
			alert('username sudah terdaftar');
			</script>";
		return false;
	}


	// cek konfirmasi password
	if ( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	// tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('','$username', '$password', '$email')");

	return mysqli_affected_rows($conn);

}


function pinjambuku($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;
	$judul = htmlspecialchars($data["judul"]);
	$nama = htmlspecialchars($data["nama"]);
	$kembali = $data["kembali"];
	$pinjam = $data["pinjam"];

	// hitung selisih waktu pinjam
	$selisih = $pinjam - $kembali;
  	$hasil = $selisih;

	if ($pinjam <= $kembali) {  		
  		$terlambat = "0 hari";
  		$status = "Pinjam";
	} else {
  		$terlambat = "-$hasil hari";
  		$status = "Harus dikembalikan";
	}

	// query insert data
	$query = "INSERT INTO peminjaman VALUES ('', '$nama', '$judul', '$pinjam', '$kembali', '$terlambat', '$status')";

	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);

}


function datakembali($data) {
	global $conn;
	$id = $data["id"];
	$nama = $data["nama"];
	$buku = $data["buku"];
	$pinjam = $data["pinjam"];
	$kembali = $data["kembali"];
	$terlambat = $data["terlambat"];

	$query = "INSERT INTO pengembalian VALUES ('$id', '$nama', '$buku', '$pinjam', '$kembali', '$terlambat')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function namauser($user) {
	global $conn;
	$id = $user["id"];
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id' ");
	$row = mysqli_fetch_assoc($result);

	return $row;
}

?>