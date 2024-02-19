<?php
include "dbconn.php";

// Fungsi Pencarian
function cari($keyword) {
	global $conn;
    $query = "SELECT * FROM k_keluar WHERE plat_no LIKE '%$keyword%' OR merk LIKE '%$keyword%'";
    return mysqli_query($conn, $query);
}

$query = 'SELECT * FROM k_keluar';
$mysqliquery = mysqli_query($conn, $query);

if (isset($_POST["btncari"])){
	$mysqliquery = cari($_POST['keyword']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<title>Daftar Kendaraan</title>
</head>
<body>
<!-- Navbar -->
	<div class="navbarats">
		<div class="admin">
			Daftar Kendaraan 
		</div>
		<div class="btnback">
			<div class="d-flex flex-row-reverse">
				<div class="p-2">
					<br>
					<a name="back" class="btn btn-danger" href="index.php">Back</a>
				</div>
				<div class="p-2">
					<br>
					<a href="report.php" name="print" class="btn btn-success" target="_blank">Print</a>
				</div>
			</div>
		</div>
	</div>
	<div class="parkir">
		<hr></hr>
	</div>

<!-- Table Daftar Kendaraan -->
<form method="post" action="">
	<div class="pencarian">
		<input type="text" name="keyword" size="40" autofocus placeholder="Masukkan Keyword Pencarian.." autocomplete="off">
		<button type="submit" name="btncari">cari</button>
	</div>
</form>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Parkirin <b>Aja</b></h2>
					</div>
				</div>
			</div>
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Plat_no</th>
						<th>Jam_Masuk</th>
						<th>Jam_keluar</th>
						<th>Merk</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
			<?php

			// Menghubungkan dengan dbconn
			include 'dbconn.php';

			// Kendaraan yang sudah keluar akan muncul di table ini
			$i = 1;
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
				</tbody>
			</table>
	</div>        
</div>
</body>
</html>