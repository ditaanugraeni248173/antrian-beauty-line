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
    <link rel="stylesheet" href="style2.css">
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

    <!-- main -->
    <div class="main">
      <h1 class="title">Kartu Antrian</h1>
      
      <div class="card">
        
        <h1>Nomor Antrian</h1>
        <div class="info">
          <div class="row">
            <span>Nomor Telepon</span>
            <span>:</span>
            <span>081234567890</span>
          </div>

          <div class="row">
            <span>Loket</span>
            <span>:</span>
            <span>Facial Treatment</span>
          </div>
        </div>

        <div class="queue-number">002</div>
      </div>

      <!-- button -->
      <div class="btn">
        <button>Ambil Antrian Baru</button>
      </div>
      
    </div>
   
    
  </body>
</html>
