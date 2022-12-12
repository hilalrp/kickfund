<?php
require 'dbconnect.php';
require 'cek.php';

$iddonasi = $_GET['iddonasi'];


$uid = $_SESSION['id'];
	$caridonasi = mysqli_query($conn,"select * from donasi where userid='$uid' and status='proses'");
	$fetc = mysqli_fetch_array($caridonasi);
	$kodeidd = $fetc['kodeid'];
	$itungtrans = mysqli_query($conn,"select count(iddonasi) as jumlahtrans from donasi where kodeid='$kodeidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
if(isset($_POST["bayar"])){
	
	$q3 = mysqli_query($conn, "update donasi set status='Terbayar' where kodeid='$kodeidd'");
	if($q3){
		echo "Berhasil Check Out
		<meta http-equiv='refresh' content='1; url= home.php'/>";
	} else {
		echo "Gagal Check Out
		<meta http-equiv='refresh' content='1; url= home.php'/>";
	}
} else {
	
}
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
    <link rel="stylesheet" href="css/sccss.css">
    <link rel="stylesheet" href="css/apppp.css">

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
            <div class="as-container">
                <h2 class="as-section__title">Lanjutkan Pembayaran</h2>
                <p class="as-section__description">Pastikan data produk yang ingin anda investasikan sudah benar</p>
                <div >
                    <div >
                        <table >
                            <tr>
                                <th>
                                    <h2 style="text-align: left;">Data Produk</h2>
                                </th>
                            </tr>
                        </table>
        <table id="customers">	
		<thead>
		<tr>
            <th>No.</th>
			<th>Gambar</th>
			<th>Nama Produk</th>
			<th>Jumlah Investasi</th>
			
		</tr>
		</thead>	
		<tbody>
		<?php 
		    $brgs=mysqli_query($conn,"SELECT * from donasi d, produk p where kodeid='$kodeidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
			$no=1;
			while($p=mysqli_fetch_array($brgs)){

			?>
			<form method="post">									
                <tr>
                <td><?php echo $no++ ?></td>
                <td><img src="<?php echo $p['gambar'] ?>" width="100px"\></td>
                <td><?php echo $p['namaproduk'] ?></td>
			    <td>Rp.<?php echo $p['jumlah'] ?></td>
													
				</tr>		
            </form>									
			<?php 
			}
		?>
        </tbody>
        </table>
                        <p></p>
                            <table style="border: 0px;" id="customerss">
                            <?php 
                                    $metode = mysqli_query($conn,"SELECT * from donasi d, produk p where kodeid='$kodeidd' and d.idproduk=p.idproduk order by d.idproduk ASC");
                                    
                                    while($p=mysqli_fetch_array($metode)){
                                        
                                    ?>
                            <tr>
                                <p style="background-color: #6d519d; color: white;">Total Harga : </p>
                                <h1>Rp. <?php echo $p['jumlah'] ?></h1>
                            </tr>
                            <tr>
                                <p style="background-color: #6d519d; color: white;">Kode Pembayaran : </p>
                                <h1><?php echo $kodeidd ?> </h1>
                            </tr>
                                <?php
                                }
                            ?>
                            </table>
                            <div>
                            <br><center>
                            <h3>Silahkan Melanjutkan Pembayaran melalui</h3>
                            <br>
                            <?php 
                                    $metode = mysqli_query($conn,"select * from pembayaran");
                                    
                                    while($p=mysqli_fetch_array($metode)){
                                        
                                    ?>
                                    
                                    <img src="<?php echo $p['logo'] ?>" width="150px" height="100px"><br>
                                    <h4><?php echo $p['metode'] ?> - <?php echo $p['norek'] ?><br>
                                    a/n. <?php echo $p['an'] ?></h4><br>
                                    <br>
                                    <hr>
                                    
                                    <?php
                                    }
                                ?>
                            <br></center>
                            <br>
                            <p style="text-align: center;">Transaksi anda Akan Segera kami Proses 1x24 Jam Setelah anda Melakukan Pembayaran ke ATM atau Melewati transaksi digital lainya dan menyertakan Informasi Pribadi yang melakukan pembayaran seperti Nama Pemilik Rekening / Sumber Dana, Tanggal Pembayaran, Metode pembayaran Dan Jumlah Bayar</p>
                            <div class="as-grid__button-wrapper">
                            <form method="post">
                                <input style="margin-left:370px;" type="submit" class="as-grid__button" name="bayar" value="I Agree and Check Out" \> 
                            </form>
                            </div>
                            </div>
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