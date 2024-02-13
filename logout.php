<?php
// mengaktifkan session php
session_start();
session_unset();
session_destroy();

// Ketika Logout akan berganti halaman ke login.php
header("location: login.php");
exit();
?>