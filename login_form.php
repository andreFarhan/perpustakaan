<?php 
	include 'functions.php';

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$eksekusi_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$data_user 		= mysqli_fetch_array($eksekusi_user);

		$eksekusi_anggota = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE username = '$username'");
		$data_anggota 		= mysqli_fetch_array($eksekusi_anggota);

		if ($data_user) {
			if (password_verify($password, $data_user['password'])) {

				$id_user 		= $data_user['id_user'];
				$nama_user	= $data_user['nama_user'];
				$username 	= $data_user['username'];
				

				$_SESSION['id_user'] 		= $id_user;
				$_SESSION['nama_user'] 	= $nama_user;
				$_SESSION['username'] 	= $username;
				$_SESSION['login'] 			= 1;
			}else{

			}
		}

		if ($data_anggota) {
			if (password_verify($password, $data_anggota['password'])) {

				$id_anggota 	= $data_anggota['id_anggota'];
				$nama_anggota	= $data_anggota['nama_anggota'];
				$username 		= $data_anggota['username'];
				

				$_SESSION['id_anggota'] 		= $id_anggota;
				$_SESSION['nama_anggota'] 	= $nama_anggota;
				$_SESSION['username'] 			= $username;
				$_SESSION['login'] 					= 1;
			}
			else{

			}
		}
		
	}
	if (isset($_SESSION['login'])) {
		header("Location: dashboard.php");
		exit;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome/css/all.min.css">
</head>
<body style="background-image: url(img/form-login.jpg); background-repeat: no-repeat; background-size: cover;" class="img-fluid">
	<div class="container mt-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded mt-5" style="background-color: sandybrown;">
				<form method="POST">
					<h3 class="font-weight-bold mt-3"><img src="img/logo-perpustakaan.png" alt="Responsive image" width="100px"> HALAMAN LOGIN</h3>
					<div class="form-group">
						<label class="font-weight-bold" for="username">USERNAME</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="password">PASSWORD</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<button type="submit" name="login" class="btn btn-primary">LOGIN <i class="fa fa-sign-in-alt"></i></button>
						<a href="registrasi.php" class="btn btn-success">REGISTRASI <i class="fa fa-user-plus"></i></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<footer class="page-footer text-center text-md-left">
	<div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        &#xA9; 2024 Copyright: <a href="http://www.instagram.com/andre._.farhan" style="text-decoration: none;"> Andre Farhan </a>
      </div>
    </div>
</footer>

<script src="bootstrap/js/jquery-3.4.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="font-awesome/js/all.min.js"></script>

</html>