<?php
$conn = mysqli_connect("localhost", "root", "", "jual");

function hapus($idbar)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_barang WHERE id_barang = '$idbar'");
    return mysqli_affected_rows($conn);
}