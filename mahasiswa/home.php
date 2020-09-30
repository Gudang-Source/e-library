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

// date
$month = date('m');
$day = date('d');
$year = date('Y');
$today = $year . '-' . $month . '-' . $day;

$idUser = $user['id_user'];

// pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");

// get data mahasiswa
$dataMhs = getData("SELECT * FROM mahasiswa WHERE id_user = $idUser");

if (isset($_POST['pinjam'])) {
    $npm = $_POST['npm'];
    $idBuku = $_POST['id_buku'];
    $tanggal = $_POST['tanggal'];
    $judulBuku = $_POST['judul_buku'];

    // cek sudah isi profile / belum
    if ($dataMhs['npm'] == '') {
        echo '
            <script>
                alert("Lengkapi profile terlebih dahulu!");
                window.location.href="profile.php"
            </script>
        ';
        return false;
    }

    // cek npm
    if ($npm !== $dataMhs['npm']) {
        echo '
            <script>
                alert("NPM anda tidak sesuai!");
                window.location.href="home.php"
            </script>
        ';
        return false;
    }

    // cek status buku
    $dataBuku = getData("SELECT * FROM buku WHERE id_buku = $idBuku");

    if ($dataBuku['status'] == 0) {
        echo '
            <script>
                alert("Maaf buku sedang dipinjam");
                window.location.href="home.php"
            </script>
        ';
        return false;
    }

    $idMhs = $dataMhs['id_mhs'];
    $resultPinjam = manipulateData("INSERT INTO pinjam (id_buku, id_mhs, tanggal_peminjaman) 
                    VALUES ($idBuku, $idMhs, '$tanggal')");

    if ($resultPinjam > 0) {
        manipulateData("UPDATE buku SET status = 0 WHERE id_buku = $idBuku");
        echo '
            <script>
                alert("Berhasil pinjam buku!");
                window.location.href="my-book.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal pinjam buku!");
                window.location.href="home.php"
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
    <title>E-Library - Data Buku</title>
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
    <?php include_once('../components/sidebar.php') ?>

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
                                <a href="#" data-id="<?= $row["id_buku"] ;?>" data-role="pinjam" id="openBtn">
                                    <i class="far fa-plus-square" style="font-size: 18pt; margin-top: 8px"></i>
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

    <!-- popup pinjam buku -->
    <?php include_once('../components/popup-pinjam.php') ?>

    <!-- close div main content -->
    <?php include_once('../components/close-main-content.php') ?>
    
    <script src="../assets/js/bootstrap.js"></script>
</body>

</html>