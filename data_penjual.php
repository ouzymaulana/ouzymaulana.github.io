<?php
session_start();
require 'function.php';
// require 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="penjual/login.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <title>Update Data</title>
</head>

<body>

    <div class="container">
        <h5 class="text-center"><i class="fas fa-user"></i> DATA PENJUAL</h5>
        <hr>
        <form action="" method="post">

            <?php
$datapenjual = "SELECT * FROM tb_penjual WHERE id_pen = " . $_SESSION["id_penjual"];

$datapen = mysqli_query($conn,$datapenjual);


 while($user = mysqli_fetch_assoc($datapen)) {

    
    ?>
            <div class="mb-3">
                <input type="text" name="nama" class="form-control" id="nama"
                    value="ID PENJUAL : <?= $user["id_pen"]; ?>" disabled>
            </div>

            <div class="mb-3">
                <input type="text" name="nama" class="form-control" id="nama" value="NO KTP : <?= $user["no_ktp"]; ?>"
                    disabled>
            </div>

            <div class="mb-3">
                <input type="text" name="nama" class="form-control" id="nama" value="NAMA : <?= $user["nama"]; ?>"
                    disabled>
            </div>

            <div class="mb-3">
                <input type="text" name="jml" id="jml" class="form-control" value="SALDO : <?= $user["saldo"]; ?>"
                    disabled>
            </div>

            <div class="mb-3">
                <input type="text" name="harga" class="form-control" id="harga"
                    value="USERNAME : <?= $user["username"]; ?>" disabled>
            </div>

            <div class="mb-3">
                <input type="text" name="nama" class="form-control" id="nama"
                    value="PASSWORD : <?= $user["password"]; ?>" disabled>
            </div>


            <div class="mb-3">
                <input type="text" name="ket" id="ket" class="form-control"
                    value="KETERANGAN : <?= $user["keterangan"]; ?>" disabled>
            </div>

            <!-- <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="text" name="gambar" id="gambar" class="form-control" value="">
            </div> -->

            <a href="admin/bs/index.php" class="btn btn-warning"><i class="fas fa-hand-point-left"></i> back</a>

        </form>

        <?php
    }
    
    ?>
</body>

</html>