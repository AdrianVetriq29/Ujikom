<?php
// Menghubungkan dengan dbconn
include 'dbconn.php';

// Fungsi button tambah
if(isset($_POST['tambah'])){

    $plat_no = mysqli_real_escape_string($conn, $_POST['plat_no']);
    $jam_masuk = mysqli_real_escape_string($conn, $_POST['jam_masuk']);
    $merk = mysqli_real_escape_string($conn, $_POST['merk']);

    $namaFile = $_FILES['keterangan']['name'];
    $tmpFile = $_FILES['keterangan']['tmp_name'];

    $ceksql = "SELECT * FROM k_masuk WHERE plat_no = '$plat_no'";
    $cekdata = mysqli_query($conn, $ceksql);

    $cek = mysqli_num_rows($cekdata);

    // Cek Apakah data berhasil di tambahkan
    if ($cek == 0) {
      $insertquery =  "INSERT INTO k_masuk(plat_no, jam_masuk, merk, keterangan)
                     VALUES ('$plat_no',NOW(),'$merk','$namaFile')";
        $mysqliquery = mysqli_query($conn, $insertquery);
        move_uploaded_file($tmpFile, "gambar/$namaFile");
        if($insertquery){
            ?>
        <script type="text/javascript">
            alert("Data Berhasil Ditambahkan!");
            window.location.replace("index.php");
        </script>

        <?php 

        }else{
            echo 'Not Inserted';
        }
    } else {
?>
<script type="text/javascript">
    alert("Data Sudah Tersedia!");
    window.location='index.php';
</script>
<?php
    }

}

?>