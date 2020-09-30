<?php
require('config/koneksi.php');

function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function getData($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function manipulateData($query) {
    global $koneksi;
    return mysqli_query($koneksi, $query);
}

?>