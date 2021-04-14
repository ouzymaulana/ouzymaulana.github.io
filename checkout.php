<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>confirmasi penjualan</title>
</head>

<body>

    <div class="container">
        <h1>CheckOut</h1>

        <a href="index.php"><button class="btn btn-warning btn-xs far fa-hand-point-left">BACK</button></a>
        <!-- <a href="logout.php"><button class="btn btn-danger btn-xs">LOGOUT</button></a> -->

        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'jual');
        $idbar = $_GET["id_barang"];
        $barang = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_barang = '$idbar'");
        $bar = mysqli_fetch_assoc($barang);

        // $penjual = mysqli_query($conn,"SELECT * FROM tb_penjual");
        // $penju = mysqli_fetch_assoc($penjual);
        // $mhs = "SELECT * FROM tb_mhs WHERE id_barang=" . $idbar;
        // $hasil = mysqli_query($conn, $mhs);


        // while ($bag = mysqli_fetch_array($barang)) {
        //     var_dump($bag);
        //     exit;

        $sld = mysqli_query($conn, "SELECT saldo FROM tb_penjual WHERE id_pen = " . $_SESSION["id_penjual"]);
                    $sald = mysqli_fetch_assoc($sld);
                    
        ?>

        <form action="" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pembeli</label>
                <input type="text" name="name" id="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Pembeli</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="kirim" class="form-label">Alamat Pengiriman</label>
                <input type="text" name="kirim" class="form-control" id="kirim" required>
            </div>

            <div class="mb-3">
                <label for="telp" class="form-label">No.Telepon</label>
                <input type="text" name="telp" id="telp" class="form-control" required>
            </div>
            <input type="hidden" name="total">



            <button type="submit" name="button" class="btn btn-primary">PESAN</button>
        </form>

        <?php  ?>
        <br><br>



        <?php
        if (isset($_POST["button"])) {


            $nama = $_POST["name"];
            $kirim = $_POST["kirim"];
            $telp = $_POST["telp"];
            $nabar = $bar["nama_bar"];
            $habar = $bar["harga_bar"];
            $id_pen = $bar["id_penjual"];
            $jumbar = $bar["jumlah_bar"];
            $saldo = $sald["saldo"];
            $jml = $_POST["jumlah"];
            $total = $_POST["total"];
            $ttl = $habar * $jml;

            $pen =mysqli_query($conn,"SELECT saldo FROM tb_penjual WHERE id_pen = '$id_pen'");
            $penl = mysqli_fetch_assoc($pen);
           
            $sldo = $penl["saldo"];

            $validation = true;
            // cek nama
            if (!empty($nama)) {
                $namaa = explode(" ", $nama);
                // pengulangan kata dalam nama
                foreach ($namaa as $n) {
                    if (ctype_alpha($n) != 1) {
                        echo "<script>alert('Nama tidak boleh ada karakter angka!')</script>";
                        $validation = false;
                    }
                    continue;
                }
            }

            if ($saldo <= $ttl){
                echo"<script>alert('Saldo anda tidak cukup')</script>";
                $validation = false;

            }

            // confirm validation
            if ($validation == true) {

                $result = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES ('','$nama','$kirim','$telp','$nabar','$habar','$jml')");
                echo "<script>alert('Terima kasih sudah belanja di OZY STORE!!!                                               
                Barang anda akan segera dikirim!')</script>";
        ?>
        <div class="form-control" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-warning">
                    <div class="container">DATA PEMBELIAN</div>
                </li>
                <li class="list-group-item ">Nama Barang : <?= $nabar ?></li>
                <li class="list-group-item ">Harga Barang : <?= $habar ?></li>
                <li class="list-group-item ">Nama Pembeli : <?= $nama; ?></li>
                <li class="list-group-item ">Alamat Pengiriman : <?= $kirim; ?></li>
                <li class="list-group-item ">No Telepon : <?= $telp; ?></li>
                <li class="list-group-item ">Jumlah Barang : <?= $jml; ?></li>
                <li class="list-group-item ">Total : <?= $ttl; ?></li>
            </ul>
        </div><?php
                    //pengurangan jumlah barang
                    

                    //penambahan saldo penjual
                    $tambahakhir = $sldo + $ttl;

                    $querytambah = mysqli_query($conn, "UPDATE tb_penjual SET saldo = $tambahakhir WHERE id_pen = '$id_pen'");

                    //pengurangan saldo pembeli
                    $saldoakhir = $saldo - $ttl;
                    
                    $ubah = mysqli_query($conn,"UPDATE tb_penjual SET saldo = '$saldoakhir' WHERE id_pen = " . $_SESSION["id_penjual"]);


                    // $tmb = mysqli_query($conn, "SELECT saldo FROM tb_penjual WHERE id_barang = " . $_SESSION["id_penjual"]);
                    // $tmbh = mysqli_fetch_assoc($tmb);

                    

            }
                    
                }

                        ?>



    </div>
    <br><br>




</body>

</html>