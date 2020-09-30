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

// tambah
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $penerbit = $_POST['penerbit'];
    $pengarang = $_POST['pengarang'];
    $tahunTerbit = $_POST['tahun_terbit'];

    $insertBook = manipulateData("INSERT INTO buku VALUES 
            ('', '$judul', '$pengarang', '$genre', '$penerbit', '$tahunTerbit', '1')");

    if ($insertBook > 0) {
        echo '
            <script>
                alert("Berhasil menambahkan buku!");
                window.location.href="add-book.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Berhasil menambahkan buku!");
            </script>
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <title>E-Library (admin) - Tambah Buku</title>
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
    <?php $currentPage = 'add-book' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- main content -->
    <?php $head = 'Tambah Buku' ?>
    <?php $headline = 'Tambahkan data buku' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container">
        <div class="konten_isi">
            <table class="table-sm">
                <form class="form-text" action="" method="post">
                    <tr>
                        <td>Judul Buku</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="judul" placeholder="Judul Buku" autocomplete="off"  style="width: 250px" required></td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="pengarang" placeholder="Pengarang" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="genre" placeholder="Genre" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="penerbit" placeholder="Penerbit" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Tahun Terbit</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" name="tahun_terbit" placeholder="Tahun Terbit" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <center><button class="btn btn-primary btn-block" type="submit" name="tambah">Tambahkan</button></center>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    
    <!-- close div main content -->
    <?php include_once('../components/close-main-content.php') ?>
    
    <script src="js/bootstrap.js"></script>
</body>

</html>