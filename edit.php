<?php
include 'koneksi.php';
include 'admin-safety.php';

$id = $_GET['id'];
$sql = "SELECT menu.id, menu.nama_menu, menu.harga, menu.gambar, menu.deskripsi, kategori.kategori FROM menu JOIN kategori ON menu.kategori = kategori.id WHERE menu.id = $id";
$result = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($result)) {
    $nama = $row['nama_menu'];
    $harga = $row['harga'];
    $gambar = $row['gambar'];
    $kategori = $row['kategori'];
    $deskripsi = $row['deskripsi'];

    $selected_kategori = ($kategori == "Kopi") ? 1 : (($kategori == "Non Kopi") ? 2 : 3);
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $lokasi_file = $_FILES['gambar']['tmp_name'];
    $nama_file = $_FILES['gambar']['name'];
    $direktori = "images/menu/" . basename($nama_file);
    $updated_image = empty($lokasi_file) ? $gambar : $direktori;
    $gambar = $updated_image;

    $sql = "UPDATE menu SET nama_menu = '$nama', harga = '$harga', kategori = '$kategori', gambar = '$updated_image', deskripsi = '$deskripsi' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    
    header("Location: admin.php?edit=success");
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

    <p class="text-4xl font-bold mb-4">Edit Menu <span class="text-[#009D3C]">Kopi<span
                class="text-[#653E00]">Sob</span></span></p>
    <form action="" method="post" name="update" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="p-2">Nama Menu</td>
                <td class="p-2"><input type="text" name="nama_menu" class="w-full border" value="<?php echo $nama ?>"
                        required>
                </td>
            </tr>
            <tr>
                <td class="p-2">Harga</td>
                <td class="p-2"><input type="number" name="harga" class="w-full border" value="<?php echo $harga ?>"
                        required>
                </td>
            </tr>
            <tr>
                <td class="p-2">Gambar</td>
                <td class="p-2"><img src="<?php echo $gambar ?>" alt="image preview" class="w-32 border-4 rounded-xl"
                        id="img-preview"><input accept="image/*" type="file" name="gambar" class="w-full border"
                        id="img-input"></td>
            </tr>
            <tr>
                <td class="p-2">Deskripsi</td>
                <td class="p-2"><textarea name="deskripsi" id="deskripsi" class="w-full h-20 border"><?php echo $deskripsi ?></textarea></td>
            </tr>
            <tr>
                <td class="p-2">Kategori</td>
                <td class="p-2"><select name="kategori" id="kategori" class="w-full border" required>
                        <option value="1" <?php echo ($selected_kategori == "1") ? "selected" : ""; ?>>Kopi</option>
                        <option value="2" <?php echo ($selected_kategori == "2") ? "selected" : ""; ?>>Non Kopi</option>
                        <option value="3" <?php echo ($selected_kategori == "3") ? "selected" : ""; ?>>Dessert</option>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="update" value="update"
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

    setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }
    }, 2000);
</script>