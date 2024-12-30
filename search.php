<?php
include 'koneksi.php';

$query = $_GET['q'];
$results = [];

if ($query) {
    $list_kategori = ['Kopi', 'Non kopi', 'Dessert'];
    foreach ($list_kategori as $k) {
        $sql = "SELECT menu.id, menu.nama_menu, menu.harga, menu.gambar, menu.deskripsi, kategori.kategori FROM menu JOIN kategori ON menu.kategori = kategori.id WHERE (menu.nama_menu LIKE '%$query%') AND kategori.kategori = '$k' ORDER BY menu.kategori";
        $result = mysqli_query($koneksi, $sql);
        echo "
            <div class='text-header relative'>
                            <p class='text-6xl lg:text-8xl text-black font-bold italic mb-4 text-center opacity-20 whitespace-nowrap overflow-hidden' style='-webkit-text-fill-color:transparent; -webkit-text-stroke-width:2px;' id='bg-text-header'>$k $k $k $k $k $k $k $k $k $k $k $k</p>
                            <p class='absolute uppercase left-1/2 top-1/2 transform -translate-x-1/2 transform -translate-y-1/2 text-4xl lg:text-7xl text-black font-bold mb-4 text-center'>$k</p>
                        </div>
            <div class='item-container flex flex-wrap justify-center gap-20'>";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='group w-32 lg:w-52 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl' data-aos='fade-up'>
                            <a href='' class='relative tambah-keranjang' data-id='" . $row['id'] . "' data-nama='" . $row['nama_menu'] . "'>
                                <img src='" . $row['gambar'] . "'
                                    alt='" . $row['nama_menu'] . "' class='h-40 lg:h-64 w-32 lg:w-52 object-cover rounded-t-xl' />
                                <div class='px-4 py-3 w-32 lg:w-52'>
                                    <p class='text-lg font-bold text-black truncate block'>" . $row['nama_menu'] . "</p>
                                    <div class='flex items-center justify-between'>
                                        <p class='text-lg font-semibold text-black cursor-auto my-3'>Rp." . number_format((float) $row['harga'], 0, ",", ".") . "</p>
                                        <div class='ml-auto'><i class='fa-solid fa-cart-plus hidden lg:block'></i></div>
                                    </div>
                                </div>
                                <div class='absolute h-40 lg:h-64 w-32 lg:w-52 p-4 text-center grid place-content-center bg-white top-0 opacity-0 duration-500 group-hover:opacity-80 rounded-t-lg ease-in-out'>
                                <p class='text-lg font-light text-black block'>" . $row['deskripsi'] . "</p>
                                </div>
                            </a>
                        </div>";
            }
            echo "</div>";
        } else {
            echo "<p class='text-2xl text-center'>Tidak ada hasil</p>";
        }
    }
} else {
    $list_kategori = ['Kopi', 'Non kopi', 'Dessert'];
    foreach ($list_kategori as $k) {
        $sql = "SELECT menu.id, menu.nama_menu, menu.harga, menu.gambar, menu.deskripsi, kategori.kategori FROM menu JOIN kategori ON menu.kategori = kategori.id WHERE kategori.kategori = '$k' ORDER BY menu.kategori";
        $result = mysqli_query($koneksi, $sql);
        echo "
            <div class='text-header relative'>
                            <p class='text-6xl lg:text-8xl text-black font-bold italic mb-4 text-center opacity-20 whitespace-nowrap overflow-hidden' style='-webkit-text-fill-color:transparent; -webkit-text-stroke-width:2px;' id='bg-text-header'>$k $k $k $k $k $k $k $k $k $k $k $k</p>
                            <p class='absolute uppercase left-1/2 top-1/2 transform -translate-x-1/2 transform -translate-y-1/2 text-4xl lg:text-7xl text-black font-bold mb-4 text-center'>$k</p>
                        </div>
            <div class='item-container flex flex-wrap justify-center gap-20'>";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='group w-32 lg:w-52 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl' data-aos='fade-up'>
                            <a href='' class='relative tambah-keranjang' data-id='" . $row['id'] . "' data-nama='" . $row['nama_menu'] . "'>
                                <img src='" . $row['gambar'] . "'
                                    alt='" . $row['nama_menu'] . "' class='h-40 lg:h-64 w-32 lg:w-52 object-cover rounded-t-xl' />
                                <div class='px-4 py-3 w-32 lg:w-52'>
                                    <p class='text-lg font-bold text-black truncate block'>" . $row['nama_menu'] . "</p>
                                    <div class='flex items-center justify-between'>
                                        <p class='text-lg font-semibold text-black cursor-auto my-3'>Rp." . number_format((float) $row['harga'], 0, ",", ".") . "</p>
                                        <div class='ml-auto'><i class='fa-solid fa-cart-plus hidden lg:block'></i></div>
                                    </div>
                                </div>
                                <div class='absolute h-40 lg:h-64 w-32 lg:w-52 p-4 text-center grid place-content-center bg-white top-0 opacity-0 duration-500 group-hover:opacity-80 rounded-t-lg ease-in-out'>
                                <p class='text-lg font-light text-black block'>" . $row['deskripsi'] . "</p>
                                </div>
                            </a>
                        </div>";
            }
            echo "</div>";
        } else {
            echo "<p class='text-2xl text-center'>Tidak ada hasil</p>";
        }
    }
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.tambah-keranjang').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var id = this.getAttribute('data-id');
                    var nama = this.getAttribute('data-nama');

                    fetch('tambah-keranjang.php?id=' + id, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Item berhasil ditambahkan ke keranjang');
                            showAlert(`Memasukkan 1 ${nama} ke keranjang`)
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan saat menambahkan item ke keranjang', error);
                        });
                });
            });
        });
</script>