<?php
include "config.php";
 
// Ambil semua antrian hari ini, dikelompokkan per layanan, urut nomor antrian
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
 
// Kelompokkan data per layanan
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
      /* --- Perbaikan Struktur Sidebar agar Bisa Diklik Kena Semua --- */
      .sidebar .menu {
        display: flex;
        flex-direction: column;
        gap: 5px;
      }

      .icon {
        padding: 0 !important; /* Hilangkan padding asli agar link memenuhi kotak */
        overflow: hidden;
      }

      .icon a {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 15px; /* Pindahkan padding ke sini agar area klik luas */
        box-sizing: border-box;
        color: var(--text);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        height: 100%;
      }

      /* Highlight warna khusus halaman aktif (Daftar Antrian) */
      .icon.active {
        background-color: #FFA5C0;
      }
      .icon.active a {
        pointer-events: none;
      }

      /* --- Layout Utama Konten Kanan --- */
      .main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 40px;
        box-sizing: border-box;
      }

      .page-title {
        color: #9c5162;
        font-size: 28px;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 40px;
        text-align: center;
      }

      /* --- CONTAINER TIKET BERJEJER (FLEXBOX) --- */
      .cards-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 25px; /* Jarak antar kartu */
        width: 100%;
        max-width: 850px;
        margin-top: 10px;
      }

      /* --- STYLING KARTU MINI (DENGAN COAKAN ATAS & BAWAH) --- */
      .mini-ticket {
        flex: 1;
        max-width: 240px;
        height: 340px;
        /* Membuat pola setengah lingkaran di bagian ATAS dan BAWAH kartu */
        background: 
          radial-gradient(circle at 50% 0, transparent 20px, #EFBFC8 21px) top center / 100% 50% no-repeat,
          radial-gradient(circle at 50% 100%, transparent 20px, #EFBFC8 21px) bottom center / 100% 50% no-repeat;
        border-radius: 15px;
        padding: 40px 20px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Membuat teks atas, nomor di tengah, layanan di bawah */
        align-items: center;
        color: #9c5162;
        filter: drop-shadow(0px 8px 15px rgba(0, 0, 0, 0.12));
        text-align: center;
      }

      .ticket-info-text {
        font-size: 13px;
        font-weight: 600;
        margin-top: 10px;
      }

      .ticket-big-number {
        font-size: 55px;
        font-weight: 700;
        line-height: 1;
      }

      .ticket-service-name {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 10px;
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