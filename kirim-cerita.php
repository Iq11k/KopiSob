<?php
include 'koneksi.php';
session_start();

$id_akun = $_SESSION['id_user'];
$cerita = $_POST['cerita'];
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y-m-d');

$sql = "INSERT INTO cerita (cerita, id_akun, waktu) VALUES ('$cerita', '$id_akun', '$waktu]')";
mysqli_query($koneksi, $sql);
?>