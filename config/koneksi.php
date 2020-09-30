<?php 
    $koneksi = mysqli_connect('localhost', 'root', '', 'e-library');

    if (mysqli_connect_error() == true) {
        die('Gagal terhubung ke database');
    } 
?>