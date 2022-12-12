<?php
require 'dbconnect.php';
require 'cek.php';

$iddonasi = $_GET['iddonasi'];

    $uid = $_SESSION['id'];
	$caridonasi = mysqli_query($conn,"select * from donasi where userid='$uid' and status='Terbayar'");
	$fetc = mysqli_fetch_array($caridonasi);
	$kodeidd = $fetc['kodeid'];
	$itungtrans = mysqli_query($conn,"select count(iddonasi) as jumlahtrans from donasi where userid='$uid' and status!='proses'");
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
                <h2 class="as-section__title">Terimakasih Telah Berinvestasi di Kickfund</h2>
                
                <div >
                    <div >
                        <table >
                            <tr>
                                <th>
                                    <p>Kamu memiliki <span><?php echo $itungtrans3 ?> transaksi</span></p>
                                </th>
                            </tr>
                        </table>
        <table id="customers">	
		<thead>
		<tr>
            <th>No.</th>
			<th>Kode Transaksi</th>
			<th>Jumlah Investasi</th>
            <th>Status</th>
			
		</tr>
		</thead>	
		<tbody>
            <?php 
                        
                $brg=mysqli_query($conn,"SELECT * from donasi  where status!='proses' and userid=$uid order by iddonasi ASC");
                $no=1;
                while($b=mysqli_fetch_array($brg)){

            ?>
			<form method="post">									
                <tr>
                <td><?php echo $no++ ?></td>
                <td><a href="detaildonasi.php?id=<?php echo $b['kodeid'] ?>"><?php echo $b['kodeid'] ?></a></td>
			    <td>Rp.<?php echo $b['jumlah'] ?></td>
                <td>
                <?php
                    if($b['status']=='Terbayar'){
                    echo '
                    <a href="konfirmasi.php?id='.$b['kodeid'].'" class="form-control btn-primary">
                    Konfirmasi Pembayaran
                    </a>
                    ';}
                     else {
                        echo 'Konfirmasi diterima';
                    }
                    
                    ?>
                    
                </td>
													
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