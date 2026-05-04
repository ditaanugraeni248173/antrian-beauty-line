<?php
include "config.php";

// terima dulu datanya
echo $_POST['no_telp'];
echo $_POST['layanan'];

// tulis querynya
$query = "INSERT INTO queues 
    (service_id, visitor_phone, queue_number, appointment_date)
    VALUES ('".$_POST['layanan']."','".$_POST['no_telp']."','5', '2026-05-04' )";

// dijalankan query insert
$result = $conn->query($query);

// tampilkan nomor

?>