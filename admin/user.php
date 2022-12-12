
<?php 
	
	include '../dbconnect.php';
		
	if(isset($_POST['adduser']))
	{
		$username = $_POST['uname'];
		$password = password_hash($_POST['upass'], PASSWORD_DEFAULT); 
			  
		$tambahuser = mysqli_query($conn,"insert into login values('','$username','$password')");
		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil menambahkan staff baru.
		  </div>
		<meta http-equiv='refresh' content='1; url= user.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal menambahkan staff baru.
		  </div>
		 <meta http-equiv='refresh' content='1; url= user.php'/> ";
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
	<h2 class="coba">Daftar Pelanggan</h2>
	</div>
	

	
    <table id="customers">	
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>No. Telepon</th>
			<th>Email</th>
		</tr>
		</thead>	
		<tbody>
			<?php 
			$brgs=mysqli_query($conn,"SELECT * from user order by userid ASC");
			$no=1;
			while($p=mysqli_fetch_array($brgs)){
				?>
				
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $p['nama'] ?></td>
					<td><?php echo $p['notelp'] ?></td>
					<td><?php echo $p['email'] ?></td>
					
				</tr>	
				
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
	
	
</body>
</html>
