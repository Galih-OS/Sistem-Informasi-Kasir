<h1 style="text-align:center;">Input Material</h1><hr/>
<?php
	include_once '../include/file_oop.php';
	
	$con = new connect();
	$max = $con->get_max(bahan_mentah);
	
	if(isset($_POST['edit'])){
		$id_material = $_POST['id_material'];
		$nama_material = $_POST['nama_material'];
		$harga_material = $_POST['harga_material'];

?>
<form action="" method="POST">
	<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>Id Material</td>
			<td>:</td>
			<td><input type="text" disabled name="" value="<?php echo $id_material; ?>" />
				<input type="text" name="id_material" hidden value="<?php echo $id_material; ?>" /></td>
		</tr>
		<tr>
			<td>Nama Material</td>
			<td>:</td>
			<td><input type="text" name="nama_material" value="<?php echo $nama_material; ?>" /></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type="text" name="harga_material" value="<?php echo $harga_material; ?>" /></td>
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
			<td>Id Material</td>
			<td>:</td>
			<td><input type="text" name="" disabled value="M<?php echo $max ;?>"/>
				<input type="text" name="id_material" hidden value="M<?php echo $max ;?>"/></td>
		</tr>
		<tr>
			<td>Nama Material</td>
			<td>:</td>
			<td><input type="text" name="nama_material" value="" /></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><input type="text" name="harga_material" value="" /></td>
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
					if ($_POST['id_material'] != "" or $_POST['nama_material'] != "" or $_POST['harga_material'] != "") {
						$id_material = $_POST['id_material'];
						$nama_material = $_POST['nama_material'];
						$harga_material = $_POST['harga_material'];
						
						$con->insert_bahan_mentah($id_material, $nama_material, $harga_material, $max);
						echo '<script languange="javascript">alert ("Data Berhasil Ditambahkan")</script>';
					} if (!is_numeric($_POST['harga'])) {
							echo '<script languange="javascript">alert ("Harap Isi Dengan Benar")</script>';
					} else {
						echo '<script languange="javascript">alert ("Harap Isi Dengan Benar")</script>';
					}
				}
				
				if(isset($_POST['hapus']))
				{
					$id_material = $_POST['id_material'];
					
					$con->hapus_bahan_mentah($id_material);
					
					if($hasil){
					echo '<script languange="javascript">alert ("Data Terhapus")</script>';
					echo '<script languange="javascript">window.location="index.php?page=form_input_produk"</script>';
					}
				}
				
				if(isset($_POST['update'])){
					$id_material = $_POST['id_material'];
					$nama_material = $_POST['nama_material'];
					$harga_material = $_POST['harga_material'];
					
					$hasil = $con->update_bahan_mentah($id_material, $nama_material, $harga_material);
					if($hasil == 0){
						echo '<script languange="javascript">alert ("Data berhasil diubah")</script>';
						echo '<script languange="javascript">window.location="index.php?page=form_input_produk"</script>';
					} else {
						echo '<script languange="javascript">alert ("Data gagal diubah")</script>';
					}
				}
				?>
				
			</table>

					<p>
					<table width="100%" align="center" border="1">
					<tr style="background-color:lightblue">
					<th style="text-align:center">No.</th>
					<th style="text-align:center" width="150px">Id Material</th>
					<th style="text-align:center">Nama Material</th>
					<th style="text-align:center">Stok</th>
					<th style="text-align:center">Harga</th>
					<th style="text-align:center" width="200px">Action</th>
					</tr>
					<?php
					$con = new connect();
					$result = $con->get_select_table(bahan_mentah);
					$no=1;
					while($data=mysql_fetch_array($result)){?>
					<form action="" method="POST">
						<tr style="text-align:center">
						<td><?php echo $no; $no++;?></td>
						<td><input style="text-align:center" type="text" readonly="1" name="id_material" value="<?php echo $data['id_bahan']?>" /></td>
						<td><input style="text-align:center" type="text" readonly="1"  name="nama_material" value="<?php echo $data['nama_bahan']?>" /></td>
						<td><input style="text-align:center" type="text" readonly="1"  name="" value="<?php echo $data['stok']?>" /></td>
						<td><input style="text-align:center" type="text" readonly="1"  name="harga_material" value="<?php echo $data['harga']?>" /></td>
						<td>
						<input type="submit" name="edit" value="Edit" />
						<input type="submit" name="hapus" value="Hapus" />
						</td>
						</tr>	
					</form>
					<?php
					}
					?>