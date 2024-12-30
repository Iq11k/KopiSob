<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
}
$id_akun = $_SESSION['id_user'];

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
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
            <p class='text-xs font-semibold'>Pesananmu berhasil di checkout</p>
        </div>";
    }
}
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
    <a href="index.php#menu" class="absolute top-2 lg:top-4 left-4">
        <button class="cursor-pointer duration-200 hover:scale-125 active:scale-100" title="Go Back">
            <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24"
                class="stroke-red-600">
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                    d="M11 6L5 12M5 12L11 18M5 12H19">
                </path>
            </svg>
        </button>
    </a>
    <?php
    if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 1) {
        ?>
        <div class="konfirmasi h-screen w-screen fixed top-0 left-0">
            <div class="gelap h-full w-full absolute bg-black opacity-50"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center bg-white w-72 h-auto pt-5 pb-7 border border-gray-200 rounded-lg space-y-8">
                <a href="keranjang.php"><i class="fa-regular fa-circle-xmark absolute top-2 right-2 text-red-500 text-2xl hover:scale-125 duration-300"></i></a>
                <section class="flex flex-col text-center space-y-1">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                        Konfirmasi Pesanan
                    </h2>
                    <p class="text-slate-500 text-sm">kamu akan memesan</p>
                </section>
                <section class="space-y-2 h-[10rem] overflow-y-auto">
                    <?php
                    $total_harga = 0;
                    $sql = "SELECT menu.nama_menu, menu.deskripsi, menu.gambar, keranjang.jumlah, menu.harga, keranjang.id, keranjang.id_pesanan FROM keranjang 
                    JOIN menu ON keranjang.id_menu = menu.id
                    JOIN pesanan ON keranjang.id_pesanan = pesanan.id WHERE pesanan.id_akun = $id_akun AND keranjang.status = 0";
                    $result = mysqli_query($koneksi, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $id_pesanan = $row['id_pesanan'];
                            echo "<div class='flex gap-2'>
                                <svg fill='currentColor' viewBox='0 0 20 20' class='w-5 h-5 text-[#009D3C]'
                                    xmlns='http://www.w3.org/2000/svg'>
                                    <path clip-rule='evenodd'
                                        d='M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z'
                                        fill-rule='evenodd'></path>
                                </svg>
                                <span class='text-slate-500 text-sm'>" . $row['nama_menu'] . "</span>
                            </div>";
                            $total_harga += $row['harga'] * $row['jumlah'];
                        }
                    } else {
                        header('Location: keranjang.php');
                    }
                    $ppn = ($total_harga * 11) / 100;
                    $total_bayar = $total_harga + $ppn;
                    ?>
                </section>
                <section class="flex w-full flex-col space-y-2 px-9 text-center">
                    <a href="checkout.php?id_pesanan=<?php echo $id_pesanan ?>&total=<?php echo $total_bayar ?>&cetak=0"
                        class="py-3 font-medium tracking-wide capitalize transition-colors duration-300 transform bg-gray-100 rounded-md hover:bg-gray-200 text-sm text-gray-600">
                        Konfirmasi tanpa cetak struk
                    </a>
                    <a href="checkout.php?id_pesanan=<?php echo $id_pesanan ?>&total=<?php echo $total_bayar ?>&cetak=1&download=1" id="cetak_pdf"
                        class="py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-[#009D3C] rounded-md hover:bg-[#00702B]">
                        Download Struk
                    </a>
                    <a href="checkout.php?id_pesanan=<?php echo $id_pesanan ?>&total=<?php echo $total_bayar ?>&cetak=1" id="cetak_pdf"
                        class="py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-[#009D3C] rounded-md hover:bg-[#00702B]">
                        Cetak Struk
                    </a>
                </section>
            </div>
        </div>
        <?php
    }
    ?>


    <p class="text-xl lg:text-4xl font-bold mb-4 text-center">Pesanan Sobat <span class="text-[#009D3C]">Kopi<span
                class="text-[#653E00]">Sob</span></span></p>
    <div class="order-container w-full h-[30rem] py-4 px-4 lg:px-0 overflow-auto flex flex-col items-center gap-4">
        <?php
        $total_harga = 0;
        $id_pesanan = '';
        $sql = "SELECT menu.nama_menu, menu.deskripsi, menu.gambar, keranjang.jumlah, menu.harga, keranjang.id, keranjang.id_pesanan FROM keranjang 
        JOIN menu ON keranjang.id_menu = menu.id
        JOIN pesanan ON keranjang.id_pesanan = pesanan.id WHERE pesanan.id_akun = $id_akun AND keranjang.status = 0";
        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id_pesanan = $row['id_pesanan'];
                echo "<div class='card-order w-full lg:w-1/2 flex flex-col lg:flex-row h-fit justify-between shadow-xl border-4 rounded-xl p-4'>
                <div class='left-container flex gap-4'>
                <img src=" . $row['gambar'] . " alt='' class='w-32 h-32 object-cover'>
                <div class='text flex flex-col justify-between py-4'>
                                <div>
                                <p>" . $row['nama_menu'] . "</p>
                                <p>" . $row['deskripsi'] . "</p>
                                </div>
                                <p>Rp." . number_format((float) $row['harga'], 0, ",", ".") . "</p>
                                </div>
                                </div>
                                <div class='right-container flex items-center'>
                                <div class='quantity-counter h-10 flex'>
                                <button id='counter-decrement'
                                    class='decrement w-10 text-center py-1 bg-[#009D3C] hover:bg-[#00702B] text-white font-bold rounded-md' data-id='" . $row['id'] . "'>-</button>
                                
                                <input id='counter-value'
                                    class='value w-20 mx-4 border border-gray-400 rounded-md text-center py-1 outline-none'
                                    type='text'
                                    data-id='" . $row['id'] . "'
                                    oninput='numberFormat(this)' value='" . $row['jumlah'] . "'>
                                <button id='counter-increment'

                                class='increment w-10 text-center py-1 bg-[#009D3C] hover:bg-[#00702B] text-white font-bold rounded-md' data-id='" . $row['id'] . "'>+</button>
                                <button id='hapus'
                                class='hapus text-center py-1 px-4 ml-4 bg-red-600 hover:bg-red-800 text-white font-bold rounded-md' data-id='" . $row['id'] . "'><i class='fa-solid fa-trash-can'></i></button>
                                </div>
                                </div>
                                </div>";
                $total_harga += $row['harga'] * $row['jumlah'];
            }
        } else {
            echo "<p class='text-xl font-bold mb-4 text-center'>Kamu belum mesen apa-apa sob</p>";
        }
        ?>
    </div>
    <div class="flex flex-col gap-4 w-full lg:w-1/2 mt-4 px-4 lg:px-0 lg:pr-4">
        <div class="rincian-harga">
            <p class="text-xl font-bold">Rincian Harga</p>
            <div class="flex justify-between">
                <p>Total Harga</p>
                <p><?php echo ("Rp. " . number_format((float) $total_harga, 0, ",", ".")) ?></p>
            </div>
            <div class="flex justify-between">
                <p>Ongkos Kirim</p>
                <p>Rp. 0</p>
            </div>
            <div class="flex justify-between">
                <p>PPN(11%)</p>
                <p><?php echo ("Rp. " . number_format((float) $ppn = ($total_harga * 11) / 100, 0, ",", ".")) ?></p>
            </div>
            <div class="flex justify-between">
                <p>Total Bayar</p>
                <p><?php echo ("Rp. " . number_format((float) $total_harga + $ppn, 0, ",", ".")) ?></p>
            </div>
        </div>
        <div class="button-container flex justify-end gap-2">
            <a href="index.php#menu"
                class="bg-[#009D3C] text-white hover:bg-[#00702B] focus:ring-4 focus:ring-bg-[#00702B] font-medium rounded-lg text-sm px-5 py-2.5 mb-2 ">Lanjut
                Belanja</a>
            <?php
            if ($id_pesanan != '') {
                $total_bayar = $total_harga + $ppn;
                echo "<a href='keranjang.php?konfirmasi=1'
                class='bg-[#009D3C] text-white hover:bg-[#00702B] focus:ring-4 focus:ring-bg-[#00702B] font-medium rounded-lg text-sm px-5 py-2.5 mb-2 '>Checkout</a>";
            } else {
                echo "<a class='bg-gray-400 text-white font-medium rounded-lg text-sm px-5 py-2.5 mb-2 '>Checkout</a>";
            }
            ?>

        </div>
    </div>
    <script src="js/keranjang.js"></script>
</body>

</html>