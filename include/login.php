<?php
	session_start(); 		//mulai session, krena kita akan menggunakan session pd file php ini
	include 'connect.php'; 		//hubungkan dengan config.php untuk berhubungan dengan database
	$username=$_POST['username']; 	//tangkap data yg di input dari form login input username
	$password=$_POST['password']; 	//tangkap data yg di input dari form login input password
	
	$query=mysql_query("select * from pegawai where username='$username' and password='$password'");	 //melakukan pengampilan data dari database untuk di cocokkan
	$xxx=mysql_num_rows($query);	 //melakukan pencocokan
	if($xxx){ 		// melakukan pemeriksaan kecocokan dengan percabangan.
		while ($row=mysql_fetch_assoc($query)) {
			$dbusername=$row['username'];
			$dbpassword=$row['password'];
			$dbstatus=$row['bagian'];
			$idpegawai=$row['id_pegawai'];
		}
		if ($username == $dbusername && $password == $dbpassword && $dbstatus == "admin"){
			session_start();
			$_SESSION['admin']=$idpegawai;
			echo '<script languange="javascript">alert ("Login berhasil sebagai Admin")</script>';
			echo '<script languange="javascript">window.location="../AdminSuper/"</script>';
		} else if ($username == $dbusername && $password == $dbpassword && $dbstatus == "gudang") {
			session_start();
			$_SESSION['gudang']=$idpegawai;
			echo '<script languange="javascript">alert ("Login berhasil sebagai Admin Gudang")</script>';
			echo '<script languange="javascript">window.location="../AdminGudang/"</script>';
		} else if ($username == $dbusername && $password == $dbpassword && $dbstatus == "produk") {
			session_start();
			$_SESSION['produk']=$idpegawai;
			echo '<script languange="javascript">alert ("Login berhasil sebagai Admin Produk")</script>';
			echo '<script languange="javascript">window.location="../AdminProduk/"</script>';
		} else if ($username == $dbusername && $password == $dbpassword && $dbstatus == "kasir") {
			session_start();
			$_SESSION['kasir']=$idpegawai;
			echo '<script languange="javascript">alert ("Login berhasil sebagai Kasir")</script>';
			echo '<script languange="javascript">window.location="../AdminKasir/"</script>';
		}
	}else{   				//jika tidak tampilkan pesan gagal login
		echo '<script languange="javascript">alert ("Username/Password Salah, Login Gagal")</script>';
		echo '<script languange="javascript">window.location="../index.php"</script>';
	}
?>