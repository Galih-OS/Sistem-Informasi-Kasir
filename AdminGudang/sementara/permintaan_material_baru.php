<h1 style="text-align:center;">Input Material</h1><hr/>
<?php
	if(isset($_POST['edit'])){
		$id_pembelian = $_POST['id_pembelian'];
		$id_pegawai = $_POST['id_pegawai'];
		$id_supplier = $_POST['id_supplier'];
		$tanggal_pembelian = $_POST['tanggal_pembelian'];
		$total = $_POST['total'];

?>
<form action="" method="POST">
	<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>Id Pembelian</td>
			<td>:</td>
			<td><input type="text" name="id_pembelian" value="<?php echo $id_pembelian; ?>" /></td>
		</tr>
		<tr>
			<td>Id Pegawai</td>
			<td>:</td>
			<td><input type="text" name="id_pegawai" value="<?php echo $id_pegawai; ?>" /></td>
		</tr>		
		<tr>
			<td>Id Supplier</td>
			<td>:</td>
			<td><input type="text" name="id_supplier" value="<?php echo $id_supplier; ?>" /></td>
		</tr>
		<tr>
			<td>Tanggal Pembelian</td>
			<td>:</td>
			<td><input type="text" name="tanggal_pembelian" value="<?php echo $tanggal_pembelian; ?>" /></td>
		</tr>
		<tr>
			<td>total</td>
			<td>:</td>
			<td><input type="text" name="total" value="<?php echo $total; ?>" /></td>
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
			<td>Id Pembelian</td>
			<td>:</td>
			<td><input type="text" name="id_pembelian" value="" /></td>
		</tr>
		<tr>
			<td>Id Pegawai</td>
			<td>:</td>
			<td><input type="text" name="id_pegawai" value="" /></td>
		</tr>		
		<tr>
			<td>Id Supplier</td>
			<td>:</td>
			<td><input type="text" name="id_supplier" value="" /></td>
		</tr>
		<tr>
			<td>Tanggal Pembelian</td>
			<td>:</td>
			<td><input type="text" name="tanggal_pembelian" value="" /></td>
		</tr>
		<tr>
			<td>total</td>
			<td>:</td>
			<td><input type="text" name="total" value="" /></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
		<br>
				<input type="submit" name="simpan" value="Simpan" />
				<input type="reset" value="Reset" style="margin-left:58px;">
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
				include '../include/connect.php';
				if(isset($_POST['simpan']))
				{
				
					$id_pembelian = $_POST['id_pembelian'];
					$id_pegawai = $_POST['id_pegawai'];
					$id_supplier = $_POST['id_supplier'];
					$tanggal_pembelian = $_POST['tanggal_pembelian'];
					$total = $_POST['total'];
					
					$query=mysql_query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
					$cek=mysql_num_rows($query);
					$hasil = mysql_query("Insert into pembelian values('$id_pembelian','$id_pegawai','$id_supplier','$tanggal_pembelian','$total')");
					if($cek)
					{
						echo '<script languange="javascript">alert ("Selamat, Id Anda Terdaftar")</script>';
					}
					else
					{
						if($hasil)
						{
							?>
							<?php
								echo '<script languange="javascript">alert ("Berhasil Menambah Supplier")</script>';
							?>
							<?php
						}
					}
				}
				?>
				
			</table>

			<?php
					include '../include/connect.php';
					?>
					<p>
					<table width="100%x" align="center" border="1">
					<tr style="background-color:lightblue">
					<th style="text-align:center">No.</th>
					<th style="text-align:center" width="100px">Id Pembelian</th>
					<th style="text-align:center">Id Pegawai</th>
					<th style="text-align:center" width="100">Id Supplier</th>
					<th style="text-align:center" width="200px">Tanggal Pembelian</th>
					<th style="text-align:center" width="200px">Total (Rp.)</th>
					<th style="text-align:center" width="200px">Action</th>
					</tr>
					<?php
					$result = mysql_query("select * from pembelian");
					$no=1;
					while($data=mysql_fetch_array($result)){?>
					<form action="" method="POST">
					<tr style="text-align:center">
					<td><?php echo $no; $no++;?></td>
					<td><input style="text-align:center" type="text" readonly="1" name="id_pembelian" value="<?php echo $data['id_pembelian']?>" /></td>
					<td><input style="text-align:center" type="text" readonly="1"  name="id_pegawai" value="<?php echo $data['id_pegawai']?>" /></td>
					<td><input style="text-align:center" type="text" readonly="1"  name="id_supplier" value="<?php echo $data['id_supplier']?>" /></td>
					<td><input style="text-align:center" type="text" readonly="1"  name="tanggal_pembelian" value="<?php echo $data['tanggal_pembelian']?>" /></td>
					<td><input style="text-align:center" type="text" readonly="1"  name="total" value="<?php echo $data['total']?>" /></td>
					<td>
					<input type="submit" name="edit" value="Edit" />
					<input type="submit" name="hapus" value="Hapus" />
					</td>
					</tr>	
					</form>
					<?php
					}
					?>
					
					<?php
					if(isset($_POST['hapus'])){
					$id_pembelian = $_POST['id_pembelian'];
					include '../include/connect.php';
					$hasil = mysql_query("delete from pembelian where id_pembelian='$id_pembelian'");
					if($hasil){
					echo '<script languange="javascript">alert ("Data Terhapus")</script>';
					echo '<script languange="javascript">window.location="http://localhost/PPWeb_UAS/AdminGudang/index.php?page=form_input_material"</script>';
					}
					}
					?>
					
					<?php
					if(isset($_POST['update'])){
					include '../include/connect.php';
					
					$id_pembelian = $_POST['id_pembelian'];
					$id_pegawai = $_POST['id_pegawai'];
					$id_supplier = $_POST['id_supplier'];
					$tanggal_pembelian = $_POST['tanggal_pembelian'];
					$total = $_POST['total'];
					
					$hasil = mysql_query("update pembelian set id_pegawai='$id_pegawai', id_supplier='$id_supplier', tanggal_pembelian='$tanggal_pembelian', total='$total' where id_pembelian='$id_pembelian'");
					if($hasil){
					echo '<script languange="javascript">alert ("Data berhasil diubah")</script>';
					echo '<script languange="javascript">window.location="http://localhost/PPWeb_UAS/AdminGudang/index.php?page=form_input_material"</script>';
					}else{
					echo '<script languange="javascript">alert ("Data gagal diubah")</script>';
					}
					}
					?>