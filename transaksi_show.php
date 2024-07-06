<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}
	if (isset($_SESSION['id_anggota'])) {
		$id_anggota = $_SESSION['id_anggota'];
		$sql = "SELECT * FROM tb_transaksi 
			INNER JOIN tb_anggota ON tb_transaksi.id_anggota = tb_anggota.id_anggota
			INNER JOIN tb_buku ON tb_transaksi.id_buku = tb_buku.id_buku
			WHERE tb_anggota.id_anggota = $id_anggota
			ORDER BY id_transaksi DESC
			";
		$eksekusi = mysqli_query($koneksi, $sql);
	}else{
		$sql = "SELECT * FROM tb_transaksi 
			INNER JOIN tb_anggota ON tb_transaksi.id_anggota = tb_anggota.id_anggota
			INNER JOIN tb_buku ON tb_transaksi.id_buku = tb_buku.id_buku
			ORDER BY id_transaksi DESC
			";
		$eksekusi = mysqli_query($koneksi, $sql);
	}

	if (isset($_POST['submit'])) {
		if (kembalikan($_POST) > 0) {
			setAlert('Berhasil!','Buku Berhasil Dikembalikan','success');
			header("Location: transaksi_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: transaksi_show.php");
			die;
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Transaksi</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">TRANSAKSI</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #CD1818;">
				<tr>
					<th width="1%">NO</th>
					<?php if (isset($_SESSION['id_anggota'])): ?>
					<?php else: ?>
					<th>USER</th>
					<?php endif ?>
					<th>BUKU</th>
					<th>TANGGAL PEMINJAMAN</th>
					<th>TANGGAL PENGEMBALIAN</th>
					<th>STATUS</th>
					<th>DENDA</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<?php 
					$tanggal_peminjaman = date('d F Y', strtotime($data['tanggal_peminjaman']));
					$tanggal_pengembalian = date('d F Y', strtotime($data['tanggal_pengembalian']));
				 ?>
				<tr>
					<td><?= $i++; ?></td>
					<?php if (isset($_SESSION['id_anggota'])): ?>
					<?php else: ?>
					<td><a href="anggota_show.php?id_anggota=<?= $data['id_anggota']; ?>" style="text-decoration: none; font-weight: bold;"><?= $data['nama_anggota']; ?></a></td>
					<?php endif ?>
					<td><?= $data['judul']; ?></td>
					<td><?= $tanggal_peminjaman; ?></td>
					<td><?= $tanggal_pengembalian; ?></td>
					<td><?= $data['status']; ?></td>
					<td><?= $data['denda']; ?></td>
					<?php if (isset($_SESSION['id_user'])): ?>
					<td>
						<a href="transaksi_ubah.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="badge badge-success"> <i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah anda ingin menghapus transaksi ini?')" href="transaksi_hapus.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="badge badge-danger"> <i class="fa fa-trash"></i></a>
					</td>
					<?php else: ?>
						<?php if ($data['status'] == 'dipinjam'): ?>
						<td><a href="kembalikan_buku.php?id_transaksi=<?= $data['id_transaksi']; ?>" class="btn btn-primary" name="submit">Kembalikan</a></td>
						<?php else: ?>
						<td><a href="#" class="btn btn-success">Selesai</a></td>
						<?php endif ?>
					<?php endif ?>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>