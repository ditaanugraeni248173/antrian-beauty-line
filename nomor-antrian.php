<?php
$nomor = $_GET['nomor'] ?? '-';
$telp = $_GET['telp'] ?? '-';
$loket = $_GET['loket'] ?? '-';
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
      /* hover effect */
      .bttn:hover {
        background-color: #d96f86;
      }

      /* button */
      .bttn {
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
    </style>
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
      <div class="main">
        <!-- header -->
        <div class="header">
          <h1>facial treatment</h1>
        </div>
        <!-- kartu antrian -->
        <div class="card-container">
          <div class="nomor"><?php echo $nomor; ?></div>

          <div class="info">
            <div>
              Nomor Telepon : <?php echo $telp; ?> <br />
              Loket : <?php echo $loket; ?>
            </div>
          </div>
        </div>
        <!-- button -->

        <button class="bttn">ambil antrian baru</button>
      </div>
    </div>
  </body>
</html>
