<?php
session_start();
// $nim=$_GET["nim"];


// $mhs = mysqli_query($conn,"SELECT * FROM tb_mhs WHERE nim=" . $nim);
// $data=mysqli_fetch_array($mhs);

// $mhs = "SELECT * FROM tb_mhs WHERE nim=" . $nim;
// $hasil = mysqli_query($conn,$mhs);

// if(isset($_POST["button"])) {
//     mysqli_query($conn, "UPDATE data_mhs SET nama = '$_POST[nama]',
//     tgl_lahir = '$_POST[tgl]',
//     alamat = '$_POST[alamat]' WHERE nim = '$_GET[nim]'");

//     echo "data baru telah diubah";
//     echo "<mete http-equif=refresh content=1;URL='datamhs.php'>";
// }
$conn = mysqli_connect("localhost", "root", "", "jual");

if (isset($_POST["button"])) {

    $nama = $_POST["nama"];
    $jml = $_POST["jml"];
    $harga = $_POST["harga"];
    $ket = $_POST["ket"];
    $gambar = $_FILES["gambar"]["name"];
    $source = $_FILES["gambar"]["tmp_name"];
    $folder = "./img/";

    move_uploaded_file($source, $folder.$gambar);
    // $idpen = $_POST["idpen"];
    $sespenjual = $_SESSION["id_penjual"];

    $validation = true;
    // cek nama
    if (empty($nama)) {

        echo "<script>alert('NAMA tidak boleh kosong!')</script>";
        $validation = false;
    }
    // } else if (is_numeric($jml) != 1) {
    //     echo "<script>alert('Harga tidak boleh ada huruf')</script>";
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
        echo "<script>alert('Data berhasil masuk!')</script>";
        $result = mysqli_query($conn, "INSERT INTO tb_barang VALUES ('','$nama','$jml','$harga','$ket','$gambar','$sespenjual')");

        header("location:index.php");
    }

}
?>
<?php
            // while($data=mysqli_fetch_array($hasil)) { 
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
    <link rel="stylesheet" type="text/css" href="../../penjual/login.css">
    <link rel="stylesheet" type="text/css" href="../../fontawesome/css/all.min.css">

    <title>checkout</title>
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="container">
            <h4 class="text-center">Form Pendaftaran</h4>
            <hr>

            <div>
                <label for="nama" class="form-label">Nama Barang</label>
                <div class="input-group-prepend">
                    <input type="text" name="nama" class="form-control" id="nama" required>
                </div>
            </div>
            <div>
                <label for="jml" class="form-label">Jumlah Barang</label>
                <div class="input-group-prepend">
                    <input type="number" name="jml" id="jml" class="form-control" required>
                </div>
            </div>
            <div>
                <label for="harga" class="form-label">Harga Barang</label>
                <div class="input-group-prepend">
                    <input type="number" name="harga" class="form-control" id="harga" required>
                </div>
            </div>
            <div>
                <label for="ket" class="form-label">Keterangan</label>
                <div class="input-group-prepend">
                    <input type="text" name="ket" id="ket" class="form-control" required>
                </div>
            </div>
            <div>
                <label for="gambar" class="form-label">Gambar</label>
                <div class="input-group-prepend">
                    <input type="file" name="gambar" id="gambar" class="form-control" required>
                </div>
            </div>
            <!-- <div>
                <label for="idpen" class="form-label">Id Penjual</label>
                <div class="input-group-prepend">
                    <input type="number" name="idpen" id="idpen" class="form-control" required>
                </div>
            </div> -->

            <br>

            <button type="submit" name="button" class="btn btn-primary">Tambah</button>
            <a href="index.php" name="button" class="btn btn-warning">batal</a>


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