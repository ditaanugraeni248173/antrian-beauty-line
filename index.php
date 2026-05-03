<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "admin_antrian");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if(isset($_POST['take'])){

  $telp = $_POST['telp'];
  $loket = $_POST['loket'];

  $service_map = [
    "Facial Treatment" => A001,
    "Laser Treatment" => B001,
    "Skin Booster" => C001
  ];

  if(empty($loket) || !isset($service_map[$loket])){
    die("Loket tidak valid");
  }

  $service_id = $service_map[$loket];
  $today = date('Y-m-d');

  $query = mysqli_query($conn, "
    SELECT MAX(queue_number) as last
    FROM queues
    WHERE service_id = $service_id
    AND appointment_date = '$today'
  ") or die(mysqli_error($conn));

  $data = mysqli_fetch_assoc($query);
  $last = $data['last'] ?? 0;
  $next = $last + 1;

  mysqli_query($conn, "
    INSERT INTO queues
    (service_id, queue_number, appointment_date, status, visitor_phone, created_at, updated_at)
    VALUES
    ($service_id, $next, '$today', 'waiting', '$telp', NOW(), NOW())
  ") or die(mysqli_error($conn));

  header("Location: nomor-antrian.php?nomor=$next&telp=$telp&loket=$loket");
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ambil Antrian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css"
    />
    <style>
      body {
        margin: 0;
        font-family: "Poppins";
      }
      .container {
        display: flex;
        height: 100vh;
      }

      /* sidebar */
      .sidebar {
        display: flex;
        flex-direction: column;
        width: 250px;
        padding: 20px;
        background-color: #f3cfd6;
        position: relative;
        gap: 15;
      }
      .logo {
        width: 150px;
        margin: 20px;
      }
      .sidebar-decor {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 70%;
      }
      .icon {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background-color: #e88ca0;
        padding: 15px;
        margin: 15px;
        position: relative;
        color: white;
        cursor: pointer;
        transition: 0.3s;
        border-radius: 10px;
      }
      a {
        text-decoration: none;
        color: white;
      }

      /* main */
      .main {
        flex: 1;
        font-family: "poppins";
        background-image: url("img/Group91.png");
        background-repeat: repeat;
        background-size: 100vh;
      }
      /* form */
      .form {
        width: 80%;
        margin: 30px auto;
        padding: 20px;
        background-color: #e88ca0;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      }
      .form h2 {
        text-align: center;
        margin-bottom: 25px;
        color: aliceblue;
      }
      .form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        font-size: 14px;
      }
      .form input,
      select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-family: "Poppins";
        outline: none;
        transition: 0.3s;
      }
      .form input:focus,
      .form select:focus {
        border-color: #e88ca0;
        box-shadow: 0 0 5px rgba(232, 140, 160, 0.5);
      }
      .form button {
        width: 30%;
        padding: 12px;
        justify-content: center;
        background-color: #e88ca0;
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
      }
      /* hover effect */
      .icon:hover {
        background-color: #97102d;
      }
      .form button:hover {
        background-color: #d96f86;
      }
    </style>
  </head>
  <body>
      <!-- sidebar -->
      <div class="sidebar">
        <img src="img/vectorlogo.png" class="logo" />
        <img src="img/sidebar.png" class="sidebar-decor" />
        <div class="menu">
          <div class="icon">
            <i class="hgi hgi-stroke hgi-user"></i>
            <a href="index.php">Ambil Antrian</a>
          </div>
          <div class="icon">
            <i class="hgi hgi-stroke hgi-list-view"></i>
            <a href="kartu_antrian.html">Daftar Antrian</a>
          </div>
          <div class="icon">
            <i class="hgi hgi-stroke hgi-ticket-01"></i>
            <a href="daftar_antri.html">Kartu Antrian</a>
          </div>
        </div>
      </div>

      <!-- Main -->
      <div class="main">
        <!-- Form -->
        <div class="form">
          <h2>Ambil Antrian</h2>
          <form method="POST">
            <label>Nomor Telepon</label>
            <input type="text" name="telp" placeholder="Masukkan Nomor Telepon" />

            <label>Loket</label>
            <select name="loket" id="">
              <option>Pilih Loket</option>
              <option>Facial Treatment</option>
              <option>Laser Treatment</option>
              <option>Skin Booster</option>
            </select>

            <button type="submit" name="take">Ambil Antrian</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
