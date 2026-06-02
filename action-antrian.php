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
$stmt = $conn->prepare("SELECT name FROM services WHERE id = ?");
$stmt->bind_param("i", $layanan_id);
$stmt->execute();
$res = $stmt->get_result();
$service = $res->fetch_assoc();
$stmt->close();

if (!$service) {
    header("Location: ambil-antrian.php?error=Layanan+tidak+ditemukan");
    exit;
}
$layanan_nama = $service['name'];

// Hitung nomor antrian berikutnya untuk layanan ini hari ini
$stmt2 = $conn->prepare("SELECT COUNT(*) as total FROM queues WHERE service_id = ? AND DATE(appointment_date) = CURDATE()");
$stmt2->bind_param("i", $layanan_id);
$stmt2->execute();
$res2 = $stmt2->get_result();
$count = $res2->fetch_assoc();
$stmt2->close();
$nomor_antrian = $count['total'] + 1;

// Insert antrian baru
$stmt3 = $conn->prepare("INSERT INTO queues (service_id, visitor_phone, queue_number, appointment_date) VALUES (?, ?, ?, CURDATE())");
$stmt3->bind_param("isi", $layanan_id, $no_telp, $nomor_antrian);
$stmt3->execute();
$stmt3->close();

// Tambahkan antrian baru ke dalam list session (bukan replace)
if (!isset($_SESSION['daftar_antrian'])) {
    $_SESSION['daftar_antrian'] = [];
}
$_SESSION['daftar_antrian'][] = [
    'no'      => $nomor_antrian,
    'layanan' => $layanan_nama,
    'no_telp' => $no_telp
];

// Hanya simpan 5 antrian terakhir agar session tidak membengkak
if (count($_SESSION['daftar_antrian']) > 2) {
    array_shift($_SESSION['daftar_antrian']);
}

// Redirect ke kartu_antrian.php
header("Location: kartu_antrian.php");
exit;
?>