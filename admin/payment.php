
<?php 
	
	include '../dbconnect.php';
		
	if(isset($_POST['addmethod']))
	{
		$metode = $_POST['metode'];
		$norek = $_POST['norek'];
		$an = $_POST['an'];
		$logo = $_POST['logo'];
			  
		$tambahmet = mysqli_query($conn,"insert into pembayaran (metode,norek,an,logo) values ('$metode','$norek','$an','$logo')");
		if ($tambahmet){
		echo "
		<meta http-equiv='refresh' content='1; url= payment.php'/>  ";
		} else { echo "
		 <meta http-equiv='refresh' content='1; url= payment.php'/> ";
		}
		
	};
	?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard| Kickfund</title>
	<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<!-- sidebar -->
	<div class="sidebar">
		<div class="logo-details">
			<div class="logo-content">
				<img src="assets/images/logo_putih.png" width=80 height=90 alt="logo">
			</div>
			<div class="name">
				<div class="logo-name">Kickfund</div>
			</div>
			
		</div>
		<ul class="nav-links">
			<li>
				<a href="dashboard.php">
					<i class='bx bx-grid-alt'></i>
					<span class="link_name">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="donasi.php">
					<i class='bx bx-donate-heart' ></i>
					<span class="link_name">Kelola Donasi</span>
				</a>
			</li>
			<li>
				<div class="icon-link">
					<a href="#">
						<i class='bx bx-collection'></i>
						<span class="link_name">Kelola Usaha</span>
					</a>
					<i class='bx bxs-chevron-down arrow'></i>
				</div>
				<ul class="sub-menu">
					<li><a href="kategori.php">Kategori</a></li>
					<li><a href="produk.php">Produk</a></li>
					<li><a href="payment.php">Metode Pembayaran</a></li>			
				</ul>
			</li>
			<li>
				<a href="user.php">
					<i class='bx bxs-user-account'></i>
					<span class="link_name">Kelola User</span>
				</a>
			</li>
			<li>
		<div class="profile-details">
			<div class="profile-content">
				<img src="assets/images/admin.png" alt="profile">
			</div>
			<div class="name-job">
				<div class="profile-name">Admin</div>
				<div class="job">Kickfund</div>
			</div>
			<a href="logout.php">
				<i class='bx bx-log-out'></i>
			</a>
		</div>
		</li>
	</ul>
	</div>  
	<div class="coba">
	<h2 class="coba">Daftar Metode Pembayaran</h2>
	
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-payment btn-dark" id = "modal" data-toggle="modal" data-target="#myModal">
    Tambah Pembayaran
  </button>
</div>
	

	
    <table id="customers">	
		<thead>
		<tr>
            <th>No.</th>
			<th>Nama Pembayaran</th>
			<th>No.Pembayaran</th>
			<th>Atas Nama</th>
			<th>URL Logo</th>
			<th>Aksi</th>
		</tr>
		</thead>	
		<tbody>
			<?php 
			$brgs=mysqli_query($conn,"SELECT * from pembayaran order by no ASC");
			$no=1;
		    while($p=mysqli_fetch_array($brgs)){
				$id = $p['no'];

			?>
												
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $p['metode'] ?></td>
                <td><?php echo $p['norek'] ?></td>
                <td><?php echo $p['an'] ?></td>
                
                <td><?php echo $p['logo'] ?></td>
				<td>
				<form action="payment.php" method="post" enctype="multipart/form-data" >
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						Action
						</button>
						<div class="dropdown-menu">
						<input type="button" class="dropdown-item" data-toggle="modal" data-target="#pembayaran<?php echo $id ?>" value="Edit" \>
						<input type="submit" class="dropdown-item" name="hapus1" value="Delete" \>
					</div>
				</form>
				</td>	
													
                </tr>		
                <div id="pembayaran<?php echo $id ?>" class="modal fade">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Edit Metode Pembayaran</h4>
																	</div>
																	<div class="modal-body">
																		<form action="payment.php" method="post" enctype="multipart/form-data" >
																			<div class="form-group">
																				<label>Nama Pembayaran</label>
																				<input name="editmetode" type="text" class="form-control" value="<?php echo $p['metode'] ?>">
																			</div>
																			<div class="form-group">
																				<label>No.rek/No.Telp</label>
																				<input name="editnorek" type="text" class="form-control" value="<?php echo $p['norek'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Atas nama</label>
																				<input name="editan" type="text" class="form-control" value="<?php echo $p['an'] ?>">
																			</div>
																			<div class="form-group">
																				<label>URL Logo</label>
																				<input name="editlogo" type="text" class="form-control" value="<?php echo $p['logo'] ?>">
																			</div>

																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																			<input type="submit" name="simpan2" class="btn btn-primary" value="Simpan">
																		</div>
																	</form>
																</div>
															</div>
														</div>
                <?php 
            }

			if(isset($_POST["hapus1"])){
				$hapusin = mysqli_query($conn,"delete from pembayaran where no='$id'");
				if($hapusin){
					
					echo "<br><meta http-equiv='refresh' content='1; URL=payment.php'> Deleting";
				} else {
					echo "<br><meta http-equiv='refresh' content='1; URL=payment.php'> Failed";	
				}
			};
			
		if(isset($_POST["simpan2"])){
			$editmetode = $_POST['editmetode'];
			$editnorek = $_POST['editnorek'];
			$editan = $_POST['editan'];
			$editlogo = $_POST['editlogo'];
				$simpanin = mysqli_query($conn,"update pembayaran set metode='$editmetode', norek='$editnorek', an='$editan', logo='$editlogo' where no='$id'");
				if($simpanin){
					echo "<meta http-equiv='refresh' content='1; URL=payment.php'> Updating";
				} else {
					echo "<meta http-equiv='refresh' content='1; URL=payment.php'> Failed";	
				}
			
		?>		

<?php 

}

            
            ?>
        </tbody>
	</table>
	<script>		
		let arrow = document.querySelectorAll(".arrow");
		for (var i = 0; i < arrow.length; i++) {
			arrow[i].addEventListener("click", (e)=>{
			let arrowParent = e.target.parentElement.parentElement;
			arrowParent.classList.toggle("showMenu");
			});
		}

		let sidebar = document.querySelectorAll(".sidebar");
		console.log(sidebar);

	</script>
	
	<!-- The Modal -->
	<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Metode</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama Pembayaran</label>
									<input name="metode" type="text" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label>No.rek/No.Telp</label>
									<input name="norek" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Atas Nama</label>
									<input name="an" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>URL Logo</label>
									<input name="logo" type="text" class="form-control" required>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addmethod" type="submit" class="btn btn-dark" value="Tambah">
							</div>
						</form>
					</div>
				</div>
			</div>
	
</body>
</html>
