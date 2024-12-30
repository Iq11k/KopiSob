<?php
include 'koneksi.php';
session_start();
if (isset($_GET['id'])) {
    $id_user = $_SESSION['id_user'];
    $id_menu = $_GET['id'];
    $jumlah = 1;
    $sql = "SELECT * FROM pesanan WHERE id_akun = $id_user AND status = 0";
    $result = mysqli_query($koneksi, $sql);
    $pesanan = mysqli_fetch_array($result);
    if ($pesanan){
        $id_pesanan = $pesanan['id'];
    } else {
        $sql = "INSERT INTO pesanan(id_akun) VALUES ('$id_user')";
        $result = mysqli_query($koneksi, $sql);
        $id_pesanan = mysqli_insert_id($koneksi);
    }

    $sql = "SELECT * FROM keranjang WHERE id_pesanan = $id_pesanan AND id_menu = $id_menu";
    $result = mysqli_query($koneksi, $sql);
    $pesanan = mysqli_fetch_array($result);

    if ($pesanan) {
        $jumlah = $pesanan['jumlah'] + 1;
        $sql = "UPDATE keranjang SET jumlah = '$jumlah' WHERE id_pesanan = '$id_pesanan' AND id_menu ='$id_menu'";
        $result = mysqli_query($koneksi, $sql);
    } else {
        $sql = "INSERT INTO keranjang(id_menu, id_pesanan, jumlah) VALUES ('$id_menu','$id_pesanan','$jumlah')";
        $result = mysqli_query($koneksi, $sql);
    }
}
?>