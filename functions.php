<?php 
	
	session_start();

	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "db_perpustakaan";

	$koneksi = mysqli_connect($host,$user,$password,$database);

	date_default_timezone_set('asia/jakarta');

	function tambahUser($data){
		global $koneksi;
		$username = $data['username'];
		$password = $data['password'];
		$password2 = $data['password2'];
		$nama_user = ucwords(strtolower($data['nama_user']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_user = $data['alamat_user'];
		$telp_user = $data['telp_user'];
		$email = $data['email'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			setAlert('Gagal!','Username Telah Digunakan','error');
			header("Location: user_tambah.php");
			die;
		}
		if ($password !== $password2) {
			setAlert('Gagal!','Konfirmasi Password Salah','error');
			header("Location: user_tambah.php");
			die;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO tb_user VALUES('','$username','$password','$nama_user','$jenis_kelamin','$alamat_user','$telp_user','$email')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);

	}

	function tambahAnggota($data){
		global $koneksi;
		$username = $data['username'];
		$password = $data['password'];
		$password2 = $data['password2'];
		$nama_anggota = ucwords(strtolower($data['nama_anggota']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_anggota = $data['alamat_anggota'];
		$telp_anggota = $data['telp_anggota'];
		$email = $data['email'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			setAlert('Gagal!','Username Telah Digunakan','error');
			header("Location: anggota_tambah.php");
			die;
		}
		if ($password !== $password2) {
			setAlert('Gagal!','Konfirmasi Password Salah','error');
			header("Location: anggota_tambah.php");
			die;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO tb_anggota VALUES('','$username','$password','$nama_anggota','$jenis_kelamin','$alamat_anggota','$telp_anggota','$email')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);

	}


	function tambahBuku($data){
		global $koneksi;
		$judul = $data['judul'];
		$pengarang = $data['pengarang'];
		$penerbit = $data['penerbit'];
		$tahun_terbit = $data['tahun_terbit'];
		$kategori = $data['kategori'];
		$stok = $data['stok'];

		$sql = "INSERT INTO tb_buku VALUES('','$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$kategori', '$stok')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function tambahTransaksi($data){
		global $koneksi;
		$id_anggota = $data['id_anggota'];
		$id_buku = $data['id_buku'];
		$tanggal_peminjaman = $data['tanggal_peminjaman'];
		$tanggal_pengembalian = $data['tanggal_pengembalian'];
		$status = $data['status'];

		$sql = "INSERT INTO tb_transaksi VALUES('','$id_anggota','$id_buku','$tanggal_peminjaman','$tanggal_pengembalian','$status', '')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_insert_id($koneksi);
	}

	function ubahUser($data){
		global $koneksi;
		$id_user = $data['id_user'];
		$username = $data['username'];
		$password = $data['password'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password2 = $data['password2'];
		$password_lama = $data['password_lama'];
		$nama_user = ucwords(strtolower($data['nama_user']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_user = $data['alamat_user'];
		$telp_user = $data['telp_user'];
		$email = $data['email'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$fetch = mysqli_fetch_assoc($result);
		$password_lama_verify = password_verify($password_lama, $fetch['password']);

		if ($password !== $password2) {
			echo "
			<script>
			alert('Konfirmasi Password tidak sama!')
			</script>
			";
			return false;
		}

		if ($password_lama_verify) {
			$sql = "UPDATE tb_user SET nama_user = '$nama_user', password = '$password_hash', jenis_kelamin = '$jenis_kelamin', alamat_user = '$alamat_user', telp_user = '$telp_user', email = '$email' WHERE id_user = '$id_user'";
			$eksekusi = mysqli_query($koneksi, $sql);

			return mysqli_affected_rows($koneksi);
		}else{
			echo "
			<script>
			alert('Password Lama tidak benar!')
			</script>
			";
			return false;
		}

	}

	function ubahAnggota($data){
		global $koneksi;
		$id_anggota = $data['id_anggota'];
		$username = $data['username'];
		$password = $data['password'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password2 = $data['password2'];
		$password_lama = $data['password_lama'];
		$nama_anggota = ucwords(strtolower($data['nama_anggota']));
		$jenis_kelamin = $data['jenis_kelamin'];
		$alamat_anggota = $data['alamat_anggota'];
		$telp_anggota = $data['telp_anggota'];
		$email = $data['email'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE username = '$username'");
		$fetch = mysqli_fetch_assoc($result);
		$password_lama_verify = password_verify($password_lama, $fetch['password']);

		if ($password !== $password2) {
			echo "
			<script>
			alert('Konfirmasi Password tidak sama!')
			</script>
			";
			return false;
		}

		if ($password_lama_verify) {
			$sql = "UPDATE tb_anggota SET nama_anggota = '$nama_anggota', password = '$password_hash', jenis_kelamin = '$jenis_kelamin', alamat_anggota = '$alamat_anggota', telp_anggota = '$telp_anggota', email = '$email' WHERE id_anggota = '$id_anggota'";
			$eksekusi = mysqli_query($koneksi, $sql);

			return mysqli_affected_rows($koneksi);
		}else{
			echo "
			<script>
			alert('Password Lama tidak benar!')
			</script>
			";
			return false;
		}

	}

	function ubahBuku($data){
		global $koneksi;
		$id_buku = $data['id_buku'];
		$judul = $data['judul'];
		$pengarang = $data['pengarang'];
		$penerbit = $data['penerbit'];
		$tahun_terbit = $data['tahun_terbit'];
		$kategori = $data['kategori'];
		$stok = $data['stok'];

		$sql = "UPDATE tb_buku SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit', kategori = '$kategori', stok = '$stok' WHERE id_buku = '$id_buku'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function ubahTransaksi($data){
		global $koneksi;
		$id_transaksi = $data['id_transaksi'];
		$id_anggota = $data['id_anggota'];
		$id_buku = $data['id_buku'];
		$tanggal_peminjaman = $data['tanggal_peminjaman'];
		$tanggal_pengembalian = $data['tanggal_pengembalian'];
		$status = $data['status'];

		$sql = "UPDATE tb_transaksi SET id_anggota = '$id_anggota', id_buku = '$id_buku', tanggal_peminjaman = '$tanggal_peminjaman', tanggal_pengembalian = '$tanggal_pengembalian', status = '$status' WHERE id_transaksi = '$id_transaksi'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function kembalikan($id){
		global $koneksi;
		$sql = "UPDATE tb_transaksi SET status = 'dikembalikan' WHERE id_transaksi = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusUser($id){
		global $koneksi;
		$sql = "DELETE FROM tb_user WHERE id_user = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusAnggota($id){
		global $koneksi;
		$sql = "DELETE FROM tb_anggota WHERE id_anggota = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}
	
	function hapusBuku($id){
		global $koneksi;
		$sql = "DELETE FROM tb_buku WHERE id_buku = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusTransaksi($id){
		global $koneksi;
		$sql = "DELETE FROM tb_transaksi WHERE id_transaksi = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function setAlert($title='',$text='',$type='',$buttons=''){

		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 

	}

	if (isset($_SESSION['alert'])) {

		function alert(){
			$title 		= $_SESSION["alert"]["title"];
			$text 		= $_SESSION["alert"]["text"];
			$type 		= $_SESSION["alert"]["type"];
			$buttons	= $_SESSION["alert"]["buttons"];

			echo"
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');

				if(text != '' && type != '' && title != ''){
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
			";
			unset($_SESSION["alert"]);
		}
	}
 ?>