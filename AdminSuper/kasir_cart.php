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
                if (isset($_SESSION['admin_itemproduk'][$barang_id])) {
                    $_SESSION['admin_itemproduk'][$barang_id] += 1;
                } else {
                    $_SESSION['admin_itemproduk'][$barang_id] = 1; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['admin_itemproduk'][$barang_id])) {
                    $_SESSION['admin_itemproduk'][$barang_id] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['barang_id'])) {
				$barang_id = $_GET['barang_id'];
				if (isset($_SESSION['admin_itemproduk'][$barang_id])) {
					if ($_SESSION['admin_itemproduk'][$barang_id] > 0) {
						$_SESSION['admin_itemproduk'][$barang_id] -= 1;
					}
				}
            }
        } elseif ($act == "del") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['admin_itemproduk'][$barang_id])) {
                    unset($_SESSION['admin_itemproduk'][$barang_id]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['admin_itemproduk'])) {
                foreach ($_SESSION['admin_itemproduk'] as $key => $val) {
                    unset($_SESSION['admin_itemproduk'][$key]);
                }
                unset($_SESSION['admin_itemproduk']);
            }
        } 
         
        header ("location:" . $ref);
    }   
     
?>