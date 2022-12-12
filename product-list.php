<?php
require 'dbconnect.php';
require 'cek.php';

$idk = $_GET['idkategori'];
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
    <link rel="stylesheet" href="css/apppp.css">
    <link rel="stylesheet" href="css/dropdown.css">

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
                <div class="dropdown" style="float:right;">
                    <button class="dropbtn">Kategori</button>
                    <div class="dropdown-content">
                        <?php 
                        $kat=mysqli_query($conn,"SELECT * from kategori order by idkategori ASC");
                        while($p=mysqli_fetch_array($kat)){

                            ?>
                        <li><a href="product-list.php?idkategori=<?php echo $p['idkategori'] ?>"><?php echo $p['namakategori'] ?></a></li>
                                                
                        <?php
                                    }
                        ?>
                    </div>
                </div>
                <h2 class="as-section__title">Galeri UKM</h2>
                <p class="as-section__description">Berbagai jenis usaha yang bisa anda pilih untuk anda investasikan</p>
                <div class="as-grid">
                    <article class="as-grid__card">
                        <?php 
					$brgs=mysqli_query($conn,"SELECT * from produk where idkategori='$idk' order by idproduk ASC");
					$x = mysqli_num_rows($brgs);
                    
                   
					if($x>0){
					while($p=mysqli_fetch_array($brgs)){
                        $tenggatwaktu = $p['tenggatwaktu'];

                        $sisa = new DateTime($tenggatwaktu);
                        $tenggat = new DateTime();

                        $sisahari = $tenggat->diff($sisa);
					?>
                        <img src="<?php echo $p['gambar']?>" class="as-grid__image" loading="lazy" alt="contoh">
                        <div class="as-grid__card-wrapper">
                            <h3 class="as-grid__title"><?php echo $p['namaproduk'] ?></h3>
                            <p class="as-grid__description">Sisa <?php echo $sisahari->d."&nbsp"."Hari" ?></p>
                            <div class="as-grid__button-wrapper">
                            <a href="product-detail.php?idproduk=<?php echo $p['idproduk'] ?>" class="as-grid__button">Lihat Detail</a>
                            </div>
                        </div>
                        <?php
							}
					} else {
						echo "Silakan pilih kategori";
					}
						?>
					
                    </article>
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