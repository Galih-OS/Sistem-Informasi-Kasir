<table width="100%" border="0" cellspacing="0" cellpadding="0" class="viewer">
  <tr>
    <th style="text-align:center;" scope="col">Kode Material</th>
    <th style="text-align:center;" scope="col">Nama Material</th>
    <th style="text-align:center;" scope="col">Kuantitas</th>
    <th style="text-align:center;" scope="col">Aksi</th>
  </tr>
  <?php
		
  if (isset($_SESSION['itemproduk'])) {
        foreach ($_SESSION['itemproduk'] as $key => $val){
            $query = mysql_query ("select id_bahan, nama_bahan, harga from bahan_mentah where id_bahan = '$key'");
            $rs = mysql_fetch_array ($query);
            
  ?>
  <tr>
    <td><?php echo $rs['id_bahan']; ?></td>
    <td><?php echo $rs['nama_bahan']; ?></td>
    <td align="center"><?php echo number_format($val); ?></td>
    <td align="center">
		<a href="cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=permintaan_material_produksi">+</a> |
		<a href="cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=permintaan_material_produksi">-</a> |
		<a href="cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=index.php?page=permintaan_material_produksi">Hapus</a>
	</td>
  </tr>
  <?php
            mysql_free_result($query);
        }
  }
  ?>
  <tr>
	<td colspan="4" style="">&nbsp</td>
  </tr>
  <tr>
	<td align="right" colspan="2"><strong>TOTAL :
		<?php
			$total = 0;
			foreach ($_SESSION['itemproduk'] as $key2 => $val){
				$query = mysql_query ("select * from bahan_mentah where id_bahan = '$key2'");
				$rs = mysql_fetch_array ($query);
				$total += $val;
			}
		?>
	</strong></td>
	<td align="center"><?php echo $total; ?></td>
	<td></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="center" colspan="2"><br/>
		<form action="" method="POST">
			<input class="btn btn-primary btn-sm" name="simpan" type="submit" value="Simpan">
			<a class="btn btn-danger btn-sm" href="cart.php?act=clear&amp;ref=index.php?page=permintaan_material_produksi">Batal</a>
		</form>
	</td>
  </tr>
</table>

<?php
	if(isset($_POST['simpan'])){
		include '../include/connect.php';
		$no = 1;
		date_default_timezone_set('Indonesia/Jakarta');
		$today = date('Y-m-d H:i:s');
		
		// MENCATAT KEDALAM TABEL PERMINTAAN_PRODUKSI
		$query2 = mysql_query ("INSERT INTO permintaan_produksi
								VALUES ('".$id_permintaan."', '".$today."', 'P1' ,'".$_SESSION['produk']."', ".$total.", ".$max.", 'pending') ");
		
		if ($query2 == 1)
		{
			echo '<script languange="javascript">alert ("Permintaan Berhasil ter-Kirim")</script>';
		
			// MENCARI NOMOR TERAKHIR ID_DET_PERMINTAAN_PROD
			$query = mysql_query ("select COUNT(*)+1 AS jum from detail_permintaan_produksi");
			$jum = mysql_fetch_array($query);
			$jum = $jum['jum'];
		
			foreach ($_SESSION['itemproduk'] as $key => $val){
				$sub_total = 0;
				$stok = 0;
				$query = mysql_query ("select id_bahan, nama_bahan, harga, stok FROM bahan_mentah where id_bahan = '$key'");
				$rs = mysql_fetch_array ($query);
				
				// MENCATAT KEDALAM TABEL DETAIL_PERMINTAAN_PRODUKSI
				$query3 = mysql_query ("INSERT INTO detail_permintaan_produksi
										VALUES (".$jum.",'".$id_permintaan."','".$rs['id_bahan']."', ".$val.") ");
				
				$jum += 1;
			}
			
			// HAPUS LIST CART
			if (isset($_SESSION['itemproduk'])) {
				foreach ($_SESSION['itemproduk'] as $key => $val) {
					unset($_SESSION['itemproduk'][$key]);
				}
				unset($_SESSION['itemproduk']);
			}
		} else {
			echo '<script languange="javascript">alert ("Permintaan Gagal di Proses")</script>';
		}
		echo '<script languange="javascript">window.location="index.php?page=permintaan_material_produksi"</script>';
	}
?>