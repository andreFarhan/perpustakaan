<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahBuku($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: buku_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: buku_show.php");
			die;
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Buku</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH BUKU</h3>									
					<div class="form-group">
						<label for="judul">JUDUL BUKU</label>
						<input type="text" class="form-control" name="judul" required>
					</div>
					<div class="form-group">
						<label for="pengarang">PENGARANG</label>
						<input type="text" class="form-control" name="pengarang" required>
					</div>
					<div class="form-group">
						<label for="penerbit">PENERBIT</label>
						<input type="text" class="form-control" name="penerbit" required>
					</div>
					<div class="form-group">
						<label for="tahun_terbit">TAHUN TERBIT</label>
						<input type="number" class="form-control" name="tahun_terbit" required>
					</div>
					<div class="form-group">
						<label for="kategori">KATEGORI</label>
						<input type="text" class="form-control" name="kategori" required>
					</div>
					<div class="form-group">
						<label for="stok">STOK</label>
						<input type="number" class="form-control" name="stok" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="buku_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>