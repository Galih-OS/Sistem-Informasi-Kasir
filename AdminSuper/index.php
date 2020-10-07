<?php
	session_start(); 
	if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap 101 Template</title>

		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/signin.css" rel="stylesheet">
		<link href="../css/dashboard.css" rel="stylesheet">
		
	</head>
	<body>
		<?php include 'header.php'; ?>
	
		<div class="container-fluid">
		  <div class="row">
				<div class="col-sm-2 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><?php include ("menu_admin_super.php");?></li>
					</ul>

				</div>
			</div>
		</div>
		
		<div class="col-md-10 col-md-offset-2 main">
			<div class="row placeholders">
					<?php
						if($_GET['page'] == "form_input_user"){
							include("form_input_user.php");
							
						
						} else if ($_GET['page'] == "gudang_form_input_supplier") {
							include("gudang_form_input_supplier.php");
						} else if ($_GET['page'] == "gudang_form_input_material") {
							include("gudang_form_input_material.php");
						} else if ($_GET['page'] == "gudang_permintaan_material_baru") {
							include("gudang_permintaan_material_baru.php");
						} else if ($_GET['page'] == "gudang_permintaan_material_produksi") {
							include("gudang_permintaan_material_produksi.php");
						} else if ($_GET['page'] == "gudang_laporan_material_masuk") {
							include("gudang_laporan_material_masuk.php");
						} else if ($_GET['page'] == "gudang_laporan_material_keluar") {
							include("gudang_laporan_material_keluar.php");
						} else if ($_GET['page'] == "gudang_laporan_stok_inventori") {
							include("gudang_laporan_stok_inventori.php");
							
							
						} else if ($_GET['page'] == "produk_form_input_produk") {
							include("produk_form_input_produk.php");
						} else if ($_GET['page'] == "produk_permintaan_material_produksi2") {
							include("produk_permintaan_material_produksi.php");
						} else if ($_GET['page'] == "produk_permintaan_penjualan") {
							include("produk_permintaan_penjualan.php");
						} else if ($_GET['page'] == "produk_laporan_material_produksi") {
							include("produk_laporan_material_produksi.php");
						} else if ($_GET['page'] == "produk_laporan_produk_keluar") {
							include("produk_laporan_produk_keluar.php");
						} else if ($_GET['page'] == "produk_laporan_stok_produk") {
							include("produk_laporan_stok_produk.php");
						
						
						} else if ($_GET['page'] == "kasir_form_input_penjualan") {
							include("kasir_form_input_penjualan.php");
						} else if ($_GET['page'] == "kasir_laporan_penjualan_produk") {
							include("kasir_laporan_penjualan_produk.php");
						
						
						} else {
							echo "<h1 align='center'>=== SUPER ADMIN ===</h1>";
						}
					?>
			</div>
		</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="../js/penting.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>
<?php
}else{
	echo '<script languange="javascript">alert ("Silahkan login terlebih dahulu")</script>';
	echo '<script languange="javascript">window.location="../index.php"</script>';
}
?>