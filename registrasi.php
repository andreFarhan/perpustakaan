<?php 

	include 'functions.php';

	if (isset($_POST['submit'])) {
		if (tambahAnggota($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: login_form.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: login_form.php");
			die;
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Anggota</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="font-awesome/css/all.min.css">
</head>
<body style="background-image: url(img/form-login.jpg); background-repeat: no-repeat; background-size: cover;" class="img-fluid">
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">REGISTRASI ANGGOTA</h3>
					<div class="form-group">
						<label for="nama_anggota">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_anggota" required>
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">JENIS KELAMIN</label>
						<select name="jenis_kelamin" class="form-control" required>
							<option hidden>PILIH JENIS KELAMIN</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="alamat_anggota">ALAMAT</label>
						<textarea name="alamat_anggota" class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label for="telp_anggota">NO. HANDPHONE</label>
						<input type="number" class="form-control" name="telp_anggota" required>
					</div>
					<div class="form-group">
						<label for="email">EMAIL</label>
						<input type="text" class="form-control" name="email" required>
					</div>
					<div class="form-group">
						<label for="username">USERNAME</label>
						<input type="text" class="form-control" name="username" required>
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
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="login_form.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>