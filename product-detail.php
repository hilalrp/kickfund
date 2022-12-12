<?php
require 'dbconnect.php';
require 'cek.php';

$idproduk = $_GET['idproduk'];


if(isset($_POST['donasi']))
	{
		$ui = $_SESSION['id'];
		$cek = mysqli_query($conn,"select * from donasi where idproduk='$idproduk'");
		$liat = mysqli_num_rows($cek);
		$f = mysqli_fetch_array($cek);
		$orid = $f['idproduk'];
		
		if($liat>0)	{
			$oi = crypt(rand(22,999),time());
			$ui = $_SESSION['id'];
			$jumlah = $_POST['jumlah'];
			
				
			$tambahdonasi = mysqli_query($conn,"insert into donasi (kodeid,idproduk,userid,jumlah) values ('$oi','$idproduk','$ui','$jumlah')");
			if ($tambahdonasi){
			echo "
			<meta http-equiv='refresh' content='1; url= pembayaran.php?idproduk=".$idproduk."'/>  ";
			} else { echo "
			<meta http-equiv='refresh' content='1; url= pembayaran.php?idproduk=".$idproduk."'/> ";
		}
			
		} else {
			$oi = crypt(rand(22,999),time());
			$ui = $_SESSION['id'];
			$jumlah = $_POST['jumlah'];
				
			$tambahdonasi = mysqli_query($conn,"insert into donasi (kodeid,idproduk,userid,jumlah) values ('$oi','$idproduk','$ui','$jumlah')");
			if ($tambahdonasi){
			echo "
			<meta http-equiv='refresh' content='1; url= pembayaran.php?idproduk=".$idproduk."'/>  ";
			} else { echo "
			<meta http-equiv='refresh' content='1; url= pembayaran.php?idproduk=".$idproduk."'/> ";
		}
	}	
};	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kickfund</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
	<link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/apppp.css">
	<link rel="stylesheet" href="css/sccss2.css">
</head>
<body>

<header class="as-header" id="header">
        <nav class="as-nav as-container">
            <a href="#" class="as-nav__logo">Kickfund</a>

            <div class="as-nav__menu" id="nav-menu">
                <ul class="as-nav__list">
					<li class="as-nav__item"><a href="home.php" class="as-nav__link active-link">Home</a></li>
                    <li class="as-nav__item"><a href="product-list.php" class="as-nav__link">Galeri</a></li>
                    <li class="as-nav__item"><a href="transaksi.php" class="as-nav__link">Transaksi</a></li>
                    <li class="as-nav__item"><a href="logout.php" class="as-nav__link">Logout</a></li>
                </ul>
            </div>

            <div class="as-nav__toggle" id="nav-toggle">
                <i class="bx bx-menu"></i>
            </div>
        </nav>
    </header>

	<main>
		
		<div class="product-header">
			<div class="wrapper">
				<div class="breadcrumb">
					
				</div>
				<?php 
				$p = mysqli_fetch_array(mysqli_query($conn,"Select * from produk where idproduk='$idproduk'"));
				
				?>

				<h1><?php echo $p['namaproduk'] ?></h1>

				<h3>Rp<?php echo $p['dana'] ?></h3>

				<div class="share-btn">
					<ion-icon name="logo-facebook"><ion-icon>
					<ion-icon name="logo-twitter"><ion-icon>
					<ion-icon name="logo-pinterest"><ion-icon>
				</div>
			</div>
		</div>

		<div class="product-body">
			<div class="wrapper">
				<div class="product-body-grid">
					<div class="product-photo">
						<img src="<?php echo $p['gambar']?>">
					</div>
					<div class="product-details">
										

						<div class="product-description">
							<h5>Deskripsi Produk</h5>

							<div>
								<p><?php echo $p['deskripsi'] ?></p>
							</div>
						</div>
						<p></p>
						<div class="product-controls">
							<button style="margin-top:50px;" type="button" class="btn btn-payment btn-dark" id = "modal" data-toggle="modal" data-target="#myModal">
								Investasi Sekarang
							</button>
						</div>

					</div>
				</div>				
			</div>
		</div>
		<!-- The Modal -->
	<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Kickfund</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Jumlah</label>
									<input placeholder="Masukkan Jumlah" name="jumlah" type="number" class="form-control" required>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="donasi" type="submit" class="btn btn-dark" value="Investasi">
							</div>
						</form>
					</div>
				</div>
			</div>
		
	</main>
	<footer id="footer" class="as-section as-footer">
        <div class="as-container">
            <div class="as-footer__container">
                <div class="as-footer__content">
                    <a href="#" class="as-footer__social" aria-label="socmed"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="as-footer__social" aria-label="socmed"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="as-footer__social" aria-label="socmed"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="as-footer__social" aria-label="socmed"><i class="bx bxl-youtube"></i></a>
                </div>

                <div class="as-footer__content">
                    <a href="#" class="as-footer__link">Hubungi Kami</a>
                </div>

                <div class="as-footer__content">
                    <a href="#" class="as-footer__link">Syarat & Ketentuan</a>
                </div>

                <div class="as-footer__content">
                    <a href="#" class="as-footer__link">Kebijakan Privasi</a>
                </div>
            </div>
            <p class="as-footer__copy">&#169; 2022 Kickfund. All right reserved</p>
        </div>
    </footer>
</body>
</html>