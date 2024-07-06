<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_anggota
			ORDER BY id_anggota DESC
			";
	$eksekusi = mysqli_query($koneksi, $sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Anggota</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<h3 class="mt-3">Anggota</h3>
		<table class="table table-striped" id="Table">
			<thead class="text-white" style="background-color: #CD1818">
				<tr>
					<th width="1%">NO</th>
					<th>NAMA</th>
					<th>JENIS KELAMIN</th>
					<th>ALAMAT</th>
					<th>NO. TELEPON</th>
					<th>EMAIL</th>
					<th width="1%">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= ucwords($data['nama_anggota']); ?></td>
					<td><?= $data['jenis_kelamin']; ?></td>
					<td><?= $data['alamat_anggota']; ?></td>
					<td><?= $data['telp_anggota']; ?></td>
					<td><?= $data['email']; ?></td>
					<td>
						<a id="tombol-hapus" href="anggota_ubah.php?id_anggota=<?= $data['id_anggota']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
						<a onclick="return confirm('Apakah Anda Ingin Menghapus <?= ucwords($data['username']); ?> ?')" href="anggota_hapus.php?id_anggota=<?= $data['id_anggota']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
