<?php
// mengaktifkan session php
session_start();

//Hubungkan dengan dbconn
include "dbconn.php";

// Fungsi Login
if (!isset($_SESSION["login"])) {
	header("location: login.php");
	exit;
}

// Fungsi Pencarian
function cari($keyword) {
	global $conn;
    $query = "SELECT * FROM k_masuk WHERE plat_no LIKE '%$keyword%' OR merk LIKE '%$keyword%'";
    return mysqli_query($conn, $query);
}

$query = 'SELECT * FROM k_masuk';
$mysqliquery = mysqli_query($conn, $query);

if (isset($_POST["btncari"])){
	$mysqliquery = cari($_POST['keyword']);
}
        

?>
<?php
$merkmotor = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Lainnya'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Program Parkir</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
</style>
</head>
<body>

<!-- Navbar -->
	<div class="navbarats">
		<div class="admin">
			ADMIN
		</div>
		<div class="btnlogout">
			<div class="d-flex flex-row-reverse">
				<div class="p-2">
					<br>
					<a name="logout" class="btn btn-danger" href="logout.php">Logout</a>
				</div>
				<div class="p-2">
					<br>
					<a name="list" class="btn btn-primary" href="list.php">Daftar Kendaraan</a>
				</div>
			</div>
		</div>
	</div>
	<div class="parkir">
		<hr></hr>
	</div>

<!-- Table Kendaraan Masuk -->
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
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Kendaraan Masuk</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Kendaraan Keluar</span></a>						
					</div>
				</div>
			</div>
			
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Plat_no</th>
						<th>Jam_Masuk</th>
						<th>Merk</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
			<?php
			include 'dbconn.php';
			$i = 1;
			// Perulangan while
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
						<?php echo $result['merk']; ?>
					</td>
					<td>
						<img src="gambar/<?php echo $result['keterangan'];?>" width="70" height="70">
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

<!-- Tambah Kendaraan -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="insert.php" enctype="multipart/form-data">
				<div class="modal-header">						
					<h4 class="modal-title">Masukkan Data Kendaraan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Plat_no</label>
						<input type="text" name="plat_no" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Merk</label>
						<select name="merk">
							<option value="<?php echo $merkmotor[0];?>"><?php echo $merkmotor[0];?></option>
							<option value="<?php echo $merkmotor[1];?>"><?php echo $merkmotor[1];?></option>
							<option value="<?php echo $merkmotor[2];?>"><?php echo $merkmotor[2];?></option>
							<option value="<?php echo $merkmotor[3];?>"><?php echo $merkmotor[3];?></option>
							<option value="<?php echo $merkmotor[4];?>"><?php echo $merkmotor[4];?></option>
                  				</select>
					</div>
					<div class="form-group">
						<label>Jam_masuk</label>
						<input readonly type="datetime" name="jam_masuk" value="<?= date('d/m/Y H:i:s'); ?>" required>
					</div>
					<div class="form-group">
						<label>Upload_gambar</label>
						<input type="file" name="keterangan" id="keterangan" accept="image/png, image/gif, image/jpeg, image/jpg" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
					<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Keluar Kendaraan -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="keluar.php">
				<div class="modal-header">						
					<h4 class="modal-title">Masukkan Data Kendaraan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Plat_no</label>
						<input type="text" name="plat_no" id="" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Jam_keluar</label>
						<input readonly type="datetime" name="jam_keluar" value="<?= date('d/m/Y H:i:s'); ?>" required>
					</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
					<input type="submit" class="btn btn-danger" value="Keluar" name="keluar">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>