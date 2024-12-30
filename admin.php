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

<?php
include 'koneksi.php';
include 'admin-safety.php';
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo "<div
            id='alert-message'
            role='alert'
            class='absolute top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border-l-4 border-green-500 text-green-900 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-green-200 transform hover:scale-105'>
            <svg
                stroke='currentColor'
                viewBox='0 0 24 24'
                fill='none'
                class='h-5 w-5 flex-shrink-0 mr-2 text-green-600'
                xmlns='http://www.w3.org/2000/svg'>
                <path
                    d='M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                    stroke-width='2'
                    stroke-linejoin='round'
                    stroke-linecap='round'>
                </path>
            </svg>
            <p class='text-xs font-semibold'>Data Berhasil Ditambahkan!</p>
        </div>";
}
if (isset($_GET['edit']) && $_GET['edit'] == 'success') {
    echo "<div
            id='alert-message'
            role='alert'
            class='absolute top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border-l-4 border-green-500  text-green-900 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-green-200 transform hover:scale-105'>
            <svg
            stroke='currentColor'
            viewBox='0 0 24 24'
            fill='none'
            class='h-5 w-5 flex-shrink-0 mr-2 text-green-600'
            xmlns='http://www.w3.org/2000/svg'
            >
            <path
                d='M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                stroke-width='2'
                stroke-linejoin='round'
                stroke-linecap='round'
            ></path>
            </svg>
            <p class='text-xs font-semibold'>Data Berhasil Di Update!</p>
        </div>";
}
?>

<body>
    <div class="main flex flex-col">
        <div class="header flex justify-between items-center px-10 py-4 sticky top-0 bg-white shadow-xl">
            <p class="text-xl lg:text-4xl font-bold">Adminnya <span class="text-[#009D3C]">Kopi<span
                        class="text-[#653E00]">Sob</span></span></p>
            <div class="button flex flex-col lg:flex-row lg:gap-4">
                <a href="tambah-menu.php"
                    class="text-sm lg-text-lg bg-[#009D3C] text-white px-2 lg:px-4 py-2 rounded hover:bg-[#00702B] cursor-pointer">Tambah
                    Menu</a>
                <a href="index.php"
                    class="text-sm lg-text-lg bg-[#653E00] text-white px-2 lg:px-4 py-2 rounded hover:bg-[#422900] cursor-pointer">Halaman
                    Utama</a>
            </div>

        </div>
        <div class="table-container px-4 lg:px-10 flex flex-col py-10 w-full overflow-x-auto">
            <table class="text-center text-sm">
                <thead class="text-sm lg:text-lg text-gray-700 bg-[#60FF9D]">
                    <tr class="border-2 border-[#60FF9D]">
                        <th class="border-2 border-[#60FF9D]">ID</th>
                        <th class="border-2 border-[#60FF9D]">Nama</th>
                        <th class="border-2 border-[#60FF9D]">Gambar</th>
                        <th class="border-2 border-[#60FF9D]">Harga</th>
                        <th class="border-2 border-[#60FF9D]">Deskripsi</th>
                        <th class="border-2 border-[#60FF9D]">Kategori</th>
                        <th class="border-2 border-[#60FF9D]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'SELECT menu.id, menu.nama_menu, menu.harga, menu.gambar, menu.deskripsi, kategori.kategori FROM menu JOIN kategori ON menu.kategori = kategori.id ORDER BY kategori.kategori ASC';
                    $result = mysqli_query($koneksi, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr class='odd:bg-[#CEFFE1] even:bg-white border-2 border-[#60FF9D]'>";
                            echo "<td class='border-2 border-[#60FF9D] px-2'>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td class='border-2 border-[#60FF9D] px-2'>" . htmlspecialchars($row['nama_menu']) . "</td>";
                            echo "<td class='place-items-center px-2'><img src='" . htmlspecialchars($row['gambar']) . "' class='w-10 h-10 lg:w-36 lg:h-36 object-cover'></td>";
                            echo "<td class='border-2 border-[#60FF9D] px-2'>Rp " . number_format((float) $row['harga'], 0, ",", ".") . "</td>";
                            echo "<td class='border-2 border-[#60FF9D] px-2'>" . htmlspecialchars($row['deskripsi']) . "</td>";
                            echo "<td class='border-2 border-[#60FF9D] px-2'>" . htmlspecialchars($row['kategori']) . "</td>";
                            $id = $row['id'];
                            echo "<td class='flex flex-row py-5 lg:py-10 gap-2 lg:gap-4 justify-center items-center h-full '>
                                <a href='edit.php?id=$id' class='bg-blue-600 text-white px-2 lg:px-4 py-2 rounded hover:bg-blue-700 cursor-pointer self-center'>Edit</a>  
                                <a href='hapus.php?id=$id' class='bg-red-600 text-white px-2 lg:px-4 py-2 rounded hover:bg-red-700 cursor-pointer self-center'>Hapus</a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr class='bg-[#CEFFE1]'> 
                                <td colspan='6' class='text-center p-4'>Tidak Ada Data Menu</td> 
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }, 2000);
    </script>
</body>

</html>