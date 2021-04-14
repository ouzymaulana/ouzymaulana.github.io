<?php
require "../function.php";

$result = mysqli_query($conn,"SELECT * FROM tb_penjual WHERE keterangan = 'pembeli'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">MYstore</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-house-user"></i></div>
                            TRANSAKSI
                        </a>
                        <a class="nav-link" href="penjual.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-secret"></i></div>
                            PENJUAL
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                            PEMBELI
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    ADMIN
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <!-- <h1 class="mt-4">Dashboard</h1> -->
                    <br>
                    <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <?php $query = mysqli_query($conn,"SELECT sum(saldo) AS sald FROM tb_penjual WHERE keterangan = 'pembeli'");
                                $saldo = mysqli_fetch_assoc($query);
                                $sald = $saldo['sald'];
                                ?>
                                <div class="card-body">TOTAL JUMLAH SALDO PEMBELI : <?= number_format($sald,2); ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <?php $pembeli = mysqli_query($conn,"SELECT count(nama) AS nama FROM tb_penjual WHERE keterangan = 'pembeli'");
                                $beli = mysqli_fetch_assoc($pembeli);
                                
                                $pembelian = $beli['nama'];
                                ?>
                                <div class="card-body">TOTAL JUMLAH PEMBELI : <?= $pembelian ?></div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <?php
                                $ttlbarang = mysqli_query($conn,"SELECT sum(jumlah) AS barang FROM tb_transaksi");
                                $barang = mysqli_fetch_assoc($ttlbarang);
                                $brg = $barang['barang'];
                                ?>
                                <div class="card-body">TOTAL BARANG YANG DIBELI : <?= $brg ?></div>

                            </div>
                        </div>


                    </div>

                    <!-- tabel -->
                    <div class="card mb-4" style="background-color: lightsteelblue;">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Data Pembeli
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        </tr>
                                        </tfoot>
                                    <tbody>
                                        <th>ID</th>
                                        <th>No Ktp</th>
                                        <th>Nama</th>
                                        <th>Saldo</th>

                                        </tr>
                                        </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>No Ktp</th>
                                            <th>Nama</th>
                                            <th>Saldo</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <tr>
                                            <td><?= $row["id_pen"]; ?></td>
                                            <td><?= $row["no_ktp"]; ?></td>
                                            <td><?= $row["nama"]; ?></td>
                                            <td><?= number_format($row["saldo"],2); ?></td>

                                            <?php

                                        }
                                        ?>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>