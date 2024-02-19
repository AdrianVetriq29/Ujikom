<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Print</title>
</head>
<body>
   <center>DATA KENDARAAN</center>
   <br>

   <?php
   include 'dbconn.php';
   ?>
   <table cellspacing="0" border="1" cellpadding="8">
      <tr>
         <th width="1%">No</th>
         <th>Plat_no</th>
         <th>Jam_Masuk</th>
         <th>Jam_keluar</th>
         <th>Merk</th>
         <th>Keterangan</th>
      </tr>
      <?php
      $i = 1;
      $query = 'SELECT * FROM k_keluar';
      $mysqliquery = mysqli_query($conn, $query);
      while ($result = mysqli_fetch_assoc($mysqliquery)) {
            ?>
            <tr>
               <td>
                        <?= $i; ?>
                     </td>
               <td>
                  <?php echo $result['plat_no']; ?>
               </td>
               <td>
                  <?php echo $result['jam_masuk']; ?>
               </td>
               <td>
                  <?php echo $result['jam_keluar']; ?>
               </td>
               <td>
                  <?php echo $result['merk']; ?>
               </td>
               <td>
                  <img src="gambar/<?php echo $result['keterangan'];?>" width="100" height="100">
               </td>
            </tr>
            <?php
            $i++;
         }
      ?>
   </table>
   <script>
      window.print()
   </script>
</body>
</html>