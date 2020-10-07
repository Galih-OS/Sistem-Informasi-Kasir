<h1 style="text-align:center;">Input Supplier</h1><hr/>
<?php
	include_once '../include/file_oop.php';
	
	$con = new connect();
	$max = $con->get_max(supplier);
	
	if(isset($_POST['edit'])){
		$id_supplier = $_POST['id_supplier'];
		$nama_supplier = $_POST['nama_supplier'];
		$alamat_supplier = $_POST['alamat_supplier'];

?>
<form action="" method="POST">
	<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>Id Supplier</td>
			<td>:</td>
			<td><input type="text" disabled name="" value="<?php echo $id_supplier; ?>" />
				<input type="text" hidden name="id_supplier" value="<?php echo $id_supplier; ?>" /></td>
		</tr>
		<tr>
			<td>Nama Supplier</td>
			<td>:</td>
			<td><input type="text" name="nama_supplier" value="<?php echo $nama_supplier; ?>" /></td>
		</tr>
		<tr>
			<td>Alamat Supplier</td>
			<td>:</td>
			<td><input type="text" name="alamat_supplier" value="<?php echo $alamat_supplier; ?>" /></td>
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
			<td>Id Supplier</td>
			<td>:</td>
			<td><input type="text" name="" disabled value="SUP<?php echo $max ;?>"/>
				<input type="text" name="id_supplier" hidden value="SUP<?php echo $max ;?>"/></td>
		</tr>
		<tr>
			<td>Nama Supplier</td>
			<td>:</td>
			<td><input type="text" name="nama_supplier" value="" /></td>
		</tr>
		<tr>
			<td>Alamat Supplier</td>
			<td>:</td>
			<td><input type="text" name="alamat_supplier" value="" /></td>
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
					if ($_POST['id_supplier'] != "" or $_POST['nama_supplier'] != "" or $_POST['alamat_supplier'] != "") {
					
						$id_supplier = $_POST['id_supplier'];
						$nama_supplier = $_POST['nama_supplier'];
						$alamat_supplier = $_POST['alamat_supplier'];
						
						$con->insert_supplier($id_supplier, $nama_supplier, $alamat_supplier, $max);
						echo '<script languange="javascript">alert ("Data Berhasil Ditambahkan")</script>';
					} else {
						echo '<script languange="javascript">alert ("Harap Isi Dengan Benar")</script>';
					}
				}
				
				if(isset($_POST['hapus']))
				{
					$id_supplier = $_POST['id_supplier'];
					
					$hasil = $con->hapus_supplier($id_supplier);
					
					if($hasil) {
						echo '<script languange="javascript">alert ("Data Terhapus")</script>';
						echo '<script languange="javascript">window.location="index.php?page=form_input_produk"</script>';
					}
				}
				
				if(isset($_POST['update'])){
					$id_supplier = $_POST['id_supplier'];
					$nama_supplier = $_POST['nama_supplier'];
					$alamat_supplier = $_POST['alamat_supplier'];
					
					$hasil = $con->update_supplier($id_supplier, $nama_supplier, $alamat_supplier);
					if($hasil == 0){
						echo '<script languange="javascript">alert ("Data berhasil diubah")</script>';
						echo '<script languange="javascript">window.location="index.php?page=form_input_produk"</script>';
					} else {
						echo '<script languange="javascript">alert ("Data gagal diubah")</script>';
					}
				}
				?>
				
			</table>
			
					<table width="100%" align="center" border="1">
					<tr style="background-color:lightblue">
					<th style="text-align:center">No.</th>
					<th style="text-align:center" width="150px">Id Supplier</th>
					<th style="text-align:center">Nama Supplier</th>
					<th style="text-align:center" width="200px">Alamat Supplier</th>
					<th style="text-align:center" width="200px">Action</th>
					</tr>
					<?php
					$con = new connect();
					$result = $con->get_select_table(supplier);
					$no=1;
					while($data=mysql_fetch_array($result)){?>
					<form action="" method="POST">
					<tr style="text-align:center">
					<td><?php echo $no; $no++;?></td>
					<td><input style="text-align:center" type="text" readonly="1" name="id_supplier" value="<?php echo $data['id_supplier']?>" /></td>
					<td><input style="text-align:center" type="text" readonly="1"  name="nama_supplier" value="<?php echo $data['nama_supplier']?>" /></td>
					<td><input style="text-align:center" type="text" readonly="1"  name="alamat_supplier" value="<?php echo $data['alamat_supplier']?>" /></td>
					<td>
					<input type="submit" name="edit" value="Edit" />
					<input type="submit" name="hapus" value="Hapus" />
					</td>
					</tr>	
					</form>
					<?php
					}
					?>