<?php
require 'dbconnect.php';
require 'cek.php';

$idkode = $_GET['id'];

if(isset($_POST['confirm']))
	{
		
		$userid = $_SESSION['id'];
		$verifdonasiid = mysqli_query($conn,"select * from donasi where kodeid='$idkode'");
		$fetch = mysqli_fetch_array($verifdonasiid);
		$liat = mysqli_num_rows($verifdonasiid);
		
		if($fetch>0){
		$nama = $_POST['nama'];
		$metode = $_POST['metode'];
		$tanggal = $_POST['tanggal'];
			  
		$kon = mysqli_query($conn,"insert into konfirmasi (kodeid, userid, payment, namarekening, tglbayar) 
		values('$idkode','$userid','$metode','$nama','$tanggal')");
		if ($kon){
		
		$up = mysqli_query($conn,"update donasi set status='Terkonfirmasi' where kodeid='$idkode'");
		
		echo " <div class='alert alert-success'>
			Terima kasih telah melakukan konfirmasi, team kami akan melakukan verifikasi.
		  </div>
		<meta http-equiv='refresh' content='7; url= home.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal Submit, silakan ulangi lagi.
		  </div>
		 <meta http-equiv='refresh' content='3; url= konfirmasi.php'/> ";
		}
		} else {
			echo "<div class='alert alert-danger'>
			Kode Donasi tidak ditemukan, harap masukkan kembali dengan benar
		  </div>
		 <meta http-equiv='refresh' content='4; url= konfirmasi.php'/> ";
		}
		
		
	};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="SPA Example">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Handri Hermawan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/src/img/icon.ico" type="image/gif" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/koncss2.css">

    <title>Kickfund</title>
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

    <main class="as-main">

        <section id="galeri" class="as-section">
        
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Kickfund</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Kode Produk</label>
									<input name="kodeid" class="form-control" value="<?php echo $idkode ?>" disabled>
								</div>
                                <div class="form-group">
									<label>Informasi Pembayaran</label>
									<input name="nama" type="text" placeholder="Nama Pemilik Rekening/Sumber Dana" class="form-control" required>
								</div>
                                <div class="form-group">
									<label>Rekening Tujuan</label>
									<select name="metode" class="form-control">
						
                                        <?php
                                        $metode = mysqli_query($conn,"select * from pembayaran");
                                        
                                        while($a=mysqli_fetch_array($metode)){
                                        ?>
                                            <option value="<?php echo $a['metode'] ?>"><?php echo $a['metode'] ?> | <?php echo $a['norek'] ?></option>
                                            <?php
                                        };
                                        ?>
                                        
                                    </select>
								</div>
                                <div class="form-group">
									<label>Tanggal Bayar</label>
									<input name="tanggal" type="date" class="form-control" required>
								</div>

							</div>
							<div class="modal-footer">
								<input name="confirm" type="submit" class="btn btn-dark" value="Kirim">
							</div>
						</form>
					</div>
				</div>
			</div>

        </section>

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

    <script src="dist/js/app.js"></script>
</body>

</html>