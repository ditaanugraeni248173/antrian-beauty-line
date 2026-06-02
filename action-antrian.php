<?php
session_start();
include "config.php";

// Validasi input
if (empty($_POST['no_telp']) || empty($_POST['layanan'])) {
    header("Location: ambil-antrian.php?error=Data+tidak+lengkap");
    exit;
}

$no_telp    = trim($_POST['no_telp']);
$layanan_id = (int) $_POST['layanan'];

// Ambil nama layanan dari DB
$cariLayanan = $conn->prepare("SELECT name FROM services WHERE id = ?");
$cariLayanan->bind_param("i", $layanan_id);
$cariLayanan->execute();
$hasilLayanan = $cariLayanan->get_result();
$service = $hasilLayanan->fetch_assoc();
$cariLayanan->close();

if (!$service) {
    header("Location: ambil-antrian.php?error=Layanan+tidak+ditemukan");
    exit;
}
$layanan_nama = $service['name'];

// Hitung nomor antrian berikutnya untuk layanan ini hari ini
$hitungAntrian = $conn->prepare("SELECT COUNT(*) as total FROM queues WHERE service_id = ? AND DATE(appointment_date) = CURDATE()");
$hitungAntrian->bind_param("i", $layanan_id);
$hitungAntrian->execute();
$hasilHitung = $hitungAntrian->get_result();
$count = $hasilHitung->fetch_assoc();
$hitungAntrian->close();
$nomor_antrian = $count['total'] + 1;

// Ambil antrian baru
$simpanAntrian = $conn->prepare("INSERT INTO queues (service_id, visitor_phone, queue_number, appointment_date) VALUES (?, ?, ?, CURDATE())");
$simpanAntrian->bind_param("isi", $layanan_id, $no_telp, $nomor_antrian);
$simpanAntrian->execute();
$simpanAntrian->close();

// Simpan data antrian ke session agar bisa diakses kapan saja
$_SESSION['antrian'] = [
    'no'      => $nomor_antrian,
    'layanan' => $layanan_nama,
    'no_telp' => $no_telp
];

// Redirect ke kartu_antrian.php
header("Location: kartu_antrian.php");
exit;
?>