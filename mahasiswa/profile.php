<?php 
session_start();

if (empty($_SESSION['login'])) {
    header('Location: auth/login.php');
} 

if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
            header('Location: ../admin/dashboard.php');
        break;
        case 'user': 
            $user = $_SESSION['user'];
        break;
    }
}

// koneksi ke databse
require '../config/koneksi.php';
require '../functions.php';

// get data
$idUser = $user['id_user'];
$data = getData("SELECT * FROM mahasiswa WHERE id_user = $idUser");

// update
if (isset($_POST['update'])) {
    $namaLengkap = $_POST['nama_lengkap'];
    $npm = $_POST['npm'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['no_hp'];

    $result = manipulateData("UPDATE mahasiswa SET npm = '$npm', nama_lengkap = '$namaLengkap', 
                alamat = '$alamat', no_hp = '$noHp' WHERE id_user = $idUser");

    if ($result > 0) {
        echo '
            <script>
                alert("Berhasil update profile!");
                window.location.href="profile.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal update profile!");
                window.location.href="profile.php"
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
    <title>E-Library - Profile Saya</title>
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
    <?php $currentPage = 'profile' ?>
    <?php include_once('../components/sidebar.php') ?>

    <!-- main content -->
    <?php $head = 'Profile Saya' ?>
    <?php $headline = 'Data Diri Saya' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container">
        <div class="konten_isi">
            <table class="table-sm">
                <form class="form-text" action="" method="post">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" value="<?= $data['nama_lengkap'] ?>" name="nama_lengkap" autocomplete="off"  style="width: 250px" required></td>
                    </tr>
                    <tr>
                        <td>NPM</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" value="<?= $data['npm'] ?>" name="npm" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" value="<?= $data['alamat'] ?>" name="alamat" autocomplete="off" required></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Nomor HP/Whatsapp</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" value="<?= $data['no_hp'] ?>" name="no_hp" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <center><button class="btn btn-primary btn-block" type="submit" name="update" onclick="return confirm('Apakah data sudah benar?')">Update</button></center>
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