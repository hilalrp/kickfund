
<?php 
	
	include '../dbconnect.php';
		
	if(isset($_POST['addcategory']))
	{
		$namakategori = $_POST['namakategori'];
			  
		$tambahkat = mysqli_query($conn,"insert into kategori (namakategori) values ('$namakategori')");
		if ($tambahkat){
		echo "
		<meta http-equiv='refresh' content='1; url= kategori.php'/>  ";
		} else { echo "
		 <meta http-equiv='refresh' content='1; url= kategori.php'/> ";
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
				<a href="#">
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
	<h2 class="coba">Daftar Donasi</h2>
	
    <table id="customers">	
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Investor</th>
			<th>ID Donasi</th>
			<th>Produk yang dipilih</th>
			<th>Jumlah Donasi</th>
			<th>Metode Pembayaran</th>
			<th>Tanggal Pembayaran</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
		</thead>	
		<tbody>
			<?php
				$query = "SELECT * FROM donasi ORDER BY iddonasi ASC";
				$result = mysqli_query($conn, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($conn)." - ".mysqli_error($conn));
				}
				$no = 1;

				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['iddonasi'];
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php 
												
						$result1 = mysqli_query($conn,"SELECT u.nama AS namainvestor FROM donasi d, user u where d.userid=u.userid");
						$cekrow = mysqli_num_rows($result1);
						$row1 = mysqli_fetch_assoc($result1);
						$namainvestor = $row1['namainvestor'];
						echo $namainvestor
						?></td>
					<td><?php echo $row['iddonasi'];?></td>
					<td><?php 
						$result2 = mysqli_query($conn,"SELECT p.namaproduk AS namaproduk FROM produk p, donasi d where p.idproduk=d.idproduk");
						$cekrow2 = mysqli_num_rows($result2);
						$row2 = mysqli_fetch_assoc($result2);
						$namaproduk = $row2['namaproduk'];
						echo $namaproduk;
						?>
					</td>
					<td><?php echo $row['jumlah'] ?></td>
					<td><?php 
						$result4 = mysqli_query($conn,"SELECT ko.payment AS metodepembayaran FROM konfirmasi ko, donasi d where ko.kodeid=d.kodeid");
						$cekrow4 = mysqli_num_rows($result4);
						$row4 = mysqli_fetch_assoc($result4);
						$metodepembayaran = $row4['metodepembayaran'];
						echo $metodepembayaran;
						?>
					</td>
					<td><?php 
						$result3 = mysqli_query($conn,"SELECT ko.tglbayar AS tanggalbayar FROM konfirmasi ko, donasi d where ko.kodeid=d.kodeid");
						$cekrow3 = mysqli_num_rows($result3);
						$row3 = mysqli_fetch_assoc($result3);
						$tanggalbayar = $row3['tanggalbayar'];
						echo $tanggalbayar;
						?>
					</td>
					<td><?php echo $row['status'] ?></td>
					<td>
					<form action="payment.php" method="post" enctype="multipart/form-data" >
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							Action
							</button>
							<div class="dropdown-menu">
							<input type="button" class="dropdown-item" data-toggle="modal" data-target="#donasi<?php echo $iddonasi ?>" value="Setujui" \>
							<input type="submit" class="dropdown-item" name="tolak" value="Tolak" \>
						</div>
					</form>
					</td>	

				</tr>
				<?php
					$no++;
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
							<h4 class="modal-title">Tambah Kategori</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama Kategori</label>
									<input name="namakategori" type="text" class="form-control" required autofocus>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addcategory" type="submit" class="btn btn-dark" value="Tambah">
							</div>
						</form>
					</div>
				</div>
			</div>
</body>
</html>
