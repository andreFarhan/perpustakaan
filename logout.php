<?php 
	include 'functions.php';
	session_unset();
	session_destroy();
	header("Location: login_form.php");
 ?>