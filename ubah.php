<?php
$conn = mysqli_connect("localhost","root","","jual");


$idbar =$_GET["id_barang"];

// var_dump($_POST);



// $mhs = mysqli_query($conn,"SELECT * FROM tb_mhs WHERE nim=" . $nim);
// $data=mysqli_fetch_array($mhs);

$bar = "SELECT * FROM tb_barang WHERE id_barang =" . $idbar;
$hasil = mysqli_query($conn,$bar);
// var_dump($hasil);
// exit;


// if(isset($_POST["button"])) {
//     mysqli_query($conn, "UPDATE data_mhs SET nama = '$_POST[nama]',
//     tgl_lahir = '$_POST[tgl]',
//     alamat = '$_POST[alamat]' WHERE nim = '$_GET[nim]'");

//     echo "data baru telah diubah";
//     echo "<mete http-equif=refresh content=1;URL='datamhs.php'>";
// }

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
        <h4 class="text-center">Upadate Data Barang</h4>
        <hr>


        <form action="ubahproses.php" method="post">

            <?php
while($data=mysqli_fetch_array($hasil)) {
    
    ?>

            <input type="hidden" name="id_barang" value="<?= $data["id_barang"];?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" id="nama" value="<?= $data["nama_bar"]; ?>">
            </div>

            <div class="mb-3">
                <label for="jml" class="form-label">Jumlah Barang</label>
                <input type="text" name="jml" id="jml" class="form-control" value="<?= $data["jumlah_bar"]; ?>">
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="text" name="harga" class="form-control" id="harga" value="<?= $data["harga_bar"]; ?>">
            </div>

            <div class="mb-3">
                <label for="ket" class="form-label">Keterangan</label>
                <input type="text" name="ket" id="ket" class="form-control" value="<?= $data["keterangan"]; ?>">
            </div>

            <!-- <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="text" name="gambar" id="gambar" class="form-control" value="">
            </div> -->


            <button type="submit" name="button" class="btn btn-primary">Submit</button>
            <a href="admin/bs/index.php" class="btn btn-warning btn-xs">BACK</a>


        </form>

        <?php
    }
    
    ?>
</body>

</html>