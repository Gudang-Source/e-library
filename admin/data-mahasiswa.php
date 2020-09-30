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

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$buku = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <title>E-Library (admin) - Data Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/styler.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <!-- header -->
    <?php include_once('../components/header.php') ?>

    <!-- sidebar -->
    <?php $currentPage = 'data-mahasiswa' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- main content -->
    <?php $head = 'Data Mahasiswa' ?>
    <?php $headline = 'Data Mahasiswa Aktif' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Nama Lengkap</th>
                            <th>NPM</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>
                        </tr>

                        <?php $i = 1; ?>
                        <?php foreach ($buku as $row) : ?>
                        <?php if ($row['nama_lengkap'] && $row['npm'] != '') : $pagination = "aktif" ?>
                            <tr class="show">
                                <td><?= $i; ?></td>
                                <td><?= $row["nama_lengkap"]; ?></td>
                                <td><?= $row["npm"]; ?></td>
                                <td><?= $row["alamat"]; ?></td>
                                <td><?= $row["no_hp"]; ?></td>
                            </tr>
                            <?php $i++ ?>
                        <?php else : $pagination = "" ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <?php if ($pagination == "aktif") : ?>
            <!-- pagination -->
            <?php include_once('../components/pagination.php') ?>
        <?php endif; ?>
    </div>

    <!-- close div main content -->
    <?php include_once('../components/close-main-content.php') ?>
    
    <script src="../assets/js/bootstrap.js"></script>
</body>

</html>