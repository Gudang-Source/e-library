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

    if (isset($_POST['login'])) {
        $userEmail = trim(htmlspecialchars($_POST['user-email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $queryCek = "SELECT * FROM users WHERE username = '$userEmail' OR email = '$userEmail'";
        $result = mysqli_query($koneksi, $queryCek);
        
        if ($userEmail == "" || $password == "") {
            echo '
                <script>
                    alert("isi username/password dengan benar!");
                    window.location.href="login.php"
                </script>
            ';
            return false;
        }

        if (mysqli_num_rows($result) > 0) {
            $hasil = mysqli_fetch_assoc($result);

            if (password_verify($password, $hasil['password'])) {
                if ($hasil['level'] == 'admin') {
                    $_SESSION['user'] = $hasil;
                    $_SESSION['login'] = true;
                    $_SESSION['level'] = 'admin';
                    header('Location: ../admin/home.php');
                } else if ($hasil['level'] == 'user') {
                    $_SESSION['user'] = $hasil;
                    $_SESSION['login'] = true;
                    $_SESSION['level'] = 'user';
                    header('Location: ../mahasiswa/home.php');
                }
            } else {
                echo '
                    <script>
                        alert("Username / password salah!");
                        window.location.href="login.php"
                    </script>
                ';
            return false;
            }
        } else {
            echo '
                <script>
                    alert("Username / password salah!");
                    window.location.href="login.php"
                </script>
            ';
            return false;
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
    <title>E-Library - Login</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-lg-5 area">
            <h1 class="text-center" style="color: #545a5a;">E-Library</h1>
            <div class="jumbotron box">
                <h2 class="text-center text-foot" style="color: #545a5a;">Login Area</h2> <br>
                
                <form action="" method="post">
                    
                    <div class="input-group form-group">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-right-0"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="user-email" class="form-control border-left-0" placeholder="Username/email" required>
                    </div>
                    
                    <div class="input-group form-group">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent border-right-0"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control border-left-0" placeholder="Password" required>
                    </div>

                    <p>Belum mempunyai akun? <a href="register.php">klik disini</a></p>
                    <button type="submit" name="login" class="btn btn-primary form-control">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>