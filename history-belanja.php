<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
}
$id_akun = $_SESSION['id_user'];
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KopiSob!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/8adfb2aa9f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/KopiSob.png">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
</head>

<body class="py-4 flex flex-col items-center">
    <a href="index.php#menu" class="absolute top-2 lg:top-4 left-2 lg:left-4">
        <button class="cursor-pointer duration-200 hover:scale-125 lg:active:scale-100 active:scale-75 lg:scale-100 scale-50" title="Go Back">
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24"
                class="stroke-red-600">
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                    d="M11 6L5 12M5 12L11 18M5 12H19">
                </path>
            </svg>
        </button>
    </a>
    <p class="text-xl lg:text-4xl font-bold mb-4 text-center">History Belanjamu Sobat <span
            class="text-[#009D3C]">Kopi<span class="text-[#653E00]">Sob</span></span></p>
    <div class="order-container h-[40rem] w-full py-4 px-2 lg:px-0 overflow-auto flex flex-col items-center gap-4">
        <?php
        $total_harga = 0;
        $id_pesanan = '';
        $sql = "SELECT * FROM pesanan WHERE id_akun = $id_akun AND status = 1";
        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo " <div class='order-item w-full flex flex-col items-center'>
                <div class='card-order w-full lg:w-1/2 flex justify-between shadow-md border-4 border-[#009D3C] rounded-xl p-4 z-10'>
                        <div class='left-container flex flex-col'>
                            <p class='text-lg lg:text-xl font-bold'>Pesanan " . $row['waktu_pemesanan'] . "</p>
                            <p class='text-md lg:text-lg font-semibold'>Rp. " . number_format((float) $row['total_harga'], 0, ",", ".") . "</p>
                        </div>
                        <div class='right-container flex items-center'>
                            <a href='cetak-struk.php?id_pesanan=" . $row['id'] . "' target='_blank' class='bg-[#009D3C] hover:bg-[#00702B] text-white px-4 py-2 rounded-xl'>Cetak Struk</a>
                        </div>
                    </div>";
                $sql = "SELECT menu.nama_menu, menu.deskripsi, menu.gambar, keranjang.jumlah, menu.harga, keranjang.id, keranjang.id_pesanan FROM keranjang 
                JOIN menu ON keranjang.id_menu = menu.id
                JOIN pesanan ON keranjang.id_pesanan = pesanan.id WHERE pesanan.id = " . $row['id'];
                $detail = mysqli_query($koneksi, $sql);
                echo "<div class='order-detail-container w-full lg:w-1/2 flex flex-col items-center gap-4 bg-white border-4 -mt-2 rounded-b-xl p-4 shadow-lg'>";
                while ($row = mysqli_fetch_array($detail)) {
                    $total_harga += $row['harga'] * $row['jumlah'];
                    $id_pesanan = $row['id_pesanan'];
                    echo "<div class='item-order w-full flex justify-between items-center p-4'>
                            <div class='left-container flex gap-4'>
                                <img src='" . $row['gambar'] . "' alt='menu' class='w-20 h-20 object-cover rounded-xl'>
                                <div class='flex flex-col'>
                                    <p class='text-xl font-bold'>" . $row['nama_menu'] . "</p>
                                    <p class='text-lg font-semibold'>Rp. " . number_format((float) $row['harga'], 0, ",", ".") . "</p>
                                    <p class='text-lg font-semibold'>Jumlah: " . $row['jumlah'] . "</p>
                                </div>
                            </div>
                            <div class='right-container flex gap-4'>
                                <div class='flex flex-col items-center'>
                                    <p class='text-lg font-semibold'>Jumlah</p>
                                    <p class='text-lg font-semibold'>" . $row['jumlah'] . "</p>
                                </div>
                            </div>
                        </div>";
                }
                echo " </div>
                </div>";
            }
        } else {
            echo "<p class='text-xl font-bold mb-4 text-center'>Kamu belum pernah mesen apa-apa sob</p>";
        }
        ?>
    </div>
    <script src="js/keranjang.js"></script>
</body>

</html>