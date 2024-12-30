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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="<?php
session_start();
echo !isset($_SESSION['login']) ? 'lg:overflow-hidden' : ''; ?>">
    <div class="fixed z-50 top-32 flex w-3/4 max-w-96 h-24 bg-white rounded-xl overflow-hidden shadow-lg hidden"
        id="custom-alert" data-aos="fade-right">
        <svg width="16" height="96" xmlns="http://www.w3.org/2000/svg">
            <path d="M 8 0 
               Q 4 4.8, 8 9.6 
               T 8 19.2 
               Q 4 24, 8 28.8 
               T 8 38.4 
               Q 4 43.2, 8 48 
               T 8 57.6 
               Q 4 62.4, 8 67.2 
               T 8 76.8 
               Q 4 81.6, 8 86.4 
               T 8 96 
               L 0 96 
               L 0 0 
               Z" fill="#009D3C" stroke="#009D3C" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <div class="mx-2.5 overflow-hidden w-full">
            <p
                class="mt-1.5 text-xl font-bold text-[#009D3C] leading-8 mr-3 overflow-hidden text-ellipsis whitespace-nowrap">
                Berhasil !
            </p>
            <p class="overflow-hidden leading-5 break-all text-zinc-400 max-h-10" id="pesan"></p>
        </div>
        <button class="w-16 cursor-pointer focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="mediumseagreen" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
        </button>
    </div>

    <?php
    include 'koneksi.php';
    include 'navbar.php';
    $page = '';
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    if (isset($_SESSION['login']) && $page != 'register') {
        ?>
        <section
            class="beranda h-screen w-full bg-[url('images/biji_hitam.png')] bg-cover flex flex-col-reverse lg:flex-row items-center lg:px-20 justify-center lg:justify-between gap-4"
            id="beranda">
            <div class="hero-text flex flex-col items-center justify-center p-4 lg:block">
                <p class="text-white font-bold lg:text-4xl lg:w-3/4">"Nikmati Kehangatan Kopi Terbaik di <span
                        class="bg-[#009D3C]">KopiSob</span> - Teman Setia Harimu!"</p>
                <br>
                <p class="text-white lg:w-1/2">KopiSob menghadirkan kenikmatan kopi berkualitas dengan suasana hangat dan
                    nyaman. Dengan menu yang beragam, kami berkomitmen menjadi teman terbaik di setiap momenmu.</p>
                <br>
                <a href="#menu"
                    class="bg-[#009D3C] text-white hover:bg-[#00702B] focus:ring-4 focus:ring-bg-[#00702B] font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Yuk
                    Ngopi</a>
            </div>
            <img src="images/logo-neon.png" alt="logo neon" class="w-40 lg:w-96" data-aos="flip-left"
                data-aos-duration="600">
        </section>
        <section class="menu h-fit flex flex-col gap-4 items-center py-32" id="menu">
            <input type="text" id="search-input-mobile"
                class="border-2 text-[20px] bg-transparent h-10 text-black font-normal px-4 block lg:hidden" />
            <p class="lg:text-xl text-center w-3/4 opacity-40 lg:-mt-10">*Silahkan klik menu yang ingin anda pesan dan
                pesanan
                akan langsung masuk ke keranjang</p>
            <div class="menu-container flex flex-col justify-center gap-4 w-full" id="menu-container">
                <?php
                $list_kategori = ['Kopi', 'Non kopi', 'Dessert'];

                foreach ($list_kategori as $k) {
                    $sql = "SELECT menu.id, menu.nama_menu, menu.harga, menu.gambar, menu.deskripsi, kategori.kategori FROM menu JOIN kategori ON menu.kategori = kategori.id WHERE kategori.kategori = '$k'";
                    $result = mysqli_query($koneksi, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "
                        <div class='text-header relative'>
                            <p class='text-6xl lg:text-8xl text-black font-bold italic mb-4 text-center opacity-20 whitespace-nowrap overflow-hidden' style='-webkit-text-fill-color:transparent; -webkit-text-stroke-width:2px;' id='bg-text-header'>$k $k $k $k $k $k $k $k $k $k $k $k</p>
                            <p class='absolute uppercase left-1/2 top-1/2 transform -translate-x-1/2 transform -translate-y-1/2 text-4xl lg:text-7xl text-black font-bold mb-4 text-center'>$k</p>
                        </div>
                        <div class='item-container flex flex-wrap justify-center gap-20'>";
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
                    }
                }

                ?>
            </div>

        </section>
        <section class="cerita h-screen flex flex-col gap-4 items-center pt-32 items-center justify-between" id="cerita">
            <div class="cerita-container flex flex-col items-center justify-center gap-4 mt-4">
                <p class="text-4xl font-bold">Cerita <span class="text-[#009D3C]">KopiSob</span></p>
                <p class="p-4 lg:p-0 lg:w-1/2 text-center">KopiSob adalah tempat yang menyediakan berbagai macam kopi
                    berkualitas dengan harga yang terjangkau. Kami berkomitmen untuk memberikan kenyamanan dan kehangatan
                    dalam setiap cangkir kopi yang kami sajikan.</p>
            </div>
            <div class="mansory-layout h-[40rem] w-3/4 overflow-y-scroll">
                <div class="cerita-container h-fit w-full columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">
                    <div id="card-tambah-cerita"
                        class="cerita border-2 shadow-md font-bold border-[#009D3C] hover:bg-[#009D3C] hover:text-white duration-300 rounded-xl h-20 w-52 grid place-content-center cursor-pointer">
                        <p>Tambah Cerita</p>
                    </div>
                    <?php
                    $sql = "SELECT * FROM cerita JOIN akun ON cerita.id_akun = akun.id ORDER BY cerita.waktu DESC";
                    $result = mysqli_query($koneksi, $sql);
                    $kurang = 3;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<div class='cerita-item w-52 shadow-md border-2 border-[#009D3C] rounded-xl p-4' style='break-inside: avoid'>
                                    <p id='user' class='font-bold'>" . $row['username'] . "</p>
                                    <p id='cerita'>" . $row['cerita'] . "</p>
                                    <p id='waktu' class='text-[#009D3C]'>" . strftime('%d %B %Y', strtotime($row['waktu'])) . "</p>
                                </div>";
                            if ($kurang > 1) {
                                $kurang--;
                            }
                        }
                    } else {
                        while ($kurang--) {
                            echo "<a
                                class='cerita border-2 shadow-md font-bold border-[#009D3C] rounded-xl h-20 w-52 grid place-content-center'>
                                <p>Belum ada cerita</p>
                            </a>";
                        }

                    }

                    ?>
                </div>
            </div>
            <div class="sosmed text-sm lg:text-lg flex gap-4 mb-4 items-center justify-center px-4">
                <p>Responsi PWD Moch. Rizqi Ardi Saputra Bambang - 2200018232</p>
                <div class="group relative inline-block">
                    <a class="focus:outline-none" href="https://www.instagram.com/rizqiardi_15/">
                        <svg viewBox="0 0 50 50"
                            class="bi bi-instagram transform transition-transform duration-300 hover:scale-125 hover:text-[#009D3C]"
                            fill="currentColor" width="30" height="30" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                            </path>
                        </svg>
                    </a>
                    <span
                        class="absolute -top-10 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-gray-900 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-75">Instagram</span>
                </div>
                <div class="group relative inline-block">
                    <a class="focus:outline-none" href="https://www.linkedin.com/in/mochrizqiardi">
                        <svg viewBox="0 0 50 50"
                            class="bi bi-linkedin transform transition-transform duration-300 hover:scale-125 hover:text-[#009D3C]"
                            fill="currentColor" width="30" height="30" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10 c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56 c3.97,0,7.19,2.73,7.19,8.26V39z">
                            </path>
                        </svg>
                    </a>
                    <span
                        class="absolute -top-10 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-gray-900 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-75">Linkedin</span>
                </div>
                <div class="group relative inline-block">
                    <a class="focus:outline-none" href="https://github.com/Iq11k">
                        <svg viewBox="0 0 50 50"
                            class="bi bi-github transform transition-transform duration-300 hover:scale-125 hover:text-[#009D3C]"
                            fill="currentColor" width="30" height="30" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.791,46.836C18.502,46.53,19,45.823,19,45v-5.4c0-0.197,0.016-0.402,0.041-0.61C19.027,38.994,19.014,38.997,19,39 c0,0-3,0-3.6,0c-1.5,0-2.8-0.6-3.4-1.8c-0.7-1.3-1-3.5-2.8-4.7C8.9,32.3,9.1,32,9.7,32c0.6,0.1,1.9,0.9,2.7,2c0.9,1.1,1.8,2,3.4,2 c2.487,0,3.82-0.125,4.622-0.555C21.356,34.056,22.649,33,24,33v-0.025c-5.668-0.182-9.289-2.066-10.975-4.975 c-3.665,0.042-6.856,0.405-8.677,0.707c-0.058-0.327-0.108-0.656-0.151-0.987c1.797-0.296,4.843-0.647,8.345-0.714 c-0.112-0.276-0.209-0.559-0.291-0.849c-3.511-0.178-6.541-0.039-8.187,0.097c-0.02-0.332-0.047-0.663-0.051-0.999 c1.649-0.135,4.597-0.27,8.018-0.111c-0.079-0.5-0.13-1.011-0.13-1.543c0-1.7,0.6-3.5,1.7-5c-0.5-1.7-1.2-5.3,0.2-6.6 c2.7,0,4.6,1.3,5.5,2.1C21,13.4,22.9,13,25,13s4,0.4,5.6,1.1c0.9-0.8,2.8-2.1,5.5-2.1c1.5,1.4,0.7,5,0.2,6.6c1.1,1.5,1.7,3.2,1.6,5 c0,0.484-0.045,0.951-0.11,1.409c3.499-0.172,6.527-0.034,8.204,0.102c-0.002,0.337-0.033,0.666-0.051,0.999 c-1.671-0.138-4.775-0.28-8.359-0.089c-0.089,0.336-0.197,0.663-0.325,0.98c3.546,0.046,6.665,0.389,8.548,0.689 c-0.043,0.332-0.093,0.661-0.151,0.987c-1.912-0.306-5.171-0.664-8.879-0.682C35.112,30.873,31.557,32.75,26,32.969V33 c2.6,0,5,3.9,5,6.6V45c0,0.823,0.498,1.53,1.209,1.836C41.37,43.804,48,35.164,48,25C48,12.318,37.683,2,25,2S2,12.318,2,25 C2,35.164,8.63,43.804,17.791,46.836z">
                            </path>
                        </svg>
                    </a>
                    <span
                        class="absolute -top-10 left-1/2 transform -translate-x-1/2 z-20 px-4 py-2 text-sm font-bold text-white bg-gray-900 rounded-lg shadow-lg transition-transform duration-300 ease-in-out scale-0 group-hover:scale-75">Github</span>
                </div>
            </div>
        </section>
        <div class="feedback-wrapper h-screen w-screen fixed top-0 left-0 z-50 hidden">
            <div class="gelap h-full w-full absolute bg-black opacity-50"></div>
            <div
                class="absolute z-50 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[20rem] bg-white border border-slate-200 grid grid-cols-6 gap-2 rounded-xl p-2 text-sm">
                <a id="close-submit-cerita"><i
                        class="fa-regular fa-circle-xmark absolute top-2 right-2 text-red-500 text-2xl hover:scale-125 duration-300"></i></a>
                <h1 class="text-center text-brown-200 text-xl font-bold col-span-6">Bercerita Sob</h1>
                <textarea placeholder="Ceritamu Sob..." name="cerita" id="cerita-input"
                    class="bg-slate-100 text-slate-600 h-28 placeholder:text-slate-600 placeholder:opacity-50 border border-slate-200 col-span-6 resize-none outline-none rounded-lg p-2 duration-300 focus:border-slate-600"></textarea>
                <span class="col-span-2"></span>
                <button id="submit-cerita"
                    class="bg-slate-100 stroke-slate-600 border border-slate-200 col-span-2 flex justify-center rounded-lg p-2 duration-300 hover:border-slate-600 hover:text-white focus:stroke-slate-300 focus:bg-[#009D3C]">
                    <svg fill="none" viewBox="0 0 24 24" height="30px" width="30px" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                            d="M7.39999 6.32003L15.89 3.49003C19.7 2.22003 21.77 4.30003 20.51 8.11003L17.68 16.6C15.78 22.31 12.66 22.31 10.76 16.6L9.91999 14.08L7.39999 13.24C1.68999 11.34 1.68999 8.23003 7.39999 6.32003Z">
                        </path>
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                            d="M10.11 13.6501L13.69 10.0601"></path>
                    </svg>
                </button>

            </div>
        </div>
        <?php
    } else if ($page == 'register') {
        include 'register.php';
    } else {
        include 'login.php';
    }
    ?>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                let query = $(this).val();
                $.ajax({
                    url: 'search.php',
                    method: 'GET',
                    data: { q: query },
                    success: function (data) {
                        $('#menu-container').html(data);
                        $('#search-input-mobile').val(query)
                        window.location.hash = '#menu';
                    }
                });
            });
        })
        $(document).ready(function () {
            $('#search-input-mobile').on('keyup', function () {
                let query = $(this).val();
                $.ajax({
                    url: 'search.php',
                    method: 'GET',
                    data: { q: query },
                    success: function (data) {
                        $('#menu-container').html(data);
                        $('#search-input').val(query);
                        window.location.hash = '#menu';
                    }
                });
            });
        })

        document.addEventListener('DOMContentLoaded', function () {
            const submitCeritaButton = document.getElementById('submit-cerita');
            const ceritaInput = document.getElementById('cerita-input');
            const cardTambahCerita = document.getElementById('card-tambah-cerita');
            const closeSubmitCerita = document.getElementById('close-submit-cerita');

            cardTambahCerita.addEventListener('click', function () {
                document.querySelector('.feedback-wrapper').classList.remove('hidden');
            });
            closeSubmitCerita.addEventListener('click', function () {
                document.querySelector('.feedback-wrapper').classList.add('hidden');
            });


            submitCeritaButton.addEventListener('click', function () {
                const cerita = ceritaInput.value;
                if (cerita.length > 0) {
                    fetch('kirim-cerita.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `cerita=${cerita}`
                    })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Cerita berhasil ditambahkan');
                            ceritaInput.value = '';
                            showAlert('Cerita berhasil ditambahkan');
                            document.querySelector('.feedback-wrapper').classList.add('hidden');
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan saat menambahkan cerita', error);
                        });
                }
            });

            function attachAddToCartEvent() {
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
            }

            // Attach event on initial load
            attachAddToCartEvent();

            // Re-attach event after search
            $(document).ready(function () {
                $('#search-input').on('keyup', function () {
                    let query = $(this).val();
                    $.ajax({
                        url: 'search.php',
                        method: 'GET',
                        data: { q: query },
                        success: function (data) {
                            $('#menu-container').html(data);
                            $('#search-input-mobile').val(query)
                            window.location.hash = '#menu';
                            attachAddToCartEvent(); // Re-attach event
                        }
                    });
                });
            });

            $(document).ready(function () {
                $('#search-input-mobile').on('keyup', function () {
                    let query = $(this).val();
                    $.ajax({
                        url: 'search.php',
                        method: 'GET',
                        data: { q: query },
                        success: function (data) {
                            $('#menu-container').html(data);
                            $('#search-input').val(query);
                            window.location.hash = '#menu';
                            attachAddToCartEvent(); // Re-attach event
                        }
                    });
                });
            });
        });
        function showAlert(message) {
            var alertBox = document.getElementById('custom-alert');
            const alertMessage = alertBox.querySelector('#pesan');
            alertMessage.textContent = message;
            alertBox.classList.remove('hidden');
            setTimeout(function () {
                alertBox.classList.add('hidden');
            }, 3000);
        }
    </script>
</body>

</html>