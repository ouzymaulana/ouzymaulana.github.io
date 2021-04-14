<?php
require "navbar.php";
?>
<div id="main-img" style="height:auto; background-image:url('img/vektor12.jpg');"
    class="d-flex justify-content-center align-items-center">

    <div class="card-group;">

        <div class="row pb-5" style="padding-top: 9%; padding-left: 5%;">
            <?php
        
        $produk = "SELECT * FROM tb_barang WHERE jumlah_bar > 0";
        $query = mysqli_query($conn, $produk);
        $p = mysqli_num_rows($query);

        if ($p) {
            while ($row = mysqli_fetch_array($query)) {
        ?>

            <div class="card" style="width: 13rem;">
                <div class="card-img p-3">

                    <img src="img/<?= $row['gambar']; ?>" style="height: 13rem " class="card-img-top">

                </div>
                <div class="card-body">
                    <h3 class="card-title"><?= $row['nama_bar']; ?></h3>
                    <?= ($row['jumlah_bar'] < 1) ? "<span class='float-right badge badge-warning'>Tidak Tersedia</span>" : "<span class='float-right badge badge-success'>Tersedia</span>"; ?>
                    <p class="card-text">Stok : <?= $row['jumlah_bar']; ?> <br>
                        <?= $row['keterangan']; ?> <br>
                    </p>
                    <!-- <a href="checkout.php?id_barang= class="btn btn-primary">BELI</a> -->
                </div>
                <div class="container">
                    <hr>

                    <p>
                        <a class="btn btn-warning font-weight-bold">Rp.<?= number_format($row['harga_bar']); ?></a>

                        <a href="cartproses.php?id_barang=<?= $row["id_barang"]; ?>" method="post" name="proses"
                            class="btn btn-primary"><i class="fas fa-cart-plus"></i></a>
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

<!-- footer -->
<!-- <footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2020</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer> -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/datatables-demo.js"></script> -->


</html>