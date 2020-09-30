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
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <title>E-Library (admin) - Data Buku</title>
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
    <?php $currentPage = 'home' ?>
    <?php include_once('../components/sidebar-admin.php') ?>

    <!-- main content -->
    <?php $head = 'Data Buku' ?>
    <?php $headline = 'Data Buku Perpustakaan' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Judul Buku</th>
                            <th>Genre</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        <?php $i = 1; ?>
                        <?php foreach ($buku as $row) : ?>
                        <tr class="show" id="<?= $row["id_buku"]; ?>">
                            <td><?= $i; ?></td>
                            <td data-target="judul_buku"><?= $row["judul_buku"]; ?></td>
                            <td data-target="genre"><?= $row["genre"]; ?></td>
                            <td data-target="pengarang"><?= $row["pengarang"]; ?></td>
                            <td data-target="penerbit"><?= $row["penerbit"]; ?></td>
                            <td data-target="tahun_terbit"><?= $row["tahun_terbit"]; ?></td>
                            <td data-target="status"><?php 
                                if($row['status'] == 1) echo 'Tersedia' ;
                                else if ($row['status'] == 0) echo 'Dipinjam'
                            ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_buku'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="hapus.php?id=<?= $row['id_buku'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin hapus buku?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- pagination -->
        <?php include_once('../components/pagination.php') ?>
    </div>

    <!-- close div main content -->
    <?php include_once('../components/close-main-content.php') ?>
    
    <script src="../assets/js/bootstrap.js"></script>
</body>

</html>