<?php
session_start();

// Ambil semua antrian dari session, dibalik agar terbaru di atas
$daftar_antrian = array_reverse($_SESSION['daftar_antrian'] ?? []);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kartu Antrian - Beauty Line</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
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
      .icon.active { background-color: #ffa5c0; }
      .icon.active a { pointer-events: none; }

      .main {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 40px;
        box-sizing: border-box;
        overflow-y: auto;
        background-image: url("img/Group91.png");
        background-repeat: repeat;
        background-size: 100vh;
      }

      .page-title {
        color: #9c5162;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
      }

      /* Wrapper semua kartu berjejer */
      .tickets-wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        width: 100%;
      }

      /* Satu kartu tiket */
      .ticket-wrapper {
        filter: drop-shadow(0px 8px 20px rgba(0, 0, 0, 0.15));
        width: 380px;
      }

      .ticket {
        background:
          radial-gradient(circle at 0 50%, transparent 25px, #efbfc8 26px) bottom left  / 50% 100% no-repeat,
          radial-gradient(circle at 100% 50%, transparent 25px, #efbfc8 26px) bottom right / 50% 100% no-repeat;
        padding: 40px 45px;
        border-radius: 12px;
        color: #9c5162;
        position: relative;
      }

      .ticket-title {
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 30px;
      }

      .info-table {
        width: 100%;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        border-collapse: collapse;
      }
      .info-table td { padding: 6px 0; vertical-align: top; }
      .info-table .label { width: 38%; }
      .info-table .colon { width: 5%; text-align: center; }
      .info-table .value { width: 57%; }

      .ticket-number {
        text-align: center;
        font-size: 70px;
        font-weight: 700;
        color: #9c5162;
        line-height: 1;
      }

      /* Badge "Terbaru" di kartu pertama */
      .badge-terbaru {
        position: absolute;
        top: 12px;
        left: 16px;
        background-color: #9c5162;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        letter-spacing: 0.5px;
      }

      .empty-msg {
        color: #b07080;
        font-size: 15px;
        font-weight: 500;
        margin-top: 40px;
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

        <?php if (empty($daftar_antrian)): ?>
          <p class="empty-msg">Belum ada antrian yang diambil.</p>
        <?php else: ?>
          <div class="tickets-wrapper">
            <?php foreach ($daftar_antrian as $index => $antrian): ?>
              <div class="ticket-wrapper">
                <div class="ticket">

                  <?php if ($index === 0): ?>
                    <span class="badge-terbaru">TERBARU</span>
                  <?php endif; ?>

                  <h2 class="ticket-title">Nomor Antrian</h2>

                  <table class="info-table">
                    <tr>
                      <td class="label">Nomor Telepon</td>
                      <td class="colon">:</td>
                      <td class="value"><?= htmlspecialchars($antrian['no_telp']) ?></td>
                    </tr>
                    <tr>
                      <td class="label">Loket</td>
                      <td class="colon">:</td>
                      <td class="value"><?= htmlspecialchars($antrian['layanan']) ?></td>
                    </tr>
                  </table>

                  <div class="ticket-number"><?= str_pad($antrian['no'], 3, '0', STR_PAD_LEFT) ?></div>

                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </body>
</html>