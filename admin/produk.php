<?php 
	include '../dbconnect.php';
			
	if(isset($_POST["addproduct"])) {
		$namaproduk=$_POST['namaproduk'];
		$idkategori=$_POST['idkategori'];
		$deskripsi=$_POST['deskripsi'];
		$dana=$_POST['dana'];
		$tenggatwaktu=$_POST['tenggatwaktu'];
		
		
		$nama_file = $_FILES['uploadgambar']['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$random = crypt($nama_file, time());
		$ukuran_file = $_FILES['uploadgambar']['size'];
		$tipe_file = $_FILES['uploadgambar']['type'];
		$tmp_file = $_FILES['uploadgambar']['tmp_name'];
		$path = "../produk/".$random.'.'.$ext;
		$pathdb = "produk/".$random.'.'.$ext;


		if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
		  if($ukuran_file <= 5000000){ 
			if(move_uploaded_file($tmp_file, $path)){ 
			
			  $query = "insert into produk (idkategori, namaproduk, gambar, deskripsi, dana, tenggatwaktu)
			  values('$idkategori','$namaproduk','$pathdb','$deskripsi','$dana','$tenggatwaktu')";
			  $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
			  
			  if($sql){ 
				
				echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
					
			  }else{
				// Jika Gagal, Lakukan :
				echo "Sorry, there's a problem while submitting.";
				echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
			  }
			}else{
			  // Jika gambar gagal diupload, Lakukan :
			  echo "Sorry, there's a problem while uploading the file.";
			  echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
			}
		  }else{
			// Jika ukuran file lebih dari 1MB, lakukan :
			echo "Sorry, the file size is not allowed to more than 1mb";
			echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
		  }
		}else{
		  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
		  echo "Sorry, the image format should be JPG/PNG.";
		  echo "<br><meta http-equiv='refresh' content='5; URL=produk.php'> You will be redirected to the form in 5 seconds";
		}
	
	};
	?>

<!doctype html>
<html class="no-js" lang="en">

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
			<i class='bx bxl-c-plus-plus'></i>
			<span class="logo-name">Kickfund</span>
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
				<img src="assets/images/admin.jpg" alt="profile">
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
	<h2 class="coba">Daftar Produk</h2>
	
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-produk btn-dark" id = "modal" data-toggle="modal" data-target="#myModal">
    Tambah Produk
  </button>
</div>
	

	
    <table id="customers">	
		<thead>
		<tr>
            <th>No.</th>
			<th>Gambar</th>
			<th>Nama Produk</th>
		    <th>Kategori</th>
			<th>Dana</th>
			<th>Deskripsi</th>
			<th>Tenggat Waktu</th>
			<th>Tanggal</th>
			<th>Aksi</th>
		</tr>
		</thead>	
		<tbody>
		<?php 
		    $brgs=mysqli_query($conn,"SELECT * from kategori k, produk p where k.idkategori=p.idkategori order by idproduk ASC");
			$no=1;
			
			while($p=mysqli_fetch_array($brgs)){
				$idproduk=$p['idproduk'];
			?>
												
                <tr>
                <td><?php echo $no++ ?></td>
                <td><img src="../<?php echo $p['gambar'] ?>" width="100%"\></td>
                <td><?php echo $p['namaproduk'] ?></td>
                <td><?php echo $p['namakategori'] ?></td>
			    <td><?php echo $p['dana'] ?></td>
				<td><?php echo $p['deskripsi'] ?></td>
				<td><?php echo $p['tenggatwaktu'] ?></td>
			    <td><?php echo $p['tgldibuat'] ?></td>
				<td>
				<form action="produk.php" method="post" enctype="multipart/form-data" >
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						Action
						</button>
						<div class="dropdown-menu">
						<input type="button" class="dropdown-item" data-toggle="modal" data-target="#produk<?php echo $idproduk ?>" value="Edit" \>
						<input type="submit" class="dropdown-item" name="hapus1" value="Delete" \>
					</div>
				</form>
				</td>							
                
				
				</tr>
				<div id="produk<?php echo $idproduk ?>" class="modal fade">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Edit Produk</h4>
																	</div>
																	<div class="modal-body">
																		<form action="produk.php" method="post" enctype="multipart/form-data" >
																		<div class="form-group">
																			<div class="form-group">
																				<label>Nama Produk</label>
																				<input name="editnamaproduk" type="text" class="form-control" value="<?php echo $p['namaproduk'] ?>" required autofocus>
																			</div>
																			<div class="form-group">
																				<label>Nama Kategori</label>
																				<select name="idkategori" class="form-control">
																				<option selected>Pilih Kategori</option>
																				<?php
																				$det=mysqli_query($conn,"select * from kategori order by namakategori ASC")or die(mysqli_error());
																				while($d=mysqli_fetch_array($det)){
																				?>
																					<option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
																					<?php
																			}
																			?>		
																				</select>
																				
																			</div>
																			<div class="form-group">
																				<label>Deskripsi</label>
																				<input name="editdeskripsi" type="textarea" class="form-control" value="<?php echo $p['deskripsi'] ?>" required>
																			</div>
																			<div class="form-group">
																				<label>Dana</label>
																				<input name="editdana" type="number" class="form-control" value="<?php echo $p['dana'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Gambar</label>
																				<input name="editgambar" type="file" class="form-control" value="<?php echo $p['gambar'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Tenggat Waktu</label>
																				<input name="edittenggatwaktu" type="date" class="form-control" value="<?php echo $p['tenggatwaktu'] ?>">
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
													$hapusin = mysqli_query($conn,"delete from pembayaran where idproduk='$idproduk'");
													if($hapusin){
														
														echo "<br><meta http-equiv='refresh' content='1; URL=produk.php'> Deleting";
													} else {
														echo "<br><meta http-equiv='refresh' content='1; URL=produk.php'> Failed";	
													}
												};
												
											if(isset($_POST["simpan2"])){
												$editnamaproduk = $_POST['editnamaproduk'];
												$editdeskripsi = $_POST['editdeskripsi'];
												$editdana = $_POST['editdana'];
												$editgambar = $_POST['editgambar'];
												$edittenggatwaktu = $_POST['edittenggatwaktu'];
													$simpanin = mysqli_query($conn,"update pembayaran set namaproduk='$editnamaproduk', deskripsi='$editdeskripsi', dana='$editdana', gambar='$editgambar', tenggatwaktu='$edittenggatwaktu' where idproduk='$idproduk'");
													if($simpanin){
														echo "<meta http-equiv='refresh' content='1; URL=produk.php'> Updating";
													} else {
														echo "<meta http-equiv='refresh' content='1; URL=produk.php'> Failed";	
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
							<h4 class="modal-title">Tambah Produk</h4>
						</div>
						
						<div class="modal-body">
						<form action="produk.php" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label>Nama Produk</label>
									<input name="namaproduk" type="text" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label>Nama Kategori</label>
									<select name="idkategori" class="form-control">
									<option selected>Pilih Kategori</option>
									<?php
									$det=mysqli_query($conn,"select * from kategori order by namakategori ASC")or die(mysqli_error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
										<?php
								}
								?>		
									</select>
									
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<input name="deskripsi" type="textarea" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Dana</label>
									<input name="dana" type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input name="uploadgambar" type="file" class="form-control">
								</div>
								<div class="form-group">
									<label>Tenggat Waktu</label>
									<input name="tenggatwaktu" type="date" class="form-control">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addproduct" type="submit" class="btn btn-dark" value="Tambah">
							</div>
						</form>
					</div>
				</div>
			</div>
</body>
</html>
