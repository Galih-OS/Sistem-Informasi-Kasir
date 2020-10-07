<h1 style="text-align:center;">Laporan Inventori Material Masuk</h1><hr/>
<?php
	include '../include/connect.php';
	include_once '../include/file_oop.php';	
	
	$con = new connect();
	$exetabel = $con->get_select_table(pembelian);
	$no = 1;
	echo "<table border='1' align='center' width='80%'>";
	echo "	<tr align='center'>
				<td>No.</td>
				<td>Kode Pembelian</td>
				<td>ID Penginput</td>
				<td>ID Supplier</td>
				<td>Tanggal</td>
				<td>Total</td>
				<td>Aksi</td>
			</tr>
			";
	while($row = mysql_fetch_assoc($exetabel)){
	echo "	<tr align='center'>
				<form action='' method='POST'>
				<td><input style='text-align:center' size='3' read-only value='".$no."'></td>
				<td><input style='text-align:center' size='3' read-only name='id_pembelian' value='".$row['id_pembelian']."'></td>
				<td><input style='text-align:center' size='3' read-only name='id_pegawai' value='".$row['id_pegawai']."'></td>
				<td><input style='text-align:center' size='3' read-only name='id_supplier' value='".$row['id_supplier']."'></td>
				<td><input size='15' read-only name='tanggal_pembelian' value='".$row['tanggal_pembelian']."'></td>
				<td><input style='text-align:right' size='5' read-only name='' value='".number_format($row['total'])."'></td>
				<td>
				<input class='btn btn-default btn-sm' type='submit' name='detail' value='View Detail'>
				</td>";
	echo "
				</form>
			</tr>";
	$no++;
	}
	echo "</table>";
if(isset($_POST['detail']))
{
?>
	<table border="1" align="center">
		<tr>
			<td colspan="3">No. Penjualan : <?php echo $_POST[id_pembelian] ;?> - Tanggal : <?php echo $_POST[tanggal_pembelian] ;?></td>
		</tr>
		<tr>
			<td>ID Material</td>
			<td>Kuantitas</td>
			<td>Sub Total</td>
		</tr>
	<?php
		include '../include/connect.php';
		$querySELECT = "SELECT * FROM detail_pembelian WHERE id_pembelian = '".$_POST[id_pembelian]."' ";
		$exetabel = mysql_query($querySELECT);
		while($list = mysql_fetch_assoc($exetabel)){
	?>
		<tr>
			<td><?php echo $list['id_bahan'] ;?></td>
			<td><?php echo $list['qty'] ;?></td>
			<td><?php echo $list['sub_total'] ;?></td>
		</tr>
<?php
	}
?>
	</table>
<?php
}
?>