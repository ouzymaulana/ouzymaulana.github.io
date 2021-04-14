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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>MYstore</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  bg-secondary fixed-top">
        <div class="container">
            <h3><i class="fas fa-cart-plus ml-3 text-light mr-2" style="font-size: 35px;"></i></h3>
            <a class="navbar-brand font-weight-bold" style="color: aliceblue; font-size:25px;" href="#">MYstore</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0" action="" method="POST">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "jual");

                   
                    $total = 0;
                    if(!empty($_SESSION['cart'])){
                       
                        if(isset($_POST["btn_jumlah"])){

                            foreach($_POST as $key => $value){
                                                        
                                if(isset($_SESSION["cart"][$key])){
                                
                                    $_SESSION["cart"][$key]["quantity"] = $_POST[$key];
                                  
                                    // var_dump($_SESSION['cart'][$key]['harga_bar']);
                                    // exit;
                                    
                                    $_SESSION["cart"][$key]["sub_ttl"] = $_SESSION['cart'][$key]['harga_bar'] * $_POST[$key];
                                    
                                    $total+=$_SESSION["cart"][$key]["sub_ttl"];

                                    $_SESSION["cart"][$key]["totalakhir"] = $total;
                                    
                                }
                            } 
                           
                        }
                    }
                    ?>
                    <a href="era.php" class="btn btn-success">chackout</a>

                    <input class="form-control ml-sm-2" type="search" value="Total Rp.<?= number_format($total); ?>"
                        disabled>
                </form>

                <ul class="navbar-nav ml-auto mr-3">

                    <li>
                        <a class="btn btn-warning" href="index.php" style="border-radius: 45%; font-size:18px"><i
                                class="fas fa-cart-plus" style="font-size: 20px;"></i></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">

                    <?php
                    $saldo = "SELECT saldo FROM tb_penjual WHERE id_pen = " . $_SESSION["id_penjual"];
                    
                    $sald = mysqli_query($conn,$saldo);
            
            
                    while($sal=mysqli_fetch_array($sald)) {
                    ?>
                    <input class="form-control mr-sm-2" type="search"
                        value="Saldo Rp.<?= number_format($sal["saldo"],2); ?>" disabled>
                    <?php } ?>

                </form>
            </div>
        </div>
    </nav>


    <br>
    <br>
    <div id="main-img" style="height:100vh; background-image:url('img/vektor14.jpg');">

        <!-- <div class="card-group;"> -->

        <div class="pb-5" style="padding-top: 2%; padding-left: 5%;">

            <!-- <div class="row mt-9"> -->
            <?php
 
    if(!empty($_SESSION["cart"])){
       ?>

            <form action="" method="post">

                <div class="row" style="padding-left:10%">
                    <?php
        foreach($_SESSION["cart"] as $val) {
            if (isset($val['id_barang'])) {
        ?>

                    <div class="card shadow-sm" style="width: 13rem">
                        <img src="img/<?= $val["gambar"]; ?>" style="height: 13rem" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title"><?= $val["nama_bar"]; ?></h3>
                            <p class="card-text">Stok : <?= $val["jumlah_bar"]; ?> <br>
                                <?= $val["keterangan"]; ?> <br>
                            </p>


                            <!-- <input type="hidden" name="id" value=""> -->

                        </div>
                        <div class="container">
                            <input type="number" name="<?= $val["id_barang"];?>" value="<?= $val["quantity"]; ?>"
                                class="form-control">

                            <button class="btn btn-primary" name="btn_jumlah" type="submit"
                                style="margin-top: 1ch;">kirim
                                jumlah</button>
                            <hr>
                            <p>
                                <a href="carthapus.php?id=<?= $val["id_barang"];?>" class="btn btn-danger"><i
                                        class="fas fa-trash-alt"></i></a>

                                <a class="btn btn-warning font-weight-bold"
                                    style="line-height: inherit;">Rp.<?= number_format($val["harga_bar"]); ?>
                                </a>
                            </p>
                        </div>


                    </div>



                    <?php
            }
    }
    ?>
                </div>


            </form>
        </div>
        <?php
}else{
    echo"<script>alert('Keranjang Masih Kosong');
    document.location.href = 'index.php';
    </script>";
    echo"";
    }

?>
    </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


</body>

</html>