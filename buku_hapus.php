<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_buku = $_GET['id_buku'];

	if (hapusBuku($id_buku) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: buku_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: buku_show.php");
		die;
	}
 ?>