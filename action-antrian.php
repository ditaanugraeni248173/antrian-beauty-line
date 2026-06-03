<?php
session_start();
include "config.php";

// input
if (empty($_POST['no_telp']) || empty($_POST['layanan'])) {
    header("Location: ambil-antrian.php?error=Data+tidak+lengkap");
    exit;
}

$no_telp    = trim($_POST['no_telp']);
$layanan_id = (int) $_POST['layanan'];

// cari nama layanan
$cari_layanan = $conn->prepare("SELECT name FROM services WHERE id = ?");
$cari_layanan->bind_param("i", $layanan_id);
$cari_layanan->execute();
$result = $cari_layanan->get_result();
$data_layanan  = $result->fetch_assoc();
$cari_layanan->close();

if (!$data_layanan) {
    header("Location: ambil-antrian.php?error=Layanan+tidak+ditemukan");
    exit;
}
$nama_layanan = $data_layanan['name'];

// hitung antrian
$hitung_antrian = $conn->prepare("SELECT COUNT(*) as total FROM queues WHERE service_id = ? AND DATE(appointment_date) = CURDATE()");
$hitung_antrian->bind_param("i", $layanan_id);
$hitung_antrian->execute();
$hasil_hitung   = $hitung_antrian->get_result();
$jumlah_antrian = $hasil_hitung->fetch_assoc();
$hitung_antrian->close();
$nomor_antrian = $jumlah_antrian['total'] + 1;

// simpan antrian ke db
$simpan_antrian = $conn->prepare("INSERT INTO queues (service_id, visitor_phone, queue_number, appointment_date) VALUES (?, ?, ?, CURDATE())");
$simpan_antrian->bind_param("isi", $layanan_id, $no_telp, $nomor_antrian);
$simpan_antrian->execute();
$simpan_antrian->close();

// masukkan ke session
if (!isset($_SESSION['daftar_antrian'])) {
    $_SESSION['daftar_antrian'] = [];
}
$_SESSION['daftar_antrian'][] = [
    'no'      => $nomor_antrian,
    'layanan' => $nama_layanan,
    'no_telp' => $no_telp
];

// membatasi hanya 2 antrian terakhir
if (count($_SESSION['daftar_antrian']) > 2) {
    array_shift($_SESSION['daftar_antrian']);
}

header("Location: kartu_antrian.php");
exit;
?>