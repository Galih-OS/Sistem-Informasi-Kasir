<?php
	session_start(); 
	if(isset($_SESSION['produk'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>PT. POLO</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/dashboard.css" rel="stylesheet">

	</head>

	<body>

		<?php include 'header.php'; ?>

		<div class="container-fluid">
		  <div class="row">
				<div class="col-sm-2 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><?php include ("menu_admin_produk.php");?></li>
					</ul>

				</div>
			</div>
		</div>
		
		<div class="col-md-10 col-md-offset-2 main">
			<div class="row placeholders">
				<div class="col-md-12">
					<?php
						if($_GET['page'] == "form_input_produk"){
							include("form_input_produk.php");
							
						} else if($_GET['page'] == "permintaan_material_produksi"){
							include("permintaan_material_produksi.php");
							
						} else if($_GET['page'] == "permintaan_penjualan"){
							include("permintaan_penjualan.php");
							
						} else if($_GET['page'] == "laporan_material_produksi"){
							include("laporan_material_produksi.php");
							
						} else if($_GET['page'] == "laporan_produk_keluar"){
							include("laporan_produk_keluar.php");
							
						} else if($_GET['page'] == "laporan_stok_produk"){
							include("laporan_stok_produk.php");
						} else {
							echo "<h1 align='center'>=== ADMIN PRODUK ===</h1>";
						}
					?>
				</div>

			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/docs.min.js"></script>
	</body>
</html>
<?php
}else{
	echo '<script languange="javascript">alert ("Silahkan login terlebih dahulu")</script>';
	echo '<script languange="javascript">window.location="../index.php"</script>';
}
?>