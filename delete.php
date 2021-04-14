<?php
require 'function.php';
$conn = mysqli_connect("localhost", "root", "", "jual");

$idbar = $_GET["id_barang"];

// if (isset($_GET["hapus"])) {
//     $sul = mysqli_query($conn, "DELETE FROM tb_barang WHERE id_barang = '$idbar'");
if (isset($_GET["hapus"])) {
    $cek =  hapus($idbar);

    echo "
    <script> 
              alert('data berhasil di hapus!');
                 document.location.href = 'admin/bs/index.php' 
             </script> ";
}
echo "
    <script>
    tes = confirm('kamu yakin?');
    if ( tes === true) {
            document.location.href = 'delete.php?hapus=1&id_barang=" . $idbar . "';
    } else {
        alert('data gagal di hapus!');
        document.location.href = 'admin/bs/index.php';
    }
    </script>
    ";
