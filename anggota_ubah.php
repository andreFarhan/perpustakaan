<?php  
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_anggota = $_GET['id_anggota'];
	$sql = "SELECT * FROM tb_anggota WHERE id_anggota = $id_anggota";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	if (isset($_POST['submit'])) {
		if (ubahAnggota($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: anggota_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: anggota_show.php");
			die;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Anggota</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">UBAH ANGGOTA</h3>
					<input type="hidden" name="id_anggota" value="<?= $data['id_anggota']; ?>">
					<div class="form-group">
						<label for="nama_anggota">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_anggota" value="<?= $data['nama_anggota']; ?>" required>
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">JENIS KELAMIN</label>
						<select name="jenis_kelamin" class="form-control" required>
							<option value="<?= $data['jenis_kelamin']; ?>" hidden><?= $data['jenis_kelamin']; ?></option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="alamat_anggota">ALAMAT</label>
						<textarea name="alamat_anggota" class="form-control" required><?= $data['alamat_anggota']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="telp_anggota">NO. HANDPHONE</label>
						<input type="number" class="form-control" name="telp_anggota" value="<?= $data['telp_anggota']; ?>" required>
					</div>
					<div class="form-group">
						<label for="email">EMAIL</label>
						<input type="text" class="form-control" name="email" value="<?= $data['email']; ?>" required>
					</div>
					<div class="form-group">
						<label for="username">USERNAME</label>
						<input type="text" class="form-control" value="<?= $data['username']; ?>" disabled>
						<input type="hidden" name="username" value="<?= $data['username']; ?>">
					</div>
					<div class="form-group">
						<label for="password_lama">PASSWORD LAMA</label>
						<input type="password" class="form-control" name="password_lama" required>
					</div>
					<div class="form-group">
						<label for="password">PASSWORD</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<label for="password2">KONFIRMASI PASSWORD</label>
						<input type="password" class="form-control" name="password2" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="anggota_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>