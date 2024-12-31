
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['kustomer_id'])) {
    header("Location: login.php");
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kustomer_id = $_SESSION['kustomer_id'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $jumlah_orang = $_POST['jumlah_orang'];
    
    // Ambil data kustomer
    $sql_kustomer = "SELECT nama, email FROM kustomer WHERE id='$kustomer_id'";
    $result_kustomer = $conn->query($sql_kustomer);
    $kustomer = $result_kustomer->fetch_assoc();

    $nama = $kustomer['nama'];
    $email = $kustomer['email'];

    $sql = "INSERT INTO reservasi (kustomer_id, tanggal, jam, nama, email, jumlah_orang) VALUES ('$kustomer_id', '$tanggal', '$jam', '$nama', '$email', '$jumlah_orang')";
    if ($conn->query($sql) === TRUE) {
        echo "Reservasi berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
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

  <title>Reservasi</title>


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
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="about.html"> About</a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link" href="menu.html">Menu</a>
              </li>

              <li class="nav-item" >
            <a class="nav-link" href="logout.php" style=" text-decoration: none; font-size: 16px;">Logout</a>
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
    <!-- end header section -->
   
    <div style=" min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px;">
  <form method="POST" style="max-width: 500px; padding: 40px; border: 1px solid #444; border-radius: 20px; background-color: #1e1e2f; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);">
    <label for="tanggal" style="display: block; margin-bottom: 15px; font-size: 18px; color: #f0f0f0;">Tanggal:</label>
    <input type="date" name="tanggal" required style="width: 100%; padding: 12px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 16px; background-color: #2a2a3b; color: #fff;">

    <label for="jam" style="display: block; margin-bottom: 15px; font-size: 18px; color: #f0f0f0;">Jam:</label>
    <input type="time" name="jam" required style="width: 100%; padding: 12px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 16px; background-color: #2a2a3b; color: #fff;">

    <label for="jumlah_orang" style="display: block; margin-bottom: 15px; font-size: 18px; color: #f0f0f0;">Jumlah Orang:</label>
    <input type="number" name="jumlah_orang" required style="width: 100%; padding: 12px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 16px; background-color: #2a2a3b; color: #fff;">

    <input type="submit" value="Reservasi" style="width: 100%; padding: 12px; font-size: 18px; color: #fff; background-color: #007bff; border: none; border-radius: 10px; cursor: pointer;">

    <!-- Pesan tambahan -->
    <p style="margin-top: 20px; font-size: 14px; color: #ddd; text-align: center;">
      Pastikan data Anda benar sebelum melakukan reservasi.
    </p>
  </form>
</div>

    
</div>

</div>
</body>
</html>