<?php
include 'koneksi.php';
include 'admin-safety.php';

if (isset($_POST['nama_menu'])) {
    $nama = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];


    $lokasi_file = $_FILES['gambar']['tmp_name'];
    $nama_file = $_FILES['gambar']['name'];
    $direktori = "images/menu/" . basename($nama_file);

    $sql = "INSERT INTO menu(nama_menu, harga, kategori, gambar, deskripsi) VALUES('$nama', '$harga','$kategori','$direktori','$deskripsi')";
    $result = mysqli_query($koneksi, $sql);
    move_uploaded_file($lokasi_file, $direktori);

    header("Location: admin.php?status=success");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KopiSob Admin nih bray</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8adfb2aa9f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/KopiSob.png">
</head>

<body class="h-screen flex flex-col items-center justify-center relative">
    <a href="admin.php" class="absolute top-4 left-4">
        <button class="cursor-pointer duration-200 hover:scale-125 active:scale-100" title="Go Back">
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24"
                class="stroke-red-600">
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                    d="M11 6L5 12M5 12L11 18M5 12H19">
                </path>
            </svg>
        </button>
    </a>
    <p class="text-4xl font-bold mb-4">Tambahin Menu <span class="text-[#009D3C]">Kopi<span
                class="text-[#653E00]">Sob</span></span></p>
    <form action="" method="post" name="tambah-menu" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="p-2">Nama Menu</td>
                <td class="p-2"><input type="text" name="nama_menu" class="w-full border" required></td>
            </tr>
            <tr>
                <td class="p-2">Harga</td>
                <td class="p-2"><input type="number" name="harga" class="w-full border" required></td>
            </tr>
            <tr>
                <td class="p-2">Gambar</td>
                <td class="p-2"><img src="images/image-placeholders.png" alt="image preview"
                        class="w-32 border-4 rounded-xl" id="img-preview"><input accept="image/*" type="file"
                        name="gambar" class="w-full border" id="img-input" required></td>
            </tr>
            <tr>
                <td class="p-2">Deskripsi</td>
                <td class="p-2"><textarea name="deskripsi" id="deskripsi" class="w-full h-20 border"></textarea></td>
            </tr>
            <tr>
                <td class="p-2">Kategori</td>
                <td class="p-2"><select name="kategori" id="kategori" class="w-full border" required>
                        <option value="1">Kopi</option>
                        <option value="2">Non Kopi</option>
                        <option value="3">Dessert</option>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="Tambah" value="Tambah"
                        class="bg-[#009D3C] text-white px-4 py-2 rounded hover:bg-[#00702B] cursor-pointer"></td>
            </tr>
        </table>
    </form>
</body>

<script>
    const imgInput = document.getElementById('img-input');
    const imgPreview = document.getElementById('img-preview');
    imgInput.onchange = evt => {
        const [file] = imgInput.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }
</script>