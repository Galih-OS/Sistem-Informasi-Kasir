<h1 style="text-align:center;">Permintaan Material Produksi</h1>
<hr/>
	<?php
		include_once("../include/file_oop.php");
		
		$con = new connect();
		$id_permintaan = $con->get_kode_id_permintaan_produksi();
		$max = $con->get_max(permintaan_produksi);
	?>
<p align="left">No. Penjualan : <?php echo $id_permintaan;?></p>

<hr/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td width="35%">
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		<h4>List Material</h4><hr/>
		  <tr>
			<td><strong>Nama Material</strong></td>
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
			  <a href="cart.php?act=add&amp;barang_id=<?php echo $rs['id_bahan']; ?>&amp;ref=index.php?page=permintaan_material_produksi">Add to List</a>
			</td>
		  </tr>
		  <?php
			}
		  ?>
		</table>
	</td>
    <td>&nbsp;</td>
    <td width="60%"><h4>List Order</h4><hr/>
      <?php require("cart_view.php"); ?></td>
  </tr>
</table>
<p>&nbsp;</p>