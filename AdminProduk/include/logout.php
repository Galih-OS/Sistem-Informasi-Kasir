<?php
	session_start(); //perintah agar file ini membaca/mengenal/memulai session
	unset($_SESSION['produk']);
	echo '<script languange="javascript">alert ("Logout Sukses")</script>';
	echo '<script languange="javascript">window.location="../../index.php"</script>';
?>