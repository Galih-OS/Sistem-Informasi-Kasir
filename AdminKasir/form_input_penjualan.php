<h1 style="text-align:center;">Input Penjualan</h1>
<hr/>
	<?php
		include_once("../include/file_oop.php");
		
		$con = new connect();
		$id_penjualan = $con->get_kode_id_penjualan();
		$max = $con->get_max(penjualan);
		
		$id_permintaan_penjualan = $con->get_kode_id_permintaan_penjualan();
		$maxx = $con->get_max(permintaan_penjualan);
		
	?>
<p align="left">No. Penjualan : <?php echo $id_penjualan;?></p>

<hr/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td width="35%">
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		<h4>List Barang</h4><hr/>
		  <tr>
			<td><strong>Nama Barang</strong></td>
			<td><strong>Harga</strong></td>
			<td></td>
		  </tr>
		  <?php
			include '../include/connect.php';
			$query = mysql_query ("select * from barang_jadi");
			while ($rs = mysql_fetch_array ($query)) {
		  ?>
		  <tr>
			<td><?php echo $rs['nama_barang']; ?></td>
			<td>
			  Rp. <?php echo number_format($rs['harga']); ?>
			</td>
			<td>
			  <a href="cart.php?act=add&amp;barang_id=<?php echo $rs['id_barang']; ?>&amp;ref=index.php?page=form_input_penjualan">Add to List</a>
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