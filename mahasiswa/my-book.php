<?php 
session_start();

if (empty($_SESSION['login'])) {
    header('Location: auth/login.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            header('Location: ../admin/home.php');
        break;
        case 'user': 
            $user = $_SESSION['user'];
        break;
    }
}

// koneksi ke databse
require '../config/koneksi.php';
require '../functions.php';

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM pinjam LEFT JOIN buku USING(id_buku)"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$idUser = $user['id_user'];
$dataMhs = getData("SELECT * FROM mahasiswa WHERE id_user = $idUser");

$idMhs = $dataMhs['id_mhs'];
$buku = query("SELECT * FROM pinjam LEFT JOIN buku USING(id_buku) 
                WHERE pinjam.id_mhs = $idMhs LIMIT $awalData, $jumlahDataPerHalaman");

// pengembalian buku
if (isset($_POST['kembalikan'])) {
    $idBuku  = $_POST['id_buku'];
    $idPinjam = $_POST['id_pinjam'];

    $deletePinjam = manipulateData("DELETE FROM pinjam WHERE id_pinjam = $idPinjam");
    $updateBuku = manipulateData("UPDATE buku SET status = 1 WHERE id_buku = $idBuku");

    if ($deletePinjam && $updateBuku > 0) {
        echo '
            <script>
                alert("Berhasil kembalikan buku!");
                window.location.href="my-book.php"
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
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <title>E-Library - Buku saya</title>
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
    <?php $currentPage = 'my-book' ?>
    <?php include('../components/sidebar.php') ?>

    <!-- main content -->
    <?php $head = 'Buku Saya' ?>
    <?php $headline = 'Daftar buku yang saya pinjam' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container" id="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                <!-- open if -->
                <?php if (count($buku) == 0) : ?>
                    <h2 class="text-primary text-center p-3">Belum ada buku yang dipinjam</h2>
                <?php else : ?>
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>No.</th>
                            <th>Judul Buku</th>
                            <th>Genre</th>
                            <th>Pengarang</th>
                            <th>Tanggal peminjaman</th>
                            <th>Aksi</th>
                        </tr>

                        <?php $i = 1; ?>
                        <?php foreach ($buku as $row) : ?>
                        <tr class="show" id="<?= $row["id_pinjam"]; ?>">
                            <td><?= $i; ?></td>
                            <td data-target="judul_buku"><?= $row["judul_buku"]; ?></td>
                            <td data-target="genre"><?= $row["genre"]; ?></td>
                            <td data-target="pengarang"><?= $row["pengarang"]; ?></td>
                            <td data-target="tanggal"><?= $row["tanggal_peminjaman"]; ?></td>
                            <td>
                                <a href="#" data-role="kembalikan" data-id="<?= $row["id_pinjam"] ;?>" id="openBtn">
                                    <i class="far fa-minus-square" style="font-size: 18pt; margin-top: 8px"></i>
                                </a>
                            </td>
                            <!-- untuk ambil id_buku -->
                            <td data-target="id_buku" hidden><?= $row["id_buku"]; ?></td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- pagination -->
        <?php include_once('../components/pagination.php') ?>

        <!-- close if -->
        <?php endif; ?>
    </div>

    <!-- popup kembalikan buku -->
    <?php include_once('../components/popup-kembalikan.php') ?>

    <!-- close div main content -->
    <?php include_once('../components/close-main-content.php') ?>

    <script src="../assets/js/bootstrap.js"></script>
</body>

</html>