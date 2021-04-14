<!doctype html>
<html lang="en">
<?php

$conn = mysqli_connect("localhost", "root", "", "jual");

if (isset($_POST["button"])) {

    $ktp = $_POST["ktp"];
    $nama = $_POST["nama"];
    $saldo = $_POST["saldo"];
    $user = $_POST["username"];
    $pass = $_POST["pass"];
    $ket = $_POST["ket"];
    // $confi = $_POST["confirm"];

    $validation = true;

    // cek nim dan password
    if (empty($ktp)) {

        echo "<script>alert('KTP tidak boleh kosong!')</script>";
        $validation = false;
    } else if (is_numeric($ktp) != 1) {
        echo "<script>alert('KTP tidak boleh ada huruf')</script>";
        $validation = false;
    }
    // } else if ($pass != $confi) {
    //     echo "<script>alert('Konfirmasi password tidak sama!')</script>";
    //     $validation = false;
    // }


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

    // confirm validation
    if ($validation == true) {

        
        $result = mysqli_query($conn, "INSERT INTO tb_penjual VALUES ('','$ktp','$nama','$saldo','$user','$pass','$ket')");
        // header("location: login.php");
        echo "<script>alert('Data berhasil masuk!!');
                document.location.href = 'login.php';
        </script>";

    }
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
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <title>checkout</title>
</head>

<body>

    <form action="" method="post">

        <div class="container">
            <h4 class="text-center">Form Pendaftaran</h4>
            <hr>

            <div>
                <label for="ktp" class="form-label">No Ktp</label>
                <div class="input-group-prepend">
                    <input type="text" name="ktp" class="form-control" id="ktp" required>
                </div>
            </div>
            <div>
                <label for="nama" class="form-label">Nama</label>
                <div class="input-group-prepend">
                    <input type="text" name="nama" class="form-control" id="nama" required>
                </div>
            </div>
            <div>
                <label for="saldo" class="form-label">Saldo</label>
                <div class="input-group-prepend">
                    <input type="number" name="saldo" class="form-control" id="saldo" required>
                </div>
            </div>
            <div>
                <label for="username" class="form-label">Username</label>
                <div class="input-group-prepend">
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
            </div>
            <div>
                <label for="pass" class="form-label">Password</label>
                <div class="input-group-prepend">
                    <input type="password" name="pass" id="pass" class="form-control" required>
                </div>
            </div>
            <div>
                <label for="ket" class="form-label">Keterangan</label><br>

                <input type="radio" name="ket" id="ket" value="penjual"> PENJUAL
                <input type="radio" name="ket" id="ket" value="pembeli" class="ml-2"> PEMBELI

            </div>
            <input type="hidden" name="total">

            <br>

            <button type="submit" name="button" class="btn btn-primary">Daftar</button>
            <a href="../index.php" class="btn btn-warning btn-xs">BACK</a>

        </div>

    </form>


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