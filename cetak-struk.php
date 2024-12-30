<?php
include 'koneksi.php';
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->Image('./images/KopiSob.png', 90, 6, 30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 25);
        // Title
        $this->Ln(20);
        $this->Cell(200, 10, 'Struk Riwayat Pembelian', 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$sql = "SELECT akun.username FROM akun JOIN pesanan ON akun.id = pesanan.id_akun WHERE pesanan.id = '$_GET[id_pesanan]' LIMIT 1";
$result = mysqli_query($koneksi, $sql);
$tanggal = mysqli_fetch_assoc($result)['username'];
$pdf->Cell(0, 10, 'Username : ' . $tanggal, 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No', 1,align:'C');
$pdf->Cell(90, 10, 'Nama Menu', 1);
$pdf->Cell(30, 10, 'Harga', 1,align:'C');
$pdf->Cell(20, 10, 'Jumlah', 1,align:'C');
$pdf->Cell(40, 10, 'Sub Total Harga', 1,align:'C');
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$sql = "SELECT pesanan.total_harga, pesanan.waktu_pemesanan, keranjang.jumlah, menu.nama_menu, menu.harga 
        FROM pesanan JOIN keranjang ON pesanan.id = keranjang.id_pesanan
        JOIN menu ON keranjang.id_menu = menu.id
        WHERE pesanan.id = '$_GET[id_pesanan]'";
$result = mysqli_query($koneksi, $sql);
$no = 1;
$total_harga = 0;
while ($row = mysqli_fetch_array($result)) {
    $total_bayar = $row['total_harga'];
    $total_harga += $row['harga'] * $row['jumlah'];
    $pdf->Cell(10, 10, $no++, 1,align:'C');
    $pdf->Cell(90, 10, $row['nama_menu'], 1);
    $pdf->Cell(30, 10, 'Rp. '.number_format((float) $row['harga'], 0, ",", "."), 1,align:'FJ');
    $pdf->Cell(20, 10, $row['jumlah'], 1,align:'C');
    $pdf->Cell(40, 10, 'Rp. '.number_format((float) $row['jumlah'] * $row['harga'], 0, ",", "."), 1,align:'FJ');
    $pdf->Ln();
}
$pdf->Cell(150, 10, 'Total Harga ', 1);
$pdf->Cell(40, 10, 'Rp. '.number_format((float) $total_harga, 0, ",", "."), 1, 1,'FJ');
$pdf->Cell(150, 10, 'PPN (11%) ', 1);
$pdf->Cell(40, 10, 'Rp. '.number_format((float) ($total_harga*11)/100, 0, ",", "."), 1, 1,'FJ');
$pdf->Cell(150, 10, 'Total Bayar ', 1);
$pdf->Cell(40, 10, 'Rp. '.number_format((float) $total_bayar, 0, ",", "."), 1, 1,'FJ');

$sql = "SELECT waktu_pemesanan FROM pesanan WHERE id = '$_GET[id_pesanan]' LIMIT 1";
$result = mysqli_query($koneksi, $sql);
$tanggal = mysqli_fetch_assoc($result)['waktu_pemesanan'];
$pdf->Cell(0, 10, 'Waktu Transaksi' , 0, 1, 'R');
$pdf->Cell(0, 7, strftime('%H:%M:%S', strtotime($tanggal)), 0, 1, 'R');
$pdf->Cell(0, 7, strftime('%d %B %Y', strtotime($tanggal)), 0, 1, 'R');

if(isset($_GET['download']) && $_GET['download'] == 1){
    $pdf->Output('D', 'Struk Pembelian_'.$tanggal.'.pdf');
} else {
    $pdf->Output();
}
?>