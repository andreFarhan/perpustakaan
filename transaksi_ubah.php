<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (ubahTransaksi($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: transaksi_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: transaksi_show.php");
			die;
		}
	}

	$id_transaksi = $_GET['id_transaksi'];
	$sql = "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	$sql_anggota = "SELECT * FROM tb_anggota";
	$eksekusi_anggota = mysqli_query($koneksi, $sql_anggota);
	

	$sql_buku = "SELECT * FROM tb_buku";
	$eksekusi_buku = mysqli_query($koneksi, $sql_buku);

	// Fungsi untuk mengubah format tanggal ke bentuk 10 June 2024
	function formatTanggal($tanggal) {
	    $bulan = [
	        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
	        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
	        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
	    ];
	    $dateObj = DateTime::createFromFormat('Y-m-d', $tanggal);
	    $bulanNama = $bulan[$dateObj->format('m')];
	    return $dateObj->format('d') . ' ' . $bulanNama . ' ' . $dateObj->format('Y');
	}

	$tanggal_peminjaman = formatTanggal($data['tanggal_peminjaman']);
	$tanggal_pengembalian = formatTanggal($data['tanggal_pengembalian']);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Transaksi</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #005082;">
				<form method="POST">
					<h3 class="mt-3">UBAH TRANSAKSI</h3>
					<input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
					<div class="form-group">
						<label for="nama_anggota">NAMA ANGGOTA</label>
						<select name="id_anggota" class="form-control">
							<?php while ($data_anggota = mysqli_fetch_array($eksekusi_anggota)): ?>
								<?php if ($data['id_anggota'] == $data_anggota['id_anggota']): ?>
									<option value="<?= $data_anggota['id_anggota']; ?>" selected><?= $data_anggota['nama_anggota']; ?></option>
								<?php else: ?>
									<option value="<?= $data_anggota['id_anggota']; ?>"><?= $data_anggota['nama_anggota']; ?></option>
								<?php endif ?>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
						<label for="id_buku">JUDUL BUKU</label>
						<select name="id_buku" class="form-control">
							<?php while ($data_buku = mysqli_fetch_array($eksekusi_buku)): ?>
								<?php if ($data['id_buku'] == $data_buku['id_buku']): ?>
									<option value="<?= $data_buku['id_buku']; ?>" selected><?= $data_buku['judul']; ?></option>
								<?php else: ?>
									<option value="<?= $data_buku['id_buku']; ?>"><?= $data_buku['judul']; ?></option>
								<?php endif ?>
							<?php endwhile ?>
						</select>
					</div>
					<div class="form-group">
                        <label for="tanggal_peminjaman">TANGGAL PEMINJAMAN</label>
                        <input type="text" class="form-control" name="tanggal_peminjaman" value="<?= $tanggal_peminjaman; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pengembalian">TANGGAL PENGEMBALIAN</label>
                        <input type="text" class="form-control" name="tanggal_pengembalian" value="<?= $tanggal_pengembalian; ?>" readonly>
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