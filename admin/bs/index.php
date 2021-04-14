<?php
session_start();
if (!isset($_SESSION["submit"])) {
    header("Location: ../../penjual/login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "jual");
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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../../style.css">

    <title>MYstore</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  bg-secondary fixed-top">
        <div class="container">
            <h3><i class="fas fa-cart-plus ml-3 text-light mr-2"></i></h3>
            <a class="navbar-brand font-weight-bold" style="color: aliceblue;" href="#">MYstore</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-2">
                    <li class="nav-item active">
                        <a class="btn btn-primary mr-2" href="tambah.php"><i class="fas fa-plus"
                                style="font-size: 23px;"></i><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="btn btn-primary mr-2" href="datapenjual.php"><i class="fas fa-address-card"
                                style="font-size:23px;"></i></a>
                    </li>





                </ul>
                <!-- <div class="icon mr-3 mt-2">
                    <h5>
                        <a href="card.php"><i class="fas fa-cart-plus"></i></a>
                    </h5>
                </div> -->
                <form class="form-inline my-2 my-lg-0">

                    <?php
            

            $saldo = "SELECT saldo FROM tb_penjual WHERE id_pen = " . $_SESSION["id_penjual"];
            
            $sald = mysqli_query($conn,$saldo);
            
            while($sal=mysqli_fetch_array($sald)) {
        ?>
                    <input class="form-control mr-sm-2 font-weight-bold" type="search"
                        value="Saldo Rp.<?= number_format($sal["saldo"],2); ?>" disabled>
                    <?php } ?>

                </form>

                <!-- <a class="btn btn-primary" href="../../logout.php">Out <i class="fas fa-sign-out-alt"></i></a> -->
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user fa-fw" style="font-size: 25px;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../../logout.php">Logout</a>
                        </div>
                    </li>
                </ul>


            </div>
        </div>
    </nav>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
    <br>
    <div id="main-img" style="height:100vh; background-image:url('../../img/vektor13.jpg');">

        <!-- <div class="card-group;"> -->

        <div class="pb-5" style="padding-top: 2%; padding-left: 5%;">
            <div class="row mt-3">
                <?php
        $conn = mysqli_connect("localhost", "root", "", "jual");


        $produk = "SELECT * FROM tb_barang WHERE id_penjual = " . $_SESSION["id_penjual"];

        $query = mysqli_query($conn, $produk);
        $p = mysqli_num_rows($query);

        if ($p) {
            while ($row = mysqli_fetch_array($query)) {
        ?>


                <div class="card" style="width: 13rem;">
                    <img src="../../img/<?= $row['gambar']; ?>" style="height: 13rem" class="card-img-top" ;>
                    <div class="card-body">
                        <h3 class="card-title"><?= $row['nama_bar']; ?></h3>
                        <?= ($row['jumlah_bar'] < 1) ? "<span class='float-right badge badge-warning'>Tidak Tersedia</span>" : "<span class='float-right badge badge-success'>Tersedia</span>"; ?>

                        <p class="card-text">Stok : <?= $row['jumlah_bar']; ?> <br>
                            <?= $row['keterangan']; ?> <br>
                        </p>
                    </div>
                    <div class="container">
                        <hr>

                        <p>
                            <a class="btn btn-primary">Rp.<?= number_format($row['harga_bar']); ?></a>
                        </p>
                        <p>
                            <a href="../../ubah.php?id_barang=<?= $row["id_barang"]; ?>" class="btn btn-warning"><i
                                    class="fas fa-fw fa-edit"></i></a>
                            <a href="../../delete.php?id_barang=<?= $row["id_barang"] ?>" class="btn btn-danger"><i
                                    class="fas fa-fw fa-trash"></i></a>
                        </p>
                    </div>
                </div>


                <?php

            }
        } else {
            echo "not found";
        }

        ?>
            </div>
        </div>
    </div>


    </div>

</body>

</html>