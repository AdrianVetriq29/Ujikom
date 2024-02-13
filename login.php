<?php 
// Mengaktifkan session php
session_start();
 
// Menghubungkan dengan dbconn
include 'dbconn.php';

// Fungsi button Login
if (isset($_SESSION['login'])) {
	header("location: index.php");
	exit;
}
 
// Menangkap data yang dikirim dari form
if (isset($_POST["login"])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
 
	// Menyeleksi data admin dengan username dan password yang sesuai
	$data = mysqli_query($conn,"SELECT * from users where username='$username'");
	if (mysqli_num_rows($data) === 1) {
		$row = mysqli_fetch_assoc($data);
		if($password == $row["password"]){
			$_SESSION['login'] = true;

			header("location: index.php");
			exit;
		}
	}

	$error = true;

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylelog.css">
  <title>Program Parkir</title>
</head>
<body>
  <div class="container">
    <form method="post" class="login-form" action="">
      <h1>ParkirinAja</h1>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username"
        required />
      </div>

      <div class="input-box">
        <input type="password" name="password" placeholder="Password"
        required />
      </div>

      <button type="submit" class="btn" name="login">Login</button>
    </form>
  </div>
</body>
</html>
