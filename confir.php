<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "jual");
                   
$total = 0;
if(!empty($_SESSION['cart'])){


foreach($_SESSION['cart'] as $key => $values){

    if(!empty(["jumlah"])){
        // $quantity = $_POST["quantity"];
    
    
    

    // if($ror['id_barang'] == $sald){
        if (isset($values["id_barang"])) {
            // $total += $values["harga_bar"];
            $ttl = $values["quantity"];
            var_dump($ttl);
          
            $total += $values["harga_bar"] * $ttl;
            var_dump($total);
            exit;
            
            
        }
       
    }
}

// $count = count($_SESSION['cart']);

} 
                            ?>