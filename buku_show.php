<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_buku";
	$eksekusi = mysqli_query($koneksi, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buku</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">BUKU</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #CD1818">
				<tr>
					<th width="1%">NO</th>
					<th>JUDUL</th>
					<th>PENGARANG</th>
					<th>PENERBIT</th>
					<th>TAHUN TERBIT</th>
					<th>KATEGORI</th>
					<th>STOK</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= ucwords($data['judul']); ?></td>
					<td><?= $data['pengarang']; ?></td>
					<td><?= $data['penerbit']; ?></td>
					<td><?= $data['tahun_terbit']; ?></td>
					<td><?= $data['kategori']; ?></td>
					<td><?= $data['stok']; ?></td>
					<?php if (isset($_SESSION['id_user'])): ?>
					<td>
						<a href="buku_ubah.php?id_buku=<?= $data['id_buku']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah anda ingin menghapus buku <?= $data['judul']; ?> ?')" href="buku_hapus.php?id_buku=<?= $data['id_buku']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
					<?php else: ?>
					<td><a href="transaksi_tambah.php?id_buku=<?= $data['id_buku']; ?>" class="btn btn-primary">Pinjam</a></td>
					<?php endif ?>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>