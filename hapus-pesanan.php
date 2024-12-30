<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM keranjang WHERE id = $id";
    mysqli_query($koneksi, $sql);
}
?>