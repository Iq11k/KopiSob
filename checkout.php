<?php
include 'koneksi.php';
session_start();
$id_akun = $_SESSION['id_user'];
$id_pesanan = $_GET['id_pesanan'];
$total_harga = $_GET['total'];
date_default_timezone_set('Asia/Jakarta');
$current_time = date('Y-m-d H:i:s');

$sql = "UPDATE pesanan SET waktu_pemesanan = '$current_time', total_harga = '$total_harga', status = 1 WHERE id_akun = '$id_akun' AND id = '$id_pesanan'";
mysqli_query($koneksi, $sql);

$sql = "DELETE FROM keranjang WHERE id_pesanan = '$id_pesanan' AND jumlah = 0";
mysqli_query($koneksi, $sql);

$sql = "UPDATE keranjang SET status = 1 WHERE id_pesanan = '$id_pesanan'";
mysqli_query($koneksi, $sql);

if ($_GET['cetak'] == 1) {
    if ($_GET['download'] == 1) {
        header('Location: cetak-struk.php?id_pesanan=' . $id_pesanan . '&download=1');
    } else {
        header('Location: cetak-struk.php?id_pesanan=' . $id_pesanan);
    }
} else {
    header('Location: keranjang.php?status=success');
}
?>