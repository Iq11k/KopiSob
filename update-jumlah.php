<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jumlah = $_POST['jumlah'];

    $sql = "UPDATE keranjang SET jumlah = $jumlah WHERE id = $id";
    mysqli_query($koneksi, $sql);
}
?>