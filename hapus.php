<?php
include 'koneksi.php';
include 'admin-safety.php';

$id = $_GET['id'];

$sql = "SELECT * FROM menu WHERE id = $id";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$file = $row['gambar'];

if (file_exists($file)) {
    if (unlink($file)) {
        echo "File '$file' has been deleted successfully.";
    } else {
        echo "Error: Unable to delete the file.";
    }
} else {
    echo "Error: File does not exist.";
}

$result = mysqli_query($koneksi, "DELETE FROM menu WHERE id='$id'");

header("Location:admin.php");
?>
