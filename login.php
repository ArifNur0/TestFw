<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Pastikan user_type ada dalam POST
    if (isset($_POST['user_type'])) {
        $user_type = $_POST['user_type'];

        if ($user_type == 'kustomer') {
            // Login untuk kustomer
            $sql = "SELECT * FROM kustomer WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['kustomer_id'] = $row['id'];
                    header("Location: kustomer.php");
                    exit();
                } else {
                    echo "Password salah!";
                }
            } else {
                echo "Email tidak terdaftar!";
            }
        } elseif ($user_type == 'karyawan') {
            // Login untuk karyawan
            $sql = "SELECT * FROM karyawan WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['karyawan_id'] = $row['id'];
                    header("Location: karyawan.php");
                    exit();
                } else {
                    echo "Password salah!";
                }
            } else {
                echo "Email tidak terdaftar!";
            }
        }
    } else {
        echo "Tipe pengguna tidak ditentukan!";
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

  <title>Login</title>


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
                <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
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
  <form method="POST" style="max-width: 600px; padding: 80px; border: 1px solid #444; border-radius: 20px; background-color: #1e1e2f; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);">
    <label for="email" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Email:</label>
    <input type="email" name="email" required style="width: 100%; padding: 14px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">

    <label for="password" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Password:</label>
    <input type="password" name="password" required style="width: 100%; padding: 14px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">

    <label for="user_type" style="display: block; margin-bottom: 15px; font-size: 20px; color: #f0f0f0;">Login sebagai:</label>
    <select name="user_type" required style="width: 100%; padding: 14px; margin-bottom: 25px; border: 1px solid #666; border-radius: 10px; font-size: 18px; background-color: #2a2a3b; color: #fff;">
      <option value="kustomer" style="color: #000;">Kustomer</option>
      <option value="karyawan" style="color: #000;">Karyawan</option>
    </select>

    <input type="submit" value="Login" style="width: 100%; padding: 14px; font-size: 20px; color: #fff; background-color: #007bff; border: none; border-radius: 10px; cursor: pointer;">

    
    <p style="margin-top: 20px; font-size: 16px; color: #ddd; text-align: center;">
      Belum punya akun? <a href="register.php" style="color: #007bff; text-decoration: none;">Daftar di sini</a>.
    </p>
  </form>
</div>

 




</div>
</body>
</html>