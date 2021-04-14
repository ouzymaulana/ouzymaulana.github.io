<?php
session_start();
require '../../function.php';

$query = mysqli_query($conn,"SELECT * FROM tb_penjual WHERE id_pen = " . $_SESSION["id_penjual"]);
$penjual = mysqli_fetch_assoc($query);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>data penjual</title>
</head>

<body>
    <div id="main-img"
        style="height:100vh; background-image:url('../../img/vektor15.jpg'); background-position:center; background-size:100%;">

        <!-- <div class="card-group;"> -->

        <div class="pb-5" style="padding-top: 2%; padding-left: 15px;">
            <div class="container">
                <div class="card bg-lightcyan mb-3"
                    style="max-width: 30rem; height:30rem; font-size:2rem; margin-left:28%; margin-top:5rem; border-radius:12px;">
                    <div class="card-header" style="font-size: 25px;">
                        <a href="index.php" class="btn btn-primary" style="margin-right: 20%;">back</a>data penjual

                    </div>

                    <div class="card-body">
                        <div style="font-size: 15px;">ID : <?= $penjual["id_pen"]; ?> <br>
                            <hr>
                            No Ktp : <?= $penjual["no_ktp"]; ?> <br>
                            <hr>
                            Nama : <?= $penjual["nama"]; ?> <br>
                            <hr>
                            No Ktp : <?= $penjual["no_ktp"]; ?> <br>
                            <hr>
                            Saldo : <?= $penjual["saldo"]; ?> <br>
                            <hr>
                            Username : <?= $penjual["username"]; ?> <br>
                            <hr>
                            Password : <?= $penjual["password"]; ?> <br>
                        </div>
                    </div>
                </div>
            </div>
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