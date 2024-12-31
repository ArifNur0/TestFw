<?php
session_start();
include 'db.php';

// Cek apakah pengguna sudah login sebagai karyawan
if (!isset($_SESSION['karyawan_id'])) {
    header("Location: login.php");
    exit();
}

// Menangani penerimaan atau penolakan reservasi
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'terima') {
        $sql_update = "UPDATE reservasi SET status='diterima' WHERE id='$id'";
    } elseif ($action == 'tolak') {
        $sql_update = "UPDATE reservasi SET status='ditolak' WHERE id='$id'";
    }

    if ($conn->query($sql_update) === TRUE) {
        echo "Status reservasi berhasil diperbarui!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Mengambil daftar reservasi yang menunggu persetujuan
$reservasi = $conn->query("SELECT r.id, k.nama AS kustomer_nama, k.email AS kustomer_email, k.telepon AS kustomer_telepon, r.tanggal, r.jam, r.jumlah_orang, r.status 
                            FROM reservasi r 
                            JOIN kustomer k ON r.kustomer_id = k.id 
                            WHERE r.status = 'pending'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <!-- <link rel="icon" href="images/fevicon.png" type="image/gif" /> -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Home</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.php">
          <span>Bakso Ojo Lali</span>
          <img src="img/bakso.png" alt="Logo Bakso Ojo Lali" width="50" height="50">
        </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              
              <li class="nav-item">
                <a class="nav-link" href="logout.php"> Logout</a>
              </li>
              
              
            </ul>
            <div class="quote_btn-container">
              <form class="form-inline">
                
              </form>
             
            </div>
          </div>
        </nav>
      </div>
    </header>
    <table border="1" style="border-collapse: collapse; width: 100%; text-align: left; font-family: Arial, sans-serif; margin: 20px 0; background-color: #333;">
    <tr style="background-color: #444; color: white;">
     
        <th style="padding: 10px; border: 1px solid #555;">Nama Kustomer</th>
        <th style="padding: 10px; border: 1px solid #555;">Email Kustomer</th>
        <th style="padding: 10px; border: 1px solid #555;">Telepon Kustomer</th>
        <th style="padding: 10px; border: 1px solid #555;">Tanggal</th>
        <th style="padding: 10px; border: 1px solid #555;">Jam</th>
        <th style="padding: 10px; border: 1px solid #555;">Jumlah Orang</th>
        <th style="padding: 10px; border: 1px solid #555;">Status</th>
        <th style="padding: 10px; border: 1px solid #555;">Aksi</th>
    </tr>
    <?php while ($row = $reservasi->fetch_assoc()): ?>
    <tr style="background-color: #555; color: white; text-align: center;">

        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['kustomer_nama']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['kustomer_email']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['kustomer_telepon']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['tanggal']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['jam']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['jumlah_orang']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;"><?php echo $row['status']; ?></td>
        <td style="padding: 8px; border: 1px solid #666;">
            <a href="?action=terima&id=<?php echo $row['id']; ?>" 
               style="color: #ffffff; background-color: #4CAF50; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: none; margin-right: 5px;" 
               onclick="return confirm('Apakah Anda yakin ingin menerima reservasi ini?');">Terima</a>
            <a href="?action=tolak&id=<?php echo $row['id']; ?>" 
               style="color: #ffffff; background-color: #f44336; padding: 5px 10px; text-decoration: none; border-radius: 5px; border: none;" 
               onclick="return confirm('Apakah Anda yakin ingin menolak reservasi ini?');">Tolak</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


    

</div>
</body>
</html>