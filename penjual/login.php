<?php
session_start();

// if (isset($_SESSION['submit'])) {
//     header("Location: tambah.php");
//     exit;
// }


$conn = mysqli_connect('localhost', 'root', '', 'jual');


//cek tombol submit
if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];


    $result = mysqli_query($conn, "SELECT * FROM tb_penjual WHERE username = '$username'");


    $hasil = mysqli_num_rows($result);


    //cek username
    if ($hasil == 1) {


        //cek passwordnya
        $row = mysqli_fetch_assoc($result);
        // echo "<pre>";
        // var_dump($row);
        // exit;

        $pwd = password_hash($password, PASSWORD_DEFAULT);

        $check = password_verify($row["password"], $pwd);

        if ($check) {

            // set session
            $_SESSION["submit"] = true;

            $_SESSION["username"] = $row["username"];
            $_SESSION["id_penjual"] = $row["id_pen"]; 
            // buat cookie
            // if (isset($_POST['remember'])) {

            // setcookie('submit', 'true', time() + 60);
            // }


            if ($row["keterangan"] == "penjual") {
                header("location: ../admin/bs/index.php");
            }elseif ($row["keterangan"] == "admin") {
                header("location: ../adminnew/index.php");
            } else {
                header("location: ../index.php");
            }
        }
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


    <title>LOGIN</title>
</head>

<body>

    <form action="" method="post">
        <!-- <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div> -->

        <div class="container">
            <h4 class="text-center">Form Login</h4>
            <hr>
            <div>
                <label for="uname"><b>Username</b></label>
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                    <input type="text" class="form-control" placeholder="Enter Username" name="username" required>
                </div>
            </div>
            <div>
                <label for="psw"><b>Password</b></label>
                <div class="input-group-prepend">

                    <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>

                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                </div>
            </div>
            <br>

            <button type="submit" class="btn btn-primary" name="submit">Login</button>
            <!-- <button type="button" name="daftar">Daftar</button> -->
            <a href="daftar2.php" class="btn btn-danger">daftar</a>

            <!-- <a class="btn btn-primary" href="data_mhs.php" role="button">DATA MAHASISWA</a> -->
            <!-- <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
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