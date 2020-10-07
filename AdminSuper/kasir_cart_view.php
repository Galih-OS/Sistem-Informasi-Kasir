<table width="100%" border="0" cellspacing="0" cellpadding="0" class="viewer">
  <tr>
    <th style="text-align:center;" scope="col">Kode Barang</th>
    <th style="text-align:center;" scope="col">Nama Barang</th>
	<th style="text-align:center;" scope="col">Harga</th>
    <th style="text-align:center;" scope="col">Stok</th>
    <th style="text-align:center;" scope="col">Sub Total</th>
    <th style="text-align:center;" scope="col">Aksi</th>
  </tr>
  <?php
		
  if (isset($_SESSION['admin_itemproduk'])) {
        foreach ($_SESSION['admin_itemproduk'] as $key => $val){
            $query = mysql_query ("select id_barang, nama_barang, harga FROM barang_jadi where id_barang = '$key'");
            $rs = mysql_fetch_array ($query);
            
  ?>
  <tr>
    <td><?php echo $rs['id_barang']; ?></td>
    <td><?php echo $rs['nama_barang']; ?></td>
	<td align="center">Rp. <?php echo number_format($rs['harga']); ?></td>
    <td align="center"><?php echo number_format($val); ?></td>
	 <td align="right">Rp. <?php echo number_format($rs['harga']*$val); ?></td>
    <td align="right">
		<a href="kasir_cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=kasir_form_input_penjualan">+</a> |
		<a href="kasir_cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=kasir_form_input_penjualan">-</a> |
		<a href="kasir_cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=kasir_form_input_penjualan">Hapus</a>
	</td>
  </tr>
  <?php
            mysql_free_result($query);
        }
  }
  ?>
  <tr>
	<td colspan="6" style="">&nbsp</td>
  </tr>
  <tr>
	<td align="right" colspan="4"><strong>TOTAL :
		<?php
			$total = 0;
			foreach ($_SESSION['admin_itemproduk'] as $key2 => $val){
				$query = mysql_query ("select harga from barang_jadi where id_barang = '$key2'");
				$rs = mysql_fetch_array ($query);
				$total += $rs['harga'] * $val;
			}
		?>
	</strong></td>
	<td align="right">Rp. <?php echo number_format($total); ?></td>
	<td></td>
  </tr>
		<form action="" method="POST">
  <tr>
	<td align="right" colspan="4"><strong>Tunai : </strong></td>
	<td align="right">RP. <input type="number" style="width:80px;" name="tunai" min="0" value=""></td>
	<td></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td align="center" colspan="2"><br/>
			<input class="btn btn-primary btn-sm" name="simpan" type="submit" value="Simpan">
			<a class="btn btn-danger btn-sm" href="kasir_cart.php?act=clear&amp;ref=index.php?page=kasir_form_input_penjualan">Batal</a>
		</form>
	</td>
  </tr>
</table>

<?php
	if(isset($_POST['simpan'])){
		if ($_POST['tunai'] >= $total) {
		include '../include/connect.php';
		
		$kembali = $_POST['tunai'] - $total;
		
		// MENCATAT KEDALAM TABEL PENJUALAN
		date_default_timezone_set("Indonesia/Jakarta");
		$query1 = mysql_query ("INSERT INTO penjualan
								VALUES ('".$id_penjualan."', '".date('Y-m-d H:i:s')."' , '".$_SESSION['admin']."' , ".$total." , ".$_POST['tunai']." , ".$kembali." , ".$max.") ");
		
		// MENCATAT KEDALAM TABEL PENJUALAN
		date_default_timezone_set("Indonesia/Jakarta");
		$query2 = mysql_query ("INSERT INTO permintaan_penjualan
								VALUES ('".$id_permintaan_penjualan."', '".$id_penjualan."', '".date('Y-m-d H:i:s')."' , 'P1' , '".$_SESSION['admin']."' , ".$total." , ".$maxx.", 'pending') ");
		
		// MENCARI NOMOR TERAKHIR ID_DET_PENJUALAN
		$query = mysql_query ("select COUNT(*)+1 AS jum from detail_penjualan");
		$jum = mysql_fetch_array($query);
		$jum = $jum['jum'];
		
		// MENCARI NOMOR TERAKHIR ID_DET_PERMINTAAN_JUAL
		$query = mysql_query ("select COUNT(*)+1 AS jum2 from detail_permintaan_penjualan");
		$jum2 = mysql_fetch_array($query);
		$jum2 = $jum['jum2'];
		
		foreach ($_SESSION['admin_itemproduk'] as $key => $val){
			$sub_total = 0;
			$stok = 0;
			$query = mysql_query ("select id_barang, nama_barang, harga, stok FROM barang_jadi where id_barang = '$key'");
			$rs = mysql_fetch_array ($query);

			$sub_total = $rs['harga'] * $val;
			
			// MENCATAT KEDALAM TABEL DETAIL_PENJUALAN
			$query3 = mysql_query ("INSERT INTO detail_penjualan
									VALUES (".$jum.",'PEN".$max."','".$rs['id_barang']."', ".$val." , ".$sub_total.") ");
			
			// MENCATAT KEDALAM TABEL DETAIL_PERMINTAAN_PENJUALAN
			$query_det_per = mysql_query ("INSERT INTO detail_permintaan_penjualan
									VALUES (".$jum2.",'PPJ".$max."','".$rs['id_barang']."', ".$val.") ");
			echo '<script languange="javascript">alert("'.$query_det_per.' JUM > '.$jum2.'")</script>';
			$jum += 1;
			$jum2 += 1;
		}
		
		// HAPUS LIST CART
		if (isset($_SESSION['admin_itemproduk'])) {
			foreach ($_SESSION['admin_itemproduk'] as $key => $val) {
				unset($_SESSION['admin_itemproduk'][$key]);
			}
			unset($_SESSION['admin_itemproduk']);
		}
		echo '<script languange="javascript">window.location="index.php?page=kasir_form_input_penjualan"</script>';
		} else {
			echo '<script languange="javascript">alert("Pembayaran Kurang")</script>';
		}
	}
?>