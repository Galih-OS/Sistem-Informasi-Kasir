<h1 style="text-align:center;">Laporan Produk Keluar</h1><hr/>
<?php
	include '../include/connect.php';
	
	$querySELECT = "SELECT *
					FROM permintaan_penjualan WHERE status='accept'";
	$exetabel = mysql_query($querySELECT);
	$no = 1;
	echo "<table border='1' align='center' width='70%'>";
	echo "	<tr align='center'>
				<td>No.</td>
				<td>No Transaksi</td>
				<td>Tanggal</td>
				<td>Di Setujui Oleh</td>
				<td>Permintaan Oleh</td>
				<td>Total Item</td>
				<td>Aksi</td>
			</tr>
			";
	while($row = mysql_fetch_assoc($exetabel)){
		
	echo "	<tr align='center'>
				<form action='' method='POST'>
				<td><input size='3' read-only value='".$no."'></td>
				<td><input size='3' read-only name='id_permintaan_jual' value='".$row['id_permintaan_jual']."'></td>
				<td><input size='15' read-only name='tgl_permintaan' value='".$row['tgl_permintaan']."'></td>
				<td><input size='3' read-only name='id_pegawai' value='".$row['id_pegawai']."'></td>
				<td><input size='10' read-only name='id_peminta' value='".$row['id_peminta']."'></td>
				<td><input size='10' read-only name='total_item' value='".$row['total_item']."'></td>
				<td><input type='submit' name='detail' value='View Detail'></td>";
	echo "
				</form>
			</tr>";
	$no++;
	}
	echo "</table>";
?>
<?php
if(isset($_POST['detail']))
{
?>
	<table border="1" align="center">
		<tr>
			<td colspan="3">No. Penjualan : <?php echo $_POST[id_permintaan_jual] ;?> - Tanggal : <?php echo $_POST[tgl_permintaan] ;?></td>
		</tr>
		<tr>
			<td>ID Material</td>
			<td>Kuantitas</td>
		</tr>
<?php
	include '../include/connect.php';
	$querySELECT = "SELECT * FROM detail_permintaan_penjualan WHERE id_permintaan_jual = '".$_POST[id_permintaan_jual]."' ";
	$exetabel = mysql_query($querySELECT);
	while($list = mysql_fetch_assoc($exetabel)){
?>
		<tr>
			<td><?php echo $list['id_barang'] ;?></td>
			<td><?php echo $list['kuantitas'] ;?></td>
		</tr>
<?php
	}
?>
	</table>
<?php
}
?>