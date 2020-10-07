<h2>Permintaan Material Baru</h2>
<hr/>
	<?php
		include_once("../include/file_oop.php");
		
		$con = new connect();
		$id_pembelian = $con->get_kode_id_pembelian();
		$max = $con->get_max(pembelian);
		
	?>
<p align="left">No. Penjualan : <?php echo $id_pembelian;?></p>
<p align="left">
	<table>
		<tr>
			<td>Nama Supplier : </td>
			<td> 
				<form action="" method="POST">
				<select name="id_supplier">
				<?php
					// Menampilkan Data Suplier
						include '../include/connect.php';
						$query = "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC";
						$exeee = mysql_query($query);
						
						while($row = mysql_fetch_assoc($exeee)){
							$id_supplier=$row["id_supplier"];
							echo "<option value='".$row['id_supplier']."'>".$row['nama_supplier']."</option>";
						}
				?> 		
				</select>
			</td>
		</tr>
	</table></p>
<hr/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td width="35%">
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		<h4>List Material</h4><hr/>
		  <tr>
			<td><strong>Nama Material</strong></td>
			<td><strong>Harga</strong></td>
			<td></td>
		  </tr>
		  <?php
			include '../include/connect.php';
			$query = mysql_query ("select * from bahan_mentah");
			while ($rs = mysql_fetch_array ($query)) {
		  ?>
		  <tr>
			<td><?php echo $rs['nama_bahan']; ?></td>
			<td>
			  Rp. <?php echo number_format($rs['harga']); ?>
			</td>
			<td>
			  <a href="gudang_cart.php?act=add&amp;barang_id=<?php echo $rs['id_bahan']; ?>&amp;ref=index.php?page=gudang_permintaan_material_baru">Add to List</a>
			</td>
		  </tr>
		  <?php
			}
		  ?>
		</table>
	</td>
    <td>&nbsp;</td>
    <td width="60%"><h4>List Order</h4><hr/>
      <?php require("gudang_cart_view.php"); ?></td>
  </tr>
</table>
<p>&nbsp;</p>