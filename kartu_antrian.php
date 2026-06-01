<?php
session_start();

// Baca data dari session (diisi saat ambil antrian)
$nomor   = $_SESSION['antrian']['no']      ?? '';
$layanan = $_SESSION['antrian']['layanan'] ?? '';
$no_telp = $_SESSION['antrian']['no_telp'] ?? '';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kartu Antrian - Beauty Line</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css"
    />
    <link rel="stylesheet" href="style.css" />

    <style>
      
      .sidebar .menu {
        display: flex;
        flex-direction: column;
        gap: 5px;
      }

      .icon {
        padding: 0 !important; 
        overflow: hidden;
      }

      .icon a {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 15px; 
        box-sizing: border-box;
        color: var(--text);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        height: 100%;
      }

    
      .icon.active {
        background-color: #ffa5c0;
      }
      .icon.active a {
        pointer-events: none; 
      }

  
      .main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        box-sizing: border-box;
      }

      .page-title {
        color: #9c5162;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
      }

      .ticket-wrapper {
        filter: drop-shadow(0px 8px 20px rgba(0, 0, 0, 0.15));
        width: 480px;
      }

      .ticket {
      
        background:
          radial-gradient(circle at 0 50%, transparent 25px, #efbfc8 26px)
            bottom left / 50% 100% no-repeat,
          radial-gradient(circle at 100% 50%, transparent 25px, #efbfc8 26px)
            bottom right / 50% 100% no-repeat;
        padding: 40px 45px;
        border-radius: 12px;
        color: #9c5162;
        position: relative;
      }

      .close-link {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 45px;
        font-weight: bold;
        color: #e88ca0;
        text-decoration: none;
        line-height: 0.5;
        transition: color 0.3s;
        width: auto !important;
        display: inline !important;
      }
      .close-link:hover {
        color: var(--hover-1);
      }

      .ticket-title {
        text-align: center;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 40px;
      }

      .info-table {
        width: 100%;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 30px;
        border-collapse: collapse;
      }
      .info-table td {
        padding: 8px 0;
        vertical-align: top;
      }
      .info-table .label {
        width: 38%;
      }
      .info-table .colon {
        width: 5%;
        text-align: center;
      }
      .info-table .value {
        width: 57%;
      }

      .ticket-number {
        text-align: center;
        font-size: 75px;
        font-weight: 700;
        color: #9c5162;
        line-height: 1;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="sidebar">
        <img src="img/vectorlogo.png" class="logo" />
        <img src="img/sidebar.png" class="sidebar-decor" />
        <div class="menu">
          <div class="icon">
            <a href="ambil-antrian.php">
              <i class="hgi hgi-stroke hgi-user"></i>Ambil Antrian
            </a>
          </div>

          <div class="icon">
            <a href="daftar-antrian.php">
              <i class="hgi hgi-stroke hgi-list-view"></i>Daftar Antrian
            </a>
          </div>

          <div class="icon active">
            <a href="kartu_antrian.php">
              <i class="hgi hgi-stroke hgi-ticket-01"></i>Kartu Antrian
            </a>
          </div>
        </div>
      </div>

      <div class="main">
        <h1 class="page-title">Kartu Antrian</h1>

        <div class="ticket-wrapper">
          <div class="ticket">
            <a href="ambil-antrian.php" class="close-link">&times;</a>

            <h2 class="ticket-title">Nomor Antrian</h2>

            <table class="info-table">
              <tr>
                <td class="label">Nomor Telepon</td>
                <td class="colon">:</td>
                <td class="value"><?= htmlspecialchars($no_telp); ?></td>
              </tr>
              <tr>
                <td class="label">Loket</td>
                <td class="colon">:</td>
                <td class="value"><?= htmlspecialchars($layanan); ?></td>
              </tr>
            </table>

            <div class="ticket-number"><?= htmlspecialchars($nomor); ?></div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
