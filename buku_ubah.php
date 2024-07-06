<?php  
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_buku = $_GET['id_buku'];
	$sql = "SELECT * FROM tb_buku WHERE id_buku = $id_buku";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	if (isset($_POST['submit'])) {
		if (ubahBuku($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: buku_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: buku_show.php");
			die;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Buku</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">UBAH BUKU</h3>
					<input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">
					<div class="form-group">
						<label for="judul">JUDUL BUKU</label>
						<input type="text" class="form-control" name="judul" value="<?= $data['judul']; ?>" required>
					</div>
					<div class="form-group">
						<label for="pengarang">PENGARANG</label>
						<input type="text" class="form-control" name="pengarang" value="<?= $data['pengarang']; ?>" required>
					</div>
					<div class="form-group">
						<label for="penerbit">PENERBIT</label>
						<input type="text" class="form-control" name="penerbit" value="<?= $data['penerbit']; ?>" required>
					</div>
					<div class="form-group">
						<label for="tahun_terbit">TAHUN TERBIT</label>
						<input type="number" class="form-control" name="tahun_terbit" value="<?= $data['tahun_terbit']; ?>" required>
					</div>
					<div class="form-group">
						<label for="kategori">KATEGORI</label>
						<input type="text" class="form-control" name="kategori" value="<?= $data['kategori']; ?>" required>
					</div>
					<div class="form-group">
						<label for="stok">STOK</label>
						<input type="number" class="form-control" name="stok" value="<?= $data['stok']; ?>" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="buku_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>