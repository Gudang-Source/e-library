<?php 
session_start();

if (empty($_SESSION['login'])) {
    header('Location: ../auth/login.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            $user = $_SESSION['user'];
        break;
        case 'user': 
            header('Location: ../mahasiswa/home.php');
        break;
    }
}

// koneksi ke databse
require '../config/koneksi.php';
require '../functions.php';

// update
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = getData("SELECT * FROM buku WHERE id_buku = $id");

    // update
    if (isset($_POST['update'])) {
        $judul = $_POST['judul'];
        $genre = $_POST['genre'];
        $penerbit = $_POST['penerbit'];
        $pengarang = $_POST['pengarang'];
        $tahunTerbit = $_POST['tahun_terbit'];

        $editBuku = manipulateData("UPDATE buku SET judul_buku = '$judul', genre = '$genre', 
                penerbit = '$penerbit', pengarang = '$pengarang', tahun_terbit = '$tahunTerbit' WHERE id_buku = $id");
        if ($editBuku > 0) {
            echo '
                <script>
                    alert("Berhasil edit buku!");
                    window.location.href="home.php"
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Gagal edit buku!");
                </script>
            ';
        }
    }
    
} else {
    echo '
        <script>
            alert("Illegal access!");
            window.location.href="home.php"
        </script>
    ';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <title>E-Library (admin) - Edit Buku</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/styler.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'nothing' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- main content -->
    <?php $head = 'Edit Buku' ?>
    <?php $headline = 'Edit data buku' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container">
        <div class="konten_isi">
            <table class="table-sm">
                <form class="form-text" action="" method="post">
                    <tr>
                        <td>Judul Buku</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="judul" value="<?= $data['judul_buku'] ?>" autocomplete="off"  style="width: 250px" required></td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="pengarang" value="<?= $data['pengarang'] ?>" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="genre" value="<?= $data['genre'] ?>" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="penerbit" value="<?= $data['penerbit'] ?>" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Tahun Terbit</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <center><button class="btn btn-primary btn-block" type="submit" name="update">Update</button></center>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    
    <!-- close div main content -->
    <?php include_once('../components/close-main-content.php') ?>
</body>

</html>