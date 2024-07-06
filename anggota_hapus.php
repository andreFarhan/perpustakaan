<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_anggota = $_GET['id_anggota'];

	if (isset($id_anggota)) {
		if (hapusAnggota($id_anggota) > 0) {
			setAlert('Berhasil!','Data Berhasil Dihapus','success');
			header("Location: anggota_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Dihapus','error');
			header("Location: anggota_show.php");
			die;
		}
	}
 ?>