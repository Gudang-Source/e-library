<?php
require '../config/koneksi.php';
require '../functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapusBuku = manipulateData("DELETE FROM buku WHERE id_buku = $id");
    if ($hapusBuku > 0) {
        echo '
            <script>
                alert("Berhasil menghapus buku!");
                window.location.href="home.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Berhasil menghapus buku!");
                window.location.href="home.php"
            </script>
        ';
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