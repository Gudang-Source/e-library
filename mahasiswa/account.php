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
$idUser = $user['id_user'];

// update
if (isset($_POST['update'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $repeatNewPassword = $_POST['repeat_new_password'];

    // cek password lama
    if (!password_verify($oldPassword, $user['password'])) {
        echo '
            <script>
                alert("Password lama yang anda masukkan salah!");
                window.location.href="account.php"
            </script>
        ';
        return false;
    } 
    
    // cek konfirmasi password
    if ($newPassword != $repeatNewPassword) {
        echo '
            <script>
                alert("Konfirmasi password tidak sesuai!");
                window.location.href="account.php"
            </script>
        ';
        return false;
    } 

    $passwordUpdate = password_hash($newPassword, PASSWORD_DEFAULT);
    $result = manipulateData("UPDATE users SET password = '$passwordUpdate' WHERE id_user = $idUser");

    if ($result > 0) {
        echo '
            <script>
                alert("Berhasil ganti password!");
                window.location.href="account.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Gagal ganti password!");
                window.location.href="account.php"
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
    <title>E-Library - Pengaturan Akun</title>
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
    <?php $currentPage = 'account' ?>
    <?php include_once('../components/sidebar.php') ?>

    <!-- main content -->
    <?php $head = 'Pengaturan Akun' ?>
    <?php $headline = 'Akun Saya' ?>
    <?php include_once('../components/main-content.php') ?>

    <div class="container">
        <div class="konten_isi">
            <table class="table-sm">
                <form class="form-text" action="" method="post">
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input class="form-control" style="width: 250px" type="text" value="<?= $user['username'] ?>" name="username" autocomplete="off"
                                disabled></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input class="form-control" type="text" value="<?= $user['email'] ?>" name="npm" autocomplete="off" disabled></td>
                    </tr>
                    <tr>
                        <td>Password lama</td>
                        <td>:</td>
                        <td><input class="form-control" type="password" name="old_password" autocomplete="off" required></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Password baru</td>
                        <td>:</td>
                        <td><input class="form-control" type="password" name="new_password" autocomplete="off" required></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Ulangi password baru</td>
                        <td>:</td>
                        <td><input class="form-control" type="password" name="repeat_new_password" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <center><button class="btn btn-primary btn-block" type="submit" name="update" onclick="return confirm('Yakin ingin mengganti password?')">Ganti Password</button></center>
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