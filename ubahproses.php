<?php

$conn = mysqli_connect("localhost", "root", "", "jual");

$id = $_POST["id_barang"];
$nama = $_POST["nama"];
$jml = $_POST["jml"];
$harga = $_POST["harga"];
$ket = $_POST["ket"];
// $gambar = $_POST["gambar"];

$query = "UPDATE tb_barang SET nama_bar ='$nama', jumlah_bar ='$jml', harga_bar ='$harga', keterangan='$ket'WHERE id_barang=$id";
$hasil = mysqli_query($conn, $query);


if ($query) {
        

    echo "
            <script>
                    alert('data berhasil diupdate!');
                    document.location.href = 'admin/bs/index.php';
            </script>        
        ";

} else {

    echo "
            <script>
                    alert('data gagal diupdate');
                    document.location.href = 'ubah.php';
            </script>
        ";
}