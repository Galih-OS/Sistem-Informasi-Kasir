<h1 style="text-align:center;">Laporan Stok Inventori Material</h1><hr/>
<?php
	include '../include/connect.php';
	
	$querySELECT = "SELECT *
					FROM bahan_mentah";
	$exetabel = mysql_query($querySELECT);
	$no = 1;
	echo "<table border='1' align='center' width='60%'>";
	echo "	<tr align='center'>
				<td>No.</td>
				<td>ID Material</td>
				<td>Nama Material</td>
				<td>Stok</td>
				<td>Harga</td>
			</tr>
			";
	while($row = mysql_fetch_assoc($exetabel)){
		
	echo "	<tr align='center'>
				<form action='' method='POST'>
				<td><input style='text-align:center;' size='3' read-only value='".$no."'></td>
				<td><input style='text-align:center;' size='3' read-only name='uts' value='".$row['id_bahan']."'></td>
				<td><input style='text-align:center;' size='10' read-only name='uas' value='".$row['nama_bahan']."'></td>
				<td><input style='text-align:center;' size='3' read-only name='' value='".$row['stok']."'></td>
				<td><input style='text-align:right;' size='5' read-only name='tugas' value='".number_format($row['harga'])."'></td>";
	echo "
				</form>
			</tr>";
	$no++;
	}
	echo "</table>";
?>