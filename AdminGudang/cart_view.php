<table width="100%" border="0" cellspacing="0" cellpadding="0" class="viewer">
  <tr>
    <th style="text-align:center;" scope="col">Kode Material</th>
    <th style="text-align:center;" scope="col">Nama Material</th>
    <th style="text-align:center;" scope="col">Harga</th>
    <th style="text-align:center;" scope="col">Stok</th>
    <th style="text-align:center;" scope="col">Sub Total</th>
    <th style="text-align:center;" scope="col">Aksi</th>
  </tr>
  <?php
		
  if (isset($_SESSION['items'])) {
        foreach ($_SESSION['items'] as $key => $val){
            $query = mysql_query ("select id_bahan, nama_bahan, harga from bahan_mentah where id_bahan = '$key'");
            $rs = mysql_fetch_array ($query);
            
  ?>
  <tr>
    <td><?php echo $rs['id_bahan']; ?></td>
    <td><?php echo $rs['nama_bahan']; ?></td>
    <td align="center">Rp. <?php echo number_format($rs['harga']); ?></td>
    <td align="center"><?php echo number_format($val); ?></td>
    <td align="right">Rp. <?php echo number_format($rs['harga']*$val); ?></td>
    <td align="center">
		<a href="cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=permintaan_material_baru">+</a> |
		<a href="cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=permintaan_material_baru">-</a> |
		<a href="cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=permintaan_material_baru">Hapus</a>
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
			foreach ($_SESSION['items'] as $key2 => $val){
				$query = mysql_query ("select harga from bahan_mentah where id_bahan = '$key2'");
				$rs = mysql_fetch_array ($query);
				$total += $rs['harga'] * $val;
			}
		?>
	</strong></td>
	<td align="right">Rp. <?php echo number_format($total); ?></td>
	<td></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td align="center" colspan="2"><br/>
		<form action="" method="POST">
			<input class="btn btn-primary btn-sm" name="simpan" type="submit" value="Simpan">
			<a class="btn btn-danger btn-sm" href="cart.php?act=clear&amp;ref=index.php?page=permintaan_material_baru">Batal</a>
		</form>
	</td>
  </tr>
</table>

<?php
	if(isset($_POST['simpan'])){
		include '../include/connect.php';
		$no = 1;
		$sub_total = 0;
		
		// MENCARI TOTAL PEMBELIAN
		foreach ($_SESSION['items'] as $key => $val){
			$query = mysql_query ("select harga from bahan_mentah where id_bahan = '$key'");
			$rs = mysql_fetch_array ($query);

			$sub_total = $rs['harga'] * $val;
			$total += $sub_total;
		}
		$total = $total/2;
		// MENCATAT KEDALAM TABEL PEMBELIAN
		date_default_timezone_set("Indonesia/Jakarta");
		$query2 = mysql_query ("INSERT INTO pembelian
								VALUES ('".$id_pembelian."', '".$_SESSION['username']."','".$_POST['id_supplier']."' , '".date('Y-m-d H:i:s')."', ".$total.", ".$max.") ");
		
		if ($query2 == 1)
		{
			echo '<script languange="javascript">alert ("Transaksi Berhasil")</script>';
		
			// MENCARI NOMOR TERAKHIR ID_DET_PEMBELIAN
			$query = mysql_query ("select COUNT(*)+1 AS jum from detail_pembelian");
			$jum = mysql_fetch_array($query);
			$jum = $jum['jum'];
			
			foreach ($_SESSION['items'] as $key => $val){
				$sub_total = 0;
				$stok = 0;
				$query = mysql_query ("select id_bahan, nama_bahan, harga, stok from bahan_mentah where id_bahan = '$key'");
				$rs = mysql_fetch_array ($query);

				$sub_total = $rs['harga'] * $val;
				
				// MENCATAT KEDALAM TABEL DETAIL_PEMBELIAN
				$query2 = mysql_query ("INSERT INTO detail_pembelian
										VALUES (".$jum.",'PEM".$max."','".$rs['id_bahan']."', ".$val.", ".$sub_total.") ");
				
				// MENGUBAH VALUE STOK PADA bahan_mentah
				$stok = $rs['stok'] + $val;
				$query3 = mysql_query ("UPDATE bahan_mentah
										SET stok = '".$stok."'
										WHERE id_bahan = '".$rs['id_bahan']."' ");		
				$jum += 1;
			}
			
			// HAPUS LIST CART
			if (isset($_SESSION['items'])) {
				foreach ($_SESSION['items'] as $key => $val) {
					unset($_SESSION['items'][$key]);
				}
				unset($_SESSION['items']);
			}
		} else {
			echo '<script languange="javascript">alert ("Transaksi Gagal")</script>';
		}
		echo '<script languange="javascript">window.location="index.php?page=permintaan_material_baru"</script>';
	}
?>