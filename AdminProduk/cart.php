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
                if (isset($_SESSION['itemproduk'][$barang_id])) {
                    $_SESSION['itemproduk'][$barang_id] += 1;
                } else {
                    $_SESSION['itemproduk'][$barang_id] = 1; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['itemproduk'][$barang_id])) {
                    $_SESSION['itemproduk'][$barang_id] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['barang_id'])) {
				$barang_id = $_GET['barang_id'];
				if (isset($_SESSION['itemproduk'][$barang_id])) {
					if ($_SESSION['itemproduk'][$barang_id] > 0) {
						$_SESSION['itemproduk'][$barang_id] -= 1;
					}
				}
            }
        } elseif ($act == "del") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['itemproduk'][$barang_id])) {
                    unset($_SESSION['itemproduk'][$barang_id]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['itemproduk'])) {
                foreach ($_SESSION['itemproduk'] as $key => $val) {
                    unset($_SESSION['itemproduk'][$key]);
                }
                unset($_SESSION['itemproduk']);
            }
        } 
         
        header ("location:" . $ref);
    }   
     
?>