<?php
include "config.php";

$query = "
    SELECT 
        s.name AS layanan,
        q.queue_number,
        q.visitor_phone
    FROM queues q
    JOIN services s ON q.service_id = s.id
    WHERE DATE(q.appointment_date) = CURDATE()
    ORDER BY s.name ASC, q.queue_number ASC
";
$result = $conn->query($query);

$grouped = [];
while ($row = $result->fetch_assoc()) {
    $grouped[$row['layanan']][] = $row;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Antrian - Beauty Line</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link rel="stylesheet" href="style.css">
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
      .icon.active { background-color: #FFA5C0; }
      .icon.active a { pointer-events: none; }

      .main {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 30px;
        box-sizing: border-box;
        overflow-y: auto;
        background-size: 100vh;
      }

      .page-title {
        color: #9c5162;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 35px;
        text-align: center;
      }

      /* Wrapper: agar semua kolom layanan berjejer horizontal */
      .all-services {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 30px;
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
      }

      /* kolom per layanan */
      .service-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        min-width: 190px;
        max-width: 220px;
      }

      /* Header nama layanan */
      .service-header {
        background-color: #9c5162;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 30px;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
      }

      /* Kartu tiap antrian */
      .mini-ticket {
        width: 100%;
        background: 
          radial-gradient(circle at 50% 0,   transparent 18px, #EFBFC8 19px) top    / 100% 50% no-repeat,
          radial-gradient(circle at 50% 100%, transparent 18px, #EFBFC8 19px) bottom / 100% 50% no-repeat;
        border-radius: 14px;
        padding: 28px 20px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        color: #9c5162;
        filter: drop-shadow(0px 4px 10px rgba(0,0,0,0.10));
        text-align: center;
      }

      .ticket-label {
        font-size: 11px;
        font-weight: 600;
        opacity: 0.7;
        letter-spacing: 0.5px;
        text-transform: uppercase;
      }

      .ticket-big-number {
        font-size: 52px;
        font-weight: 700;
        line-height: 1;
      }

      .ticket-phone {
        font-size: 12px;
        font-weight: 600;
        opacity: 0.75;
      }

      .empty-msg {
        color: #b07080;
        font-size: 15px;
        font-weight: 500;
        margin-top: 40px;
      }

      /* hover */
      .service-header:hover{
        background-color: var(--hover-1);
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
          <div class="icon active">
            <a href="daftar-antrian.php">
              <i class="hgi hgi-stroke hgi-list-view"></i>Daftar Antrian
            </a>
          </div>
          <div class="icon">
            <a href="kartu_antrian.php">
              <i class="hgi hgi-stroke hgi-ticket-01"></i>Kartu Antrian
            </a>
          </div>
        </div>
      </div>

      <div class="main">
        <h1 class="page-title">Daftar Antrian</h1>

        <?php if (empty($grouped)): ?>
          <p class="empty-msg">Belum ada antrian hari ini.</p>
        <?php else: ?>
          <div class="all-services">
            <?php foreach ($grouped as $nama_layanan => $antrian_list): ?>
              <div class="service-group">

                <div class="service-header"><?= htmlspecialchars($nama_layanan) ?></div>

                <?php foreach ($antrian_list as $antrian): ?>
                  <div class="mini-ticket">
                    <div class="ticket-label">Nomor Antrian</div>
                    <div class="ticket-big-number">
                      <?= str_pad($antrian['queue_number'], 3, '0', STR_PAD_LEFT) ?>
                    </div>
                    <div class="ticket-phone"><?= htmlspecialchars($antrian['visitor_phone']) ?></div>
                  </div>
                <?php endforeach; ?>

              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </body>
</html>