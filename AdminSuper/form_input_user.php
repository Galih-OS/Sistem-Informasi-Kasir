<h1 style="text-align:center;">Edit User</h1><hr/>
<?php

	include_once '../include/file_oop.php';
	$con = new connect();
	$max = $con->get_max(pegawai);
	
	if(isset($_POST['edit'])){
		$id_pegawai = $_POST['id_pegawai'];
		$nama_pegawai = $_POST['nama_pegawai'];
		$notelp_pegawai = $_POST['notelp_pegawai'];
		$alamat_pegawai = $_POST['alamat_pegawai'];
		$username = $_POST['username'];
		$bagian = $_POST['bagian'];

?>
<form action="" method="POST">
	<table style="margin-left:auto; margin-right:auto;">
		<tr>
			<td>ID Pegawai</td>
			<td>:</td>
			<td><input type="text" disabled name="" value="<?php echo $id_pegawai; ?>" />
				<input type="text" name="id_pegawai" hidden value="<?php echo $id_pegawai; ?>" /></td>
		</tr>
		<tr>
			<td>Nama Pegawai</td>
			<td>:</td>
			<td><input type="text" name="nama_pegawai" value="<?php echo $nama_pegawai; ?>" /></td>
		</tr>
		<tr>
			<td>No. Telp</td>
			<td>:</td>
			<td><input type="text" name="notelp_pegawai" value="<?php echo $notelp_pegawai; ?>" /></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><input type="text" name="alamat_pegawai" value="<?php echo $alamat_pegawai; ?>" /></td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" value="<?php echo $username; ?>" /></td>
		</tr>
		<tr>
			<td>Bagian</td>
			<td>:</td>
			<td><select name="bagian">
					<option value="<?php echo $bagian; ?>" selected><?php echo $bagian; ?></option>
					<option value="admin">Admin</option>
					<option value="kasir">Kasir</option>
					<option value="gudang">Admin Gudang</option>
					<option value="produk">Admin Produk</option>
					</select>
			</td>
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
			<td>ID Pegawai</td>
			<td>:</td>
			<td><input type="text" name="" disabled value="P<?php echo $max ;?>"/>
				<input type="text" name="id_pegawai" hidden value="P<?php echo $max ;?>"/></td>
		</tr>
		<tr>
			<td>Nama Pegawai</td>
			<td>:</td>
			<td><input type="text" name="nama_pegawai" value="" /></td>
		</tr>
		<tr>
			<td>No. Telp</td>
			<td>:</td>
			<td><input type="text" name="notelp_pegawai" value="" /></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><input type="text" name="alamat_pegawai" value="" /></td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" value="" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="text" name="password" value="" /></td>
		</tr>
		<tr>
			<td>Bagian</td>
			<td>:</td>
			<td><select name="bagian">
					<option value="<?php echo $bagian; ?>" selected>-- Pilih bagian --</option>
					<option value="admin">Admin</option>
					<option value="kasir">Kasir</option>
					<option value="gudang">Admin Gudang</option>
					<option value="produk">Admin Produk</option>
					</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
			<br>
				<input type="submit" name="simpan" value="Simpan" />
				<input type="reset" value="Reset"/ style="margin-left:58px;">
			</td>
		</tr>
	</table>
</form>
<hr>
<br>
<?php
}
?>
			<?php
				$con = new connect();
				if(isset($_POST['simpan']))
				{
					if ($_POST['bagian'] != "") {
						$id_pegawai = $_POST['id_pegawai'];
						$nama_pegawai = $_POST['nama_pegawai'];
						$notelp_pegawai = $_POST['notelp_pegawai'];
						$alamat_pegawai = $_POST['alamat_pegawai'];
						$username = $_POST['username'];
						$password = $_POST['password'];
						$bagian = $_POST['bagian'];
						$con->insert_pegawai($id_pegawai, $nama_pegawai, $notelp_pegawai, $alamat_pegawai, $username, $password, $bagian, $id_pegawai);
					} else {
						echo '<script languange="javascript">alert ("Harap Pilih Bagian")</script>';
					}
				}
				
				if(isset($_POST['hapus'])){
					$id_pegawai = $_POST['id_pegawai'];
					
					$con->hapus_pegawai($id_pegawai);
				}
				
				if(isset($_POST['update']))
				{
					$id_pegawai = $_POST['id_pegawai'];
					$nama_pegawai = $_POST['nama_pegawai'];
					$notelp_pegawai = $_POST['notelp_pegawai'];
					$alamat_pegawai = $_POST['alamat_pegawai'];
					$username = $_POST['username'];
					$bagian = $_POST['bagian'];
					
					$con->update_pegawai($id_pegawai, $nama_pegawai, $notelp_pegawai, $alamat_pegawai, $username, $bagian);
				}
				?>

					<table width="100%" align="center" border="1">
					<tr style="background-color:lightblue">
					<th style="text-align:center">No.</th>
					<th style="text-align:center">Id Pegawai</th>
					<th style="text-align:center">Nama Pegawai</th>
					<th style="text-align:center">No.Telp</th>
					<th style="text-align:center">Alamat</th>
					<th style="text-align:center">Username</th>
					<th style="text-align:center">Bagian</th>
					<th style="text-align:center" width="200px">Action</th>
					</tr>
					<?php
					$con = new connect();
					$res = $con->get_select_table(pegawai);
					$no=1;
					if (!$res) {
						echo '<script languange="javascript">alert ("'.$res.'")</script>';
					} else {
					while($data=mysql_fetch_array($res)){?>
						<form action="" method="POST">
						<tr style="text-align:center">
							<td><?php echo $no; $no++;?></td>
							<td><input style="text-align:center" type="text" readonly="1" size="5" name="id_pegawai" value="<?php echo $data['id_pegawai']?>" /></td>
							<td><input style="text-align:center" type="text" readonly="1" name="nama_pegawai" value="<?php echo $data['nama_pegawai']?>" /></td>
							<td><input style="text-align:center" type="text" readonly="1" name="notelp_pegawai" value="<?php echo $data['notelp_pegawai']?>" /></td>
							<td><input style="text-align:center" type="text" readonly="1" name="alamat_pegawai" value="<?php echo $data['alamat_pegawai']?>" /></td>
							<td><input style="text-align:center" type="text" readonly="1" name="username" value="<?php echo $data['username']?>" /></td>
							<td><input style="text-align:center" type="text" readonly="1" size="4" name="bagian" value="<?php echo $data['bagian']?>" /></td>
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
					</table>