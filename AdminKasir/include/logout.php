<?php
	session_start(); //perintah agar file ini membaca/mengenal/memulai session
	unset($_SESSION['kasir']);
	echo '<script languange="javascript">alert ("Logout Sukses")</script>';
	echo '<script languange="javascript">window.location="../../index.php"</script>';
?>