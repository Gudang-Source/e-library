<?php
    session_start();
    require '../config/koneksi.php';
    
    if (isset($_SESSION['login'])) {
        switch ($_SESSION['level']) {
            case 'admin' : 
                header('Location: ../admin/home.php');
            break;
            case 'user' : 
                header('Location: ../mahasiswa/home.php');
            break;
        }
    } 
    
    if (isset($_POST['register'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['password-confirm']));

        if ($email == "" || $username == "" || $password == "" || $passwordConfirm == "") {
            echo '
                <script>
                    alert("Harap isi data yang benar!");
                    window.location.href="register.php"
                </script>
            ';
            return false;
        }

        $queryCek = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($koneksi, $queryCek);

        // cek username / email
        if (mysqli_num_rows($result) > 0) {
            echo '
                <script>
                    alert("Username / email telah digunakan!");
                    window.location.href="register.php"
                </script>
            ';
            return false;
        }

        // cek konfirmasi password
        if ($password != $passwordConfirm) {
            echo '
                <script>
                    alert("Konfirmasi password tidak sesuai!");
                    window.location.href="register.php"
                </script>
            ';
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $queryReg = "INSERT INTO users(email, username, password) VALUES ('$email', '$username', '$password')";
        $resultReg = mysqli_query($koneksi, $queryReg);

        // ambil data user
        $queryUser = "SELECT * FROM users WHERE username = '$username'";
        $resultUser = mysqli_query($koneksi, $queryUser);
        $data = mysqli_fetch_assoc($resultUser);
        $idUser = $data['id_user'];
        
        // insert ke profile
        $queryProfile = "INSERT INTO mahasiswa (id_user) VALUES ($idUser)";
        $resultProfile = mysqli_query($koneksi, $queryProfile);

        if ($resultReg == true && $resultProfile == true) {
            echo '
                <script>
                    alert("Registrasi berhasil!");
                    window.location.href="login.php"
                </script>
            ';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="../assets/css/users.css">
    <title>E-Library - Registrasi</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-lg-5 area2">
            <h1 class="text-center" style="color: #545a5a;">E-Library</h1>
            <div class="jumbotron box">
                <h2 class="text-center text-foot" style="color: #545a5a;">Registrasi</h2> <br>
                <form action="" method="post">
                    
                    <div class="input-group form-group">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control border-left-0" placeholder="Username" required>
                    </div>
                    
                    <div class="input-group form-group">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-right-0"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control border-left-0" placeholder="Email" required>
                    </div>
                    
                    <div class="input-group form-group">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-right-0"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control border-left-0" placeholder="Password" required>
                    </div>
                    
                    <div class="input-group form-group">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-right-0"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password-confirm" class="form-control border-left-0" placeholder="Confirm Password" required>
                    </div>

                    <p>Sudah mempunyai akun? <a href="login.php">klik disini</a></p>
                    <button type="submit" name="register" class="btn btn-primary form-control">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>