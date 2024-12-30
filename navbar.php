<?php
$username = "";
?>

<nav class="bg-white flex flex-row justify-center lg:justify-between items-center lg:px-10 text-[#653E00] font-bold text-xl drop-shadow-lg sticky top-0 z-20"
    style="position: -webkit-sticky;">
    <div class="menu py-5 flex flex-row items-center gap-5">
        <img src="images/Logo_nav.png" alt="Logo" class="h-20">
        <p class="text-4xl text-[#653E00]">Kopi<span class="text-[#009D3C]">Sob</span></p>

        <?php
        if (isset($_SESSION['login'])) {
            $username = $_SESSION['login'];
            ?><button id="menu-toggle" class="block lg:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <ul class="flex flex-row gap-5 hidden lg:flex">
                <li><a href="#beranda" id="nav-beranda" class="hover:underline underline-offset-1">Beranda</a></li>
                <li><a href="#menu" id="nav-menu" class="hover:underline underline-offset-1">Menu</a></li>
                <li><a href="#cerita" id="nav-cerita" class="hover:underline underline-offset-1">Cerita</a></li>
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    echo "<li><a href='admin.php' id='nav-cerita' class='hover:underline underline-offset-1'>Menu Admin</a></li>";
                }
                ?>
            </ul>
            <?php
        }
        ?>
    </div>
    <div class="account px-10 flex gap-3 items-center hidden lg:flex">
        <?php
        if (isset($_SESSION['login'])) {
            ?>
            <div id="search-bar"
                class="p-5 overflow-hidden w-10 h-10 hover:w-[300px] bg-[#009D3C] shadow-[2px_2px_20px_rgba(0,0,0,0.08)] rounded-full flex group items-center justify-center hover:duration-300 duration-300 relative">
                <div id="search-icon"
                    class="flex items-center justify-center fill-white absolute transition-all duration-300 group-hover:left-4 group-hover:translate-x-0 left-1/2 -translate-x-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode" data-name="Isolation Mode"
                        viewBox="0 0 24 24" width="15" height="15">
                        <path
                            d="M18.9,16.776A10.539,10.539,0,1,0,16.776,18.9l5.1,5.1L24,21.88ZM10.5,18A7.5,7.5,0,1,1,18,10.5,7.507,7.507,0,0,1,10.5,18Z">
                        </path>
                    </svg>
                </div>
                <input type="text" id="search-input"
                    class="outline-none text-[20px] bg-transparent w-full text-white font-normal px-4 opacity-0 group-hover:opacity-100 group-hover:w-full transition-opacity duration-300" />
            </div>


            <a id="account" class="text-2xl cursor-pointer"><?php echo ($username) ?></a>
            <div class="menu-akun bg-white absolute top-24 right-4 flex flex-col gap-2 items-end rounded-md drop-shadow-xl p-4 hidden"
                id="pop-up-akun">
                <a class="group popup-account bg-white rounded-md flex gap-3" id="logo-keranjang" href="keranjang.php">
                    <p class="group-hover:underline">Keranjang</p><i
                        class="fa-solid fa-cart-shopping text-3xl text-[#009D3C]"></i>
                </a>
                <a class="group popup-account bg-white rounded-md flex gap-3" href="history-belanja.php">
                    <p class="group-hover:underline">History Belanja</p><i
                        class="fa-solid fa-clock-rotate-left text-3xl text-orange-400"></i>
                </a>
                <a class="group popup-account bg-white rounded-md flex gap-3" href="logout.php">
                    <p class="group-hover:underline">Logout</p><i
                        class="fa-solid fa-right-from-bracket text-3xl text-red-500"></i>
                </a>
            </div>
            <?php
        }
        ?>

    </div>
</nav>

<div class="menu-wrapper sticky z-20 top-32 right-2 bg-white hidden lg:hidden border-2 gap-2 p-2 rounded-lg flex flex-col items-center"
    id="menu-wrapper">
    <a id="account" class="text-lg font-bold"><?php echo ($_SESSION['login']) ?></a>
    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        echo "<a href='admin.php' id='nav-cerita' class='hover:underline underline-offset-1'>Menu Admin</a>";
    }
    ?>
    <a class="group popup-account bg-white rounded-md flex gap-3 lg:hidden" id="logo-keranjang" href="keranjang.php">
        <p class="group-hover:underline">Keranjang</p>
    </a>
    <a class="group popup-account bg-white rounded-md flex gap-3 lg:hidden" href="history-belanja.php">
        <p class="group-hover:underline">History Belanja</p>
    </a>
    <a class="group popup-account bg-white rounded-md flex gap-3 lg:hidden" href="logout.php">
        <p class="group-hover:underline">Logout</p>
    </a>
</div>

<script src="js/navbar.js"></script>