<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Cek apakah email sudah terdaftar
    $sql_check = "SELECT * FROM kustomer WHERE email='$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Email sudah terdaftar! Silakan gunakan email lain.";
    } else {
        $sql = "INSERT INTO kustomer (nama, email, telepon, password) VALUES ('$nama', '$email', '$telepon', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registrasi berhasil! Silakan login.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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

  <title>Registrasi</title>


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
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.html">Menu</a>
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
   
    <div style=" min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 10px;">
  <form method="POST" style="max-width: 600px; padding: 50px; border: 1px solid #444; border-radius: 20px; background-color: #1e1e2f; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);">
    <label for="nama" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Nama:</label>
    <input type="text" name="nama" required style="width: 100%; padding: 10px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">

    <label for="email" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Email:</label>
    <input type="email" name="email" required style="width: 100%; padding: 10px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">

    <label for="telepon" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Telepon:</label>
    <input type="text" name="telepon" required style="width: 100%; padding: 10px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">

    <label for="password" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Password:</label>
    <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">

    <input type="submit" value="Daftar" style="width: 100%; padding: 10px; font-size: 20px; color: #fff; background-color: #007bff; border: none; border-radius: 10px; cursor: pointer;">

    <!-- Link ke halaman login -->
    <p style="margin-top: 20px; font-size: 16px; color: #ddd; text-align: center;">
      Sudah punya akun? <a href="login.php" style="color: #007bff; text-decoration: none;">Login di sini</a>.
    </p>
  </form>
</div>


</div>
</body>
</html>