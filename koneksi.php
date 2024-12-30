<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "kopisob";


$koneksi = mysqli_connect($host, $user, $password, $db) or die("<b>Gagal Konek: </b>".mysqli_error($koneksi));

?>