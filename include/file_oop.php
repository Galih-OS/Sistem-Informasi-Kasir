<?php
	class connect
	{
		public function connect()
		{
			mysql_connect("localhost","root");
			mysql_select_db("db_retail");
		}
		/*
		public function setdata($sql)
		{
			mysql_query($sql);
		}
		public function getdata($sql)
		{
			return mysql_query($sql);
		}
		public function delete($sql)
		{
			mysql_query($sql);
		}
		*/
		// ############ GET SELECT * TABLE
		public function get_select_table($tabel)
		{
			return mysql_query ("SELECT * FROM ".$tabel."");
		}
		// ############ GET MAX VALUE
		public function get_max($tabel)
		{
			$con = new connect();
			
			$query = mysql_query ("SELECT MAX(no)+1 AS max FROM ".$tabel."");
			$max = mysql_fetch_array($query);
			$max = $max['max'];
			if ($max == '') {
				$max = 1;
			}
			return $max;
		}
		// ############ PEGAWAI
		public function insert_pegawai($id_pegawai, $nama_pegawai, $notelp_pegawai, $alamat_pegawai, $username, $password, $bagian, $id_pegawai)
		{
			$con = new connect();
			mysql_query("INSERT INTO pegawai(id_pegawai, nama_pegawai,notelp_pegawai, alamat_pegawai, username, password, bagian) VALUES('$id_pegawai','$nama_pegawai','$notelp_pegawai','$alamat_pegawai','$username','$password','$bagian')");
		}
		
		public function hapus_pegawai($id_pegawai)
		{
			$con = new connect();
			mysql_query("DELETE from pegawai where id_pegawai = '$id_pegawai' ");
		}
		
		public function update_pegawai($id_pegawai, $nama_pegawai, $notelp_pegawai, $alamat_pegawai, $username, $bagian)
		{
			$con = new connect();
			mysql_query("UPDATE pegawai SET 
						nama_pegawai='$nama_pegawai',
						notelp_pegawai='$notelp_pegawai',
						alamat_pegawai='$alamat_pegawai',
						username='$username',
						bagian='$bagian'
						WHERE id_pegawai='$id_pegawai' ");
		}
		// ############ END PEGAWAI
		
		// ############ BAHAN_MENTAH
		public function insert_bahan_mentah($id_material, $nama_material, $harga_material, $max)
		{
			$con = new connect();
			mysql_query("INSERT INTO bahan_mentah VALUES('$id_material','$nama_material',0,$harga_material,'$max')");
		}
		
		public function hapus_bahan_mentah($id_material)
		{
			$con = new connect();
			mysql_query("DELETE from bahan_mentah where id_bahan = '$id_material' ");
		}
		
		public function update_bahan_mentah($id_material, $nama_material, $harga_material)
		{
			$con = new connect();
			mysql_query("UPDATE bahan_mentah SET nama_bahan='$nama_material', harga='$harga_material' where id_bahan='$id_material'");
		}
		// ############ END BAHAN_MENTAH
		
		// ############ SUPPLIER
		public function insert_supplier($id_material, $nama_material, $harga_material, $max)
		{
			$con = new connect();
			mysql_query("INSERT INTO bahan_mentah VALUES('$id_material','$nama_material',$harga_material,'$max')");
		}
		
		public function hapus_supplier($id_supplier)
		{
			$con = new connect();
			mysql_query("DELETE from supplier where id_supplier = '$id_supplier' ");
		}
		
		public function update_supplier($id_supplier, $nama_supplier, $alamat_supplier)
		{
			$con = new connect();
			mysql_query("UPDATE supplier SET nama_supplier='$nama_supplier', alamat_supplier='$alamat_supplier' where id_supplier='$id_supplier'");
		}
		// ############ END SUPPLIER
		
		// ############ PRODUK
		public function insert_produk($id_barang, $nama_barang, $harga, $max)
		{
			$con = new connect();
			mysql_query("INSERT INTO barang_jadi VALUES('$id_barang','$nama_barang',0,$harga,'$max')");
		}
		
		public function hapus_produk($id_barang)
		{
			$con = new connect();
			$hasil = mysql_query("DELETE from barang_jadi where id_barang = '$id_barang' ");
			return $hasil;
		}
		
		public function update_produk($id_barang, $nama_barang, $harga)
		{
			$con = new connect();
			mysql_query("UPDATE barang_jadi SET nama_barang='$nama_barang', harga='$harga' where id_barang='$id_barang'");
		}
		// ############ END PRODUK
		
		// ############ OOP GET CODE
		public function get_kode_id_pembelian()
		{
			$con = mysql_connect("localhost","root","");
			if (!$con) {
			  die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("db_retail", $con);
			
			$query = mysql_query ("SELECT MAX(no)+1 AS max FROM pembelian");
			$max = mysql_fetch_array($query);
			$max = $max['max'];
			if ($max == '') {
				$max = 1;
			}
			return 'PEM'.$max;
		}
		
		public function get_kode_id_permintaan_produksi()
		{
			$con = mysql_connect("localhost","root","");
			if (!$con) {
			  die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("db_retail", $con);
			
			$query = mysql_query ("SELECT MAX(no)+1 AS max FROM permintaan_produksi");
			$max = mysql_fetch_array($query);
			$max = $max['max'];
			if ($max == '') {
				$max = 1;
			}
			return 'PRO'.$max;
		}
		
		public function get_kode_id_penjualan()
		{
			$con = mysql_connect("localhost","root","");
			if (!$con) {
			  die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("db_retail", $con);
			
			$query = mysql_query ("SELECT MAX(no)+1 AS max FROM penjualan");
			$max = mysql_fetch_array($query);
			$max = $max['max'];
			if ($max == '') {
				$max = 1;
			}
			return 'PEN'.$max;
		}
		
		public function get_kode_id_permintaan_penjualan()
		{
			$con = mysql_connect("localhost","root","");
			if (!$con) {
			  die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("db_retail", $con);
			
			$query = mysql_query ("SELECT MAX(no)+1 AS max FROM permintaan_penjualan");
			$max = mysql_fetch_array($query);
			$max = $max['max'];
			if ($max == '') {
				$max = 1;
			}
			return 'PPJ'.$max;
		}
	}
?>