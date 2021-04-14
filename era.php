<?php
session_start();
if (!isset($_SESSION["submit"])) {
    header("Location: penjual/login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="penjual/login.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <title>checkout</title>
</head>

<body>

    <?php
        $conn = mysqli_connect("localhost","root","","jual");
        // echo"<pre>";
        // print_r($_SESSION["cart"]);
        // exit; 
        
        
        $sld = mysqli_query($conn, "SELECT * FROM tb_penjual WHERE id_pen = " . $_SESSION["id_penjual"]);
                        $sald = mysqli_fetch_assoc($sld);

                        foreach($_SESSION["cart"] as $rey => $ral){

                            if($ral["quantity"] > $ral["jumlah_bar"]) {
                                echo"<script>alert('Pesanan anda melebihi stok barang!!');
                                    document.location.href =  'cart.php';
                                </script>";
                            }

                            if($ral["totalakhir"] < 1){
                      
                                            echo "<script>alert('Anda belum mengirimkan jumlah barang!!');
                                            document.location.href = 'cart.php';
                                            </script>";
                            }

                            if($sald["saldo"] < $ral["totalakhir"]){
                                echo "<script>alert('Saldo Anda Tidak Cukup');
                                document.location.href = 'index.php';
                                </script>";
                            
                            }
                        }
        ?>

    <form action="" method="post">

        <div class="container">
            <h4 class="text-center">Form Checkout</h4>
            <hr>

            <div>
                <label for="kirim"><b>Alamat Pengiriman</b></label>
                <div class="input-group-prepend">
                    <input type="text" name="kirim" id="kirim" class="form-control" required>
                </div>
            </div>
            <div>
                <label for="telp"><b>No Telepon</b></label>
                <div class="input-group-prepend">
                    <input type="number" name="telp" id="telp" class="form-control" required>
                </div>
            </div>
            <input type="hidden" name="total">

            <br>

            <button type="submit" name="button" class="btn btn-primary" data-toggle="modal"
                data-target="#exampleModal">PESAN</button>
            <a href="index.php" class="btn btn-warning btn-xs far fa-hand-point-left">BACK</a>
        </div>

    </form>

    <br><br>

    <!-- <div id="main-img" style="height:500px; background-image:url('img/vektor6.jpg');"> -->

    <!-- <div class="card-group;"> -->

    <!-- <div class="pb-5" style="padding-top: 2%; padding-left: 4%;"> -->

    <!-- </div>
    </div> -->

    <?php
        if (isset($_POST["button"])) {

            if(isset($_SESSION['cart'])){

                foreach($_SESSION["cart"] as $key => $val) 
                {
                     //pengurangan jumlah barang
                    $jumakhir = $val["jumlah_bar"] - $val["quantity"];
                    $query_kurang_barang = mysqli_query($conn,"UPDATE tb_barang SET jumlah_bar = $jumakhir WHERE id_barang = " . $val["id_barang"]);
    
                     //tampilin session barang
                    $barang = "SELECT * FROM tb_barang WHERE id_barang =" . $_SESSION["cart"][$key]["id_barang"];
                    $bara = mysqli_query($conn,$barang);
                    $bar = mysqli_fetch_assoc($bara);
    
                    //ambil saldo penjual barang
                    $pen =mysqli_query($conn,"SELECT saldo FROM tb_penjual WHERE id_pen = " . $bar["id_penjual"]);
                    $penl = mysqli_fetch_assoc($pen);
                    
                    //penambahan saldo penjual //
                    $tambahakhir = $penl["saldo"] +  $_SESSION["cart"][$key]["sub_ttl"];
                    
                    $querytambah = mysqli_query($conn, "UPDATE tb_penjual SET saldo = $tambahakhir WHERE id_pen = " . $bar["id_penjual"]);
                       
                }
    
                        
    
        }else{
            header("location: index.php");
        }

        if(!empty($_SESSION["cart"])){


            foreach($_SESSION["cart"] as $posisi => $isi){
                // echo"<pre>";
                // print_r($_SESSION["cart"][$posisi]["quantity"]);
                 
                $_SESSION["jml"] += $isi["quantity"];

                $jum = $_SESSION["jml"];
            }
        }   

            $nama = $sald["nama"];
            $kirim = $_POST["kirim"];
            $telp = $_POST["telp"];
            $nabar = $bar["nama_bar"];
            $habar = $bar["harga_bar"];
            $id_pen = $bar["id_penjual"];
            $saldo = $sald["saldo"];
            

            $validation = true;
            // cek nama
            // if (!empty($nama)) {
            //     $namaa = explode(" ", $nama);
            //     // pengulangan kata dalam nama
            //     foreach ($namaa as $n) {
            //         if (ctype_alpha($n) != 1) {
            //             echo "<script>alert('Nama tidak boleh ada karakter angka!')</script>";
            //             $validation = false;
            //         }
            //         continue;
            //     }
            // }

            // if ($saldo <= $ttl){
            //     echo"<script>alert('Saldo anda tidak cukup')</script>";
            //     $validation = false;
            // }

            // confirm validation
            if ($validation == true) {
               
                $totalakhir = $val["totalakhir"];

                $result = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES ('','$nama','$kirim','$telp','$totalakhir','$jum')");

                    //pengurangan saldo pembeli
                    $saldoakhir = $saldo - $totalakhir;
                    $ubah = mysqli_query($conn,"UPDATE tb_penjual SET saldo = '$saldoakhir' WHERE id_pen = " . $_SESSION["id_penjual"]);
            
?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="" style="padding-top: 1rem;">
                    <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;">payment
                        confirmation
                    </h5>
                </div>

                <div class="modal-body">
                    <!-- <div class="card-group text-white bg-warning mb-3" style="max-width: 10rem;"> -->
                    <div class="card border-success mb-3" style="max-width:none; padding: top 1rem;">
                        <!-- <div class="card-header">Header</div> -->
                        <div class="card-body">
                            <?php
                    if(!empty($_SESSION["cart"])){
                    
                        foreach($_SESSION["cart"] as $conf => $con){
                    ?>
                            <p class="font-weight-bold">
                                Nama Barang : <?= $con["nama_bar"] ?> <br>
                                Jumlah Pembelian : <?= $con["quantity"]; ?> <br>
                                Harga Barang : Rp.<?= number_format($con["harga_bar"],2) ?>
                                <hr>
                            </p>
                            <?php 
                        }
                    } ?>
                        </div>
                    </div>

                    <div class="card text-black border-success mb-3" style="max-width:none; background-color:9dd8c8;">
                        <div class="card-body">
                            <div class="font-weight-bold">
                                Nama Pembeli : <?= $nama; ?>
                                <hr>
                                Alamat Pengiriman : <?= $kirim; ?>
                                <hr>
                                No Telepon : <?= $telp; ?>
                                <hr>
                                Total Pembayaran : Rp.<?= number_format($totalakhir,2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <a type="submit" name="mdl" href="index.php" class="btn btn-warning">Close</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
                    
                   unset($_SESSION["cart"]);
                
            }
                    
                }
                
                        ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>