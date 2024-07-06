<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahTransaksi($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: transaksi_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: transaksi_show.php");
			die;
		}
	}

	if (isset($_SESSION['id_anggota'])) {
		$id_anggota_where = $_SESSION['id_anggota'];
		$sql_anggota_where = "SELECT * FROM tb_anggota WHERE id_anggota = '$id_anggota_where'";
		$eksekusi_anggota_where = mysqli_query($koneksi, $sql_anggota_where);
		$data_anggota_where = mysqli_fetch_assoc($eksekusi_anggota_where);
	}else{
		$sql_anggota = "SELECT * FROM tb_anggota";
		$eksekusi_anggota = mysqli_query($koneksi, $sql_anggota);
	}



	$sql_buku = "SELECT * FROM tb_buku";
	$eksekusi_buku = mysqli_query($koneksi, $sql_buku);

	if (isset($_GET['id_buku'])) {
		$id_buku = $_GET['id_buku'];
		$eksekusibuku = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id_buku = '$id_buku'");
		$judul = mysqli_fetch_assoc($eksekusibuku);
	}

	 // Ambil tanggal sekarang dalam format Y-m-d
    $tanggal_sekarang = date('Y-m-d');
    
    // Ubah format tanggal jadi seperti 09 June 2024
    $tanggal_formatted = date('d F Y', strtotime($tanggal_sekarang));

    // Tambah 3 hari ke tanggal sekarang
    $tanggal_plus_tiga = date('Y-m-d', strtotime($tanggal_sekarang . ' +3 days'));
    
    // Ubah format tanggal jadi 09 June 2024
    $tanggal_formatted_plus_tiga = date('d F Y', strtotime($tanggal_plus_tiga));
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Transaksi</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH TRANSAKSI</h3>
					<div class="form-group">
						<label for="nama_anggota">NAMA ANGGOTA</label>
	
					<?php if (isset($_SESSION['id_anggota'])) : ?>
						<input type="hidden" name="id_anggota" value="<?= $_SESSION['id_anggota']; ?>">
						<input type="text" class="form-control" value="<?= $data_anggota_where['nama_anggota']; ?>" disabled>
					<?php else: ?>
						<select name="id_anggota" class="form-control">
							<option hidden>-- PILIH ANGGOTA --</option>
							<?php while ($data_anggota = mysqli_fetch_assoc($eksekusi_anggota)) : ?>
								<option value="<?= $data_anggota['id_anggota']; ?>"><?= $data_anggota['nama_anggota']; ?></option>
							<?php endwhile ?>
						</select>
					<?php endif ?>
					</div>
					<div class="form-group">
						<label for="id_buku">JUDUL BUKU</label>
						<select name="id_buku" class="form-control">
							<?php if (isset($_GET['id_buku'])): ?>
								<option value="<?= $id_buku; ?>"><?= $judul['judul']; ?></option>
							<?php else: ?>
								<?php while ($data_buku = mysqli_fetch_assoc($eksekusi_buku)): ?>
									<option value="<?= $data_buku['id_buku']; ?>"><?= $data_buku['judul']; ?></option>
								<?php endwhile ?>
							<?php endif ?>
						</select>
					</div>
					<div class="form-group">
						<label for="tanggal_peminjaman">TANGGAL PEMINJAMAN</label>
						<input type="hidden" name="tanggal_peminjaman" value="<?= date('Y-m-d'); ?>">
					    <input type="text" class="form-control" value="<?= $tanggal_formatted; ?>"disabled>
					</div>
					<div class="form-group">
						<label for="tanggal_pengembalian">TANGGAL PENGEMBALIAN</label>
						<input type="hidden" name="tanggal_pengembalian" value="<?= $tanggal_plus_tiga; ?>">
					    <input type="text" class="form-control" value="<?= $tanggal_formatted_plus_tiga; ?>"disabled>
					</div>
					<p>* Wajib Dikembalikan Pada Tanggal yang Ditentukan!!</p>
					<input type="hidden" name="status" value="dipinjam">
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">PINJAM</button>
						<a class="btn btn-outline-primary" href="transaksi_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>


<?php include 'footer.php'; ?>

</html>