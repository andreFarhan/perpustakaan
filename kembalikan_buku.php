<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_transaksi = $_GET['id_transaksi'];

	if (kembalikan($id_transaksi) > 0) {
		setAlert('Berhasil!','Buku Berhasil Dikembalikan','success');
		header("Location: transaksi_show.php");
		die;
	}else{
		setAlert('Gagal!','Buku Gagal Dikembalikan','error');
		header("Location: transaksi_show.php");
		die;
	}

 ?>