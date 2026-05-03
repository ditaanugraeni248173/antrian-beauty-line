<?php
$conn = mysqli_connect("localhost", "root", "", "admin_antrian");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>