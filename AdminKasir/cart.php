<?php
    require_once("../include/connect.php");
    if (!isset($_SESSION)) {
        session_start();
    }
     
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
             
        if ($act == "add") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['produk_jadi'][$barang_id])) {
                    $_SESSION['produk_jadi'][$barang_id] += 1;
                } else {
                    $_SESSION['produk_jadi'][$barang_id] = 1; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['produk_jadi'][$barang_id])) {
                    $_SESSION['produk_jadi'][$barang_id] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['barang_id'])) {
				$barang_id = $_GET['barang_id'];
				if (isset($_SESSION['produk_jadi'][$barang_id])) {
					if ($_SESSION['produk_jadi'][$barang_id] > 0) {
						$_SESSION['produk_jadi'][$barang_id] -= 1;
					}
				}
            }
        } elseif ($act == "del") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['produk_jadi'][$barang_id])) {
                    unset($_SESSION['produk_jadi'][$barang_id]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['produk_jadi'])) {
                foreach ($_SESSION['produk_jadi'] as $key => $val) {
                    unset($_SESSION['produk_jadi'][$key]);
                }
                unset($_SESSION['produk_jadi']);
            }
        } 
         
        header ("location:" . $ref);
    }   
     
?>