<?php
require 'dbconnect.php';
require 'cek.php';

$iddonasi = $_GET['iddonasi'];

    $idkode = $_GET['id'];
	
	$uid = $_SESSION['id'];
	$caridonasi = mysqli_query($conn,"select * from donasi where userid='$uid' and status='Terbayar'");
	$fetc = mysqli_fetch_array($caridonasi);
	$kodeidd = $fetc['kodeid'];
	$itungtrans = mysqli_query($conn,"select count(iddonasi) as jumlahtrans from donasi where kodeid='$kodeidd'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
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
                <h3 class="as-section__title">Berikut data investasi anda</h3>
                <p class="as-section__description"></p>
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
		    $brgs=mysqli_query($conn,"SELECT * from donasi d, produk p where kodeid='$idkode' and d.idproduk=p.idproduk order by d.idproduk ASC");
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