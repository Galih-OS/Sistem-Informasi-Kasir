<h1 style="text-align:center;">Laporan Stok Inventori Produk</h1><hr/>
<?php
	include '../include/connect.php';
	
	$querySELECT = "SELECT * FROM barang_jadi";
	$exetabel = mysql_query($querySELECT);
	$no = 1;
	echo "<table border='1' align='center'>";
	echo "	<tr align='center'>
				<td>No.</td>
				<td>ID Produk</td>
				<td>Nama Produk</td>
				<td>Stok</td>
				<td>Harga</td>
			</tr>
			";
	while($row = mysql_fetch_assoc($exetabel)){
		
	echo "	<tr align='center'>
				<form action='' method='POST'>
				<td><input size='3' read-only value='".$no."'></td>
				<td><input size='3' read-only name='uts' value='".$row['id_barang']."'></td>
				<td><input size='10' read-only name='uas' value='".$row['nama_barang']."'></td>
				<td><input size='3' read-only name='' value='".$row['stok']."'></td>
				<td><input size='5' read-only name='tugas' value='".number_format($row['harga'])."'></td>";
	echo "
				</form>
			</tr>";
	$no++;
	}
	echo "</table>";
?>