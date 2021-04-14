<?php
session_start();
 $conn = mysqli_connect("localhost", "root", "", "jual");
    
 $id = $_GET["id_barang"];
 $sql = "SELECT * FROM tb_barang WHERE id_barang =".$id;
 $query = mysqli_query($conn,$sql);
 $hasil = mysqli_fetch_object($query);


 $_SESSION["cart"][$id] = [
     "id_barang" => $hasil->id_barang,
    "gambar" => $hasil->gambar,
     "nama_bar" => $hasil->nama_bar,
     "jumlah_bar" => $hasil->jumlah_bar,
     "keterangan" => $hasil->keterangan,
     "harga_bar" => $hasil->harga_bar,
     "quantity" => 1,
     "sub_ttl" => $hasil->sub_ttl,
     "totalakhir" => 0,
    
    //  "sub_total" => $hasil->harga_bar* $quantity
 ];

 $_SESSION["jml"] = 0;


// var_dump( $_SESSION["cart"]);
// exit;
 header("location:cart.php");

?>