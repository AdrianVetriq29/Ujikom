 <?php
include 'dbconn.php';
if(isset($_POST['keluar'])){

    $plat_no = mysqli_real_escape_string($conn, $_POST['plat_no']);

      $keluarquery =  "INSERT INTO k_keluar(plat_no, jam_masuk, jam_keluar, merk, keterangan)
                     		 SELECT plat_no,jam_masuk,NOW(),merk,keterangan FROM k_masuk WHERE plat_no = '$plat_no'";
      $mysqliquery = mysqli_query($conn, $keluarquery);

      $deletequery = "DELETE FROM k_masuk WHERE plat_no = '$plat_no'";
      $mysqliquery = mysqli_query($conn, $deletequery);

    if($keluarquery){
        ?>
    <script>
        window.location.replace("index.php");
    </script>

<?php 

    }else{
        echo 'Not Inserted';
    }



}



?>