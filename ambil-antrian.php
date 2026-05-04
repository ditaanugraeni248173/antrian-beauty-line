<?php
include "config.php";

// query untuk mengambil data dari user dengan email = $_POST['input_email']
$query = "SELECT * FROM services";

$result = $conn->query($query);

$row = $result->fetch_all();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
      <!-- sidebar -->
      <div class="sidebar">
        <img src="img/vectorlogo.png" class="logo" />
        <img src="img/sidebar.png" class="sidebar-decor" />
        <div class="menu">
          <div class="icon">
            <i class="hgi hgi-stroke hgi-user"></i>
            <a href="ambil-antrian.php">Ambil Antrian</a>
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
          <form method="post">
            <label>Nomor Telepon</label>
            <input type="text" placeholder="Masukkan Nomor Telepon" />

            <label>Loket</label>
            <select name="loket" id="opsi">
              <?php
            foreach($row as $opsi){
           echo "<option>".$opsi[1]."</option>";
        }
          ?>
            </select>

            <button type="submit">Ambil Antrian</button>
          </form>
        </div>
      </div>
    </div>
    <!-- footer -->
    <footer class="footer">
      <p class="copyright">&copy;Copyright 2026</p>
    </footer>
  </body>
</html>
