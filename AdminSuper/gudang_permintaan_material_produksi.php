<h1 style="text-align:center;">Permintaan Material Produksi</h1><hr/>

<form action="" method="POST">
	<?php include '../include/connect.php';       
		$query = "SELECT * FROM permintaan_produksi";
		$exeee = mysql_query($query);
		$no = 1;
	?>
	
	<table border='1' align='center' width="60%">";
		<tr align='center'>
			<td>No.</td>
			<td>Kode Permintaan Produksi</td>
			<td>Tanggal</td>
			<td>ID Peminta</td>
			<td>Total Item</td>
			<td>Status</td>
			<td>Action</td>
		</tr>
	<?php while($row = mysql_fetch_assoc($exeee)){ ?>
		<tr align='center'>
			<form action='' method='POST'>
				<td><input size='3' read-only style="text-align:center" value='<?php echo $no; ?>'></td>
				<td><input size='5' read-only style="text-align:center" name='id_permintaan_prod' value='<?php echo $row['id_permintaan_prod']; ?>'></td>
				<td><input size='15'read-only style="text-align:center" name='tgl_permintaan' value='<?php echo $row['tgl_permintaan']; ?>'></td>
				<td><input size='5' read-only style="text-align:center" name='id_peminta' value='<?php echo $row['id_peminta']; ?>'></td>
				<td><input size='5' read-only style="text-align:center" name='total_item' value='<?php echo $row['total_item']; ?>'></td>
				<td><input size='5' read-only style="text-align:center" name='status' value='<?php echo $row['status']; ?>'></td>
				<td>
						<?php
							if ($row['status'] != 'pending'){
						?>
								<input type='submit' name='detail' value='Detail'>
						<?php
							} else {
						?>
								<input type='submit' name='detail' value='Detail'>
								<input type='submit' name='acc' value='Setujui'>
						<?php	
							}
						?>
				</td>
			</form>
		</tr>
	<?php $no++;
	  } ?>
	</table>

<?php
if(isset($_POST['detail']))
{
?>
	<table border="1" align="center">
		<tr>
			<td colspan="3">No. Penjualan : <?php echo $_POST[id_permintaan_prod] ;?> - Tanggal : <?php echo $_POST[tgl_permintaan];?></td>
		</tr>
		<tr>
			<td>ID Material</td>
			<td>Kuantitas</td>
		</tr>
<?php
	include '../include/connect.php';
	$querySELECT = "SELECT * FROM detail_permintaan_produksi WHERE id_permintaan_prod = '".$_POST[id_permintaan_prod]."' ";
	$exetabel = mysql_query($querySELECT);
	while($list = mysql_fetch_assoc($exetabel)){
?>
		<tr>
			<td><?php echo $list['id_bahan'] ;?></td>
			<td><?php echo $list['kuantitas'] ;?></td>
		</tr>
<?php
	}
?>
	</table>
<?php
}
?>

<?php
	if(isset($_POST['acc']))
	{
		$fail = 0;
		$querySELECT = "SELECT * FROM detail_permintaan_produksi WHERE id_permintaan_prod = '".$_POST[id_permintaan_prod]."' ";
		$exetabel = mysql_query($querySELECT);
		while($list = mysql_fetch_assoc($exetabel)){
			$kuantitas = $list['kuantitas'];
			
			$query = "SELECT * FROM bahan_mentah WHERE id_bahan = '".$list[id_bahan]."' ";
			$exe = mysql_query($query);
			while($list2 = mysql_fetch_assoc($exe)){
				if ($list2['stok'] < $kuantitas) {
					echo '<script languange="javascript">alert ("Persediaan tidak mencukupi, silahkan order material baru.")</script>';
				} else {
					$stok = $list2['stok'] - $kuantitas;
					// MENGUBAH VALUE STOK PADA bahan_mentah
					$query2 = mysql_query ("UPDATE bahan_mentah
											SET stok = '".$stok."'
											WHERE id_bahan = '".$list['id_bahan']."' ");
					$fail += 1;
				}
			}
		}
		if ($fail > 0){
			// UPDATE DATA PERMINTAAN_PRODUKSI
			$query3 = mysql_query ("UPDATE permintaan_produksi
									SET status = 'accept', id_pegawai='".$_SESSION['username']."'
									WHERE id_permintaan_prod = '".$_POST[id_permintaan_prod]."' ");	
			echo '<script languange="javascript">alert ("'.$_POST[id_permintaan_prod].' - '.$query3.'")</script>';
		}
	}
?>