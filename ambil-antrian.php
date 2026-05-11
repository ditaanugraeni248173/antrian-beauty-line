<?php
include "config.php";

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
          <button
            class="btn-blue"
            onclick="location.href = 'ambil-antrian.php'">
            <i class="hgi hgi-stroke hgi-user"></i>Daftar Antrian
          </button>
          </div>
          <div class="icon">
           <button
            class="btn-blue"
            onclick="location.href = 'daftar_antri.html'">
            <i class="hgi hgi-stroke hgi-list-view"></i>Daftar Antrian
          </button>
          </div>
          <div class="icon">
            <button 
            class="btn-blue"
            onclick="location.href = 'kartu_antrian.php'"> <i class="hgi hgi-stroke hgi-ticket-01"></i>
            Daftar Antrian
          </button>
          </div>
        </div>
      </div>

      <!-- Main -->
      <div class="main">
              <!-- Form -->
        <div class="form">
          <h2>Ambil Antrian</h2>

          <!-- form -->
          <form action="action-ambil-antrian.php" method="post">
            <label>Nomor Telepon</label>
            <input name="no_telp" placeholder="Masukkan Nomor Telepon" />
            <label>Loket</label>
            <select name="layanan">
              <?php
              foreach($row as $opsi){
                echo "<option value='".$opsi[0]."'>".$opsi[1]."</option>";
               }
              ?>
            </select>

            <!-- button -->
          <div class="btn">
            <button type="submit">Ambil Antrian</button>
          </div>

          </form>
        </div>
      </div>
    </div>
  </body>
</html>
