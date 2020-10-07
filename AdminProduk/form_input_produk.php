<h1 style="text-align:center;">Input Produk</h1><hr/>
<?php
	include_once '../include/file_oop.php';
	$con = new connect();
	$max = $con->get_max(barang_jadi);

	if(isset($_POST['edit'])){
		$id_barang = $_POST['id_barang'];
		$nama_barang = $_POST['nama_barang'];
		$harga = $_POST['harga'];

?>
<form action="" method="POST">
	<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>ID Material</td>
			<td>:</td>
			<td><input type="text" disabled name="" value="<?php echo $id_barang; ?>" />
				<input type="text" name="id_barang" hidden value="<?php echo $id_barang; ?>" /></td>
		</tr>
		<tr>
			<td>Nama Material</td>
			<td>:</td>
			<td><input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>" /></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type="text" name="harga" value="<?php echo $harga; ?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<br><input type="submit" name="update" value="Update" />
				<input type="submit" name="" value="Cancel" />
			</td>
		</tr>
	</table>
</form>
<br>
<br>
<hr>
<?php
}else{
?>
<form action="" method="POST">
	<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>ID Barang</td>
			<td>:</td>
			<td><input type="text" name="" disabled value="B<?php echo $max ;?>"/>
				<input type="text" name="id_barang" hidden value="B<?php echo $max ;?>"/></td>
		</tr>
		<tr>
			<td>Nama Barang</td>
			<td>:</td>
			<td><input type="text" name="nama_barang" value="" /></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type="text" name="harga" value="" placeholder="Contoh: 10000" /></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
		<br>
				<input type="submit" name="simpan" value="Simpan" />
				<input type="reset" value="Reset"/ style="margin-left:58px;">
			</td>
			<br>
		</tr>
	</table>
</form>
<hr>
<br>
<?php
}
?>
			<?php
				if(isset($_POST['simpan']))
				{
					if ($_POST['id_barang'] != "" or $_POST['nama_barang'] != "" or $_POST['harga'] != "") {
						$id_barang = $_POST['id_barang'];
						$nama_barang = $_POST['nama_barang'];
						$harga = $_POST['harga'];
						
						$con->insert_produk($id_barang, $nama_barang, $harga, $max);
						echo '<script languange="javascript">alert ("Data Berhasil Ditambahkan")</script>';
					} if (!is_numeric($_POST['harga'])) {
						echo '<script languange="javascript">alert ("Harap Isi Dengan Benar")</script>';
					} else {
						echo '<script languange="javascript">alert ("Harap Isi Dengan Benar")</script>';
					}
				}
				
				if(isset($_POST['hapus']))
				{
					$id_barang = $_POST['id_barang'];
					
					$hasil = $con->hapus_produk($id_barang);
					
					if($hasil){
					echo '<script languange="javascript">alert ("Data Terhapus")</script>';
					echo '<script languange="javascript">window.location="index.php?page=form_input_produk"</script>';
					}
				}
				
				if(isset($_POST['update'])){
					$id_barang = $_POST['id_barang'];
					$nama_barang = $_POST['nama_barang'];
					$harga = $_POST['harga'];
					
					$hasil = $con->update_produk($id_barang, $nama_barang, $harga);
					if($hasil == 0){
						echo '<script languange="javascript">alert ("Data berhasil diubah")</script>';
						echo '<script languange="javascript">window.location="index.php?page=form_input_produk"</script>';
					} else {
						echo '<script languange="javascript">alert ("Data gagal diubah")</script>';
					}
				}
				?>
				

				<?php
					include '../include/connect.php';
				?>
					<p>
					<table width="100%" align="center" border="1">
					<tr style="background-color:lightblue">
					<th style="text-align:center">No.</th>
					<th style="text-align:center" width="150px">Id Barang</th>
					<th style="text-align:center">Nama Barang</th>
					<th style="text-align:center">Stok</th>
					<th style="text-align:center">Harga</th>
					<th style="text-align:center" width="200px">Action</th>
					</tr>
					<?php
					$con = new connect();
					$result = $con -> get_select_table(barang_jadi);
					$no=1;
					if (!$result) {
						echo '<script languange="javascript">alert ("'.$result.'")</script>';
					} else {
					while($data=mysql_fetch_array($result)){?>
						<form action="" method="POST">
						<tr style="text-align:center">
						<td><?php echo $no; $no++;?></td>
						<td><input style="text-align:center" type="text" readonly="1" name="id_barang" value="<?php echo $data['id_barang']?>" /></td>
						<td><input style="text-align:center" type="text" readonly="1"  name="nama_barang" value="<?php echo $data['nama_barang']?>" /></td>
						<td><input style="text-align:center" type="text" readonly="1"  name="" value="<?php echo $data['stok']?>" /></td>
						<td>
							<input style="text-align:center" type="text" readonly="1"  name="" value="<?php echo number_format($data['harga'])?>" />
							<input style="text-align:center" type="text" readonly="1"  hidden name="harga" value="<?php echo $data['harga']?>" />
						</td>
						<td>
						<input type="submit" name="edit" value="Edit" />
						<input type="submit" name="hapus" value="Hapus" />
						</td>
						</tr>	
						</form>
					<?php
						}
					}
					?>