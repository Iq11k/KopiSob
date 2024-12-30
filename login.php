<?php
$error = '';

if (isset($_POST['username'])) {
    $recaptcha = $_POST['g-recaptcha-response'];

    $secretKey = "6LcXiIYqAAAAAG9D7E8J8WM0n_xmg3BwWEzcc3jA";
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptcha";

    $response = file_get_contents($url);
    $responseKey = json_decode($response, true);

    if (intval($responseKey["success"]) != 1) {
        $error = "Login Gagal coba lagi";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM akun WHERE username = '$username'";
        $result = mysqli_query($koneksi, $sql);
        $akun = mysqli_fetch_assoc($result);
        if ($akun) {
            if (password_verify($password, $akun['password'])) {
                $_SESSION['login'] = $akun['username'];
                $_SESSION['id_user'] = $akun['id'];
                $_SESSION['role'] = $akun['role'];
                header('Location: index.php');
                exit();
            } else {
                $error = "Gagal masuk ke sistem username atau password salah";
            }
        } else {
            $error = "Username tidak ditemukan";
        }
    }
    if ($error != '') {
        echo "<div
                id='alert-message'
                role='alert'
                class='absolute top-4 z-50 left-1/2 transform -translate-x-1/2 bg-red-100 border-l-4 border-red-500 text-red-900 p-2 rounded-lg flex items-center transition duration-300 ease-in-out hover:bg-red-200 transform hover:scale-105'>
                <svg
                    stroke='currentColor'
                    viewBox='0 0 24 24'
                    fill='none'
                    class='h-5 w-5 flex-shrink-0 mr-2 text-red-600'
                    xmlns='http://www.w3.org/2000/svg'>
                    <path
                        d='M13 16h-1v-4h1m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                        stroke-width='2'
                        stroke-linejoin='round'
                        stroke-linecap='round'>
                    </path>
                </svg>
                <p class='text-xs font-semibold'>$error</p>
            </div>";
    }
}
?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section
    class="flex flex-col items-center justify-center gap-4 h-screen w-full bg-[url('images/bg-login.png')] bg-no-repeat bg-cover text-white">
    <h1 class="font-bold text-4xl">Masuk ke akun anda</h1>
    <form action="" method="POST" class="flex flex-col items-center justify-center gap-4">
        <table class="text-right">
            <tr>
                <td class="py-2 px-2">Username</td>
                <td class="py-2"> : </td>
                <td class="py-2 px-2"><input class="text-black" type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td class="py-2 px-2">Password</td>
                <td class="py-2"> : </td>
                <td class="py-2 px-2"><input class="text-black" type="password" name="password" id="password" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="px-2 text-left"><input type="checkbox" type="checkbox" onclick="showPassword()"> Show
                    Password</td>
            </tr>
        </table>
        <div class="g-recaptcha" data-sitekey="6LcXiIYqAAAAABY2Oswu-8ezab7SCcWj6abm1Iuf"></div>
        </td>
        </tr>
        <p>Belum punya akun? <a class="text-white font-bold underline" href="index.php?page=register">Daftar
                disini</a></p>
        <input type="submit" value="Masuk"
            class="bg-[#009D3C] text-white px-4 py-2 rounded hover:bg-[#00702B] cursor-pointer">
    </form>
</section>

<script>
    setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }
    }, 2000);
</script>