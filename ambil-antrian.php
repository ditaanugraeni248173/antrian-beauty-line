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
    <title>Ambil Antrian - Beauty Line</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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

      .icon.active {
        background-color: #FFA5C0;
      }
      .icon.active a {
        pointer-events: none;
      }

    
      .main {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        box-sizing: border-box;
      }

      .form .btn-container {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      
      <div class="sidebar">
        <img src="img/vectorlogo.png" class="logo" />
        <img src="img/sidebar.png" class="sidebar-decor" />
        <div class="menu">
          
          <div class="icon active">
            <a href="ambil-antrian.php">
              <i class="hgi hgi-stroke hgi-user"></i>Ambil Antrian
            </a>
          </div>
          
          <div class="icon">
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
        
        <div class="form">
          <h2>Ambil Antrian</h2>
          
          <form action="action-antrian.php" method="post">
            
            <label>Nomor Telepon</label>
            <input name="no_telp" placeholder="Masukkan Nomor Telepon"/>
            
            <label>Loket</label>
            <select name="layanan">
              <?php 
              foreach($row as $opsi){
                echo "<option value='".$opsi[0]."'>".$opsi[1]."</option>";
              }
             ?>   
            </select>

            <div class="btn-container">
              <button class="btn-blue" type="submit">Ambil Antrian</button>
            </div>
          </form>
        </div>

      </div>

    </div>
  </body>
</html>