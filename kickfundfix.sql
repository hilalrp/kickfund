-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2022 pada 03.11
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kickfundfix`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `iddonasi` int(11) NOT NULL,
  `kodeid` varchar(100) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`iddonasi`, `kodeid`, `idproduk`, `userid`, `jumlah`, `status`) VALUES
(54, '16eoJkStXiLqg', 1, 6, 5000000, 'Terkonfirm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `namakategori` varchar(20) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `tgldibuat`) VALUES
(4, 'F&B', '2022-11-02 19:24:29'),
(9, 'Otomotif', '2022-11-03 04:10:13'),
(12, 'Salon & Barbershop', '2022-11-28 01:54:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `idkonfirmasi` int(11) NOT NULL,
  `kodeid` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `namarekening` varchar(25) NOT NULL,
  `tglbayar` date NOT NULL,
  `tglsubmit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`idkonfirmasi`, `kodeid`, `userid`, `payment`, `namarekening`, `tglbayar`, `tglsubmit`) VALUES
(3, '16eoJkStXiLqg', 6, 'OVO', 'user1', '2022-11-28', '2022-11-28 02:09:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL,
  `norek` varchar(25) NOT NULL,
  `logo` text DEFAULT NULL,
  `an` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`no`, `metode`, `norek`, `logo`, `an`) VALUES
(4, 'Bank Mandiri', '1370042967', 'images/mandiri.jpg', 'Kickfund'),
(5, 'OVO', '081346790923', 'images/ovo.jpg', 'Kickfund'),
(6, 'Bank BCA', '031227777777', 'images/bca.jpg', 'Kickfund');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaproduk` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(5000) NOT NULL,
  `dana` int(11) NOT NULL,
  `tenggatwaktu` date NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `gambar`, `deskripsi`, `dana`, `tenggatwaktu`, `tgldibuat`) VALUES
(1, 4, 'Nyoklat Teen', 'produk/16sAPYzCHUV7o.png', 'Dengan berkembangnya zaman yang pesat, Cokelat telah menjadi suatu daya tarik tersendiri bagi konsumen dunia terutama di Indonesia\r\n\r\nCokelat yang didatangkan dari pulau Chocoland ini menghasilkan keunikan tersendiri di lidah konsumen, melted chocolate yang lezat dan nikmat berpadu dengan varian rasa pilihan, memberikan keistimewaan tersendiri bagi penikmat cokelat.\r\n\r\n \r\n\r\nNyoklatTeen mengajak anda untuk menjadi pioner signature chocolate,melebarkan sayap bisnis dan meraih kesuksesan bersama-sama.', 10000000, '2022-12-24', '2022-11-05 12:12:18'),
(18, 9, 'Senzral Motor', 'produk/16EsHKMMeNMuQ.jpg', 'Senzral Motor adalah bengkel motor terbaik di daerah Cikarang. Bengkel sudah berdiri sejak tahun 2019 dan perlu adanya perkembangan', 15000000, '2023-01-20', '2022-11-04 16:04:38'),
(19, 4, 'Ayam Pargoy', 'produk/16BIPrsuk6rk..png', 'ParGoy Kitchen merupakan Cloud Kitchen yang berdiri sejak Maret 2020, konsep makanan yang ditawarkan ParGoy Kitchen adalah makanan lezat dengan gaya kekinian yang bisa dipesan kapan saja dan dimana saja. Per Juli 2021, ParGoy Kitchen telah tersebar di tiga cabang yaitu cabang Pejaten, Salemba, dan Thamrin', 25000000, '2023-01-12', '2022-11-28 01:46:40'),
(20, 9, 'Helmet & Care', 'produk/165cZhT5QkLMQ.png', 'Berawal dari hobi bermotor dan kesulitan dalam mencari tempat perawatan helm dan apparel biker yang terpercaya di Jakarta membuat kami mendirikan usaha yang bergerak di bidang jasa perawaran premium helm dan apparel helm pada tahun 2019. Kami menawarakan konsep “one stop service” yaitu layanan jasa perawatan premium helm, apparel biker seperti gloves, sepatu, hingga jaket khusus rider. Layanan lain adalah cuci reguler, cuci premium hingga nano ceramic coating dengan garansi 2 tahun. Kami memulai debut dengan membuka store pertama di Otista Raya, Jakarta Timur (2019).', 20000000, '2023-01-27', '2022-11-28 01:50:12'),
(21, 12, 'Seriouscut Barbershop', 'produk/16G1Aw0U6mPtg.png', 'Dengan menjual franchise dari Seriouscut Barbershop, kami berharap kami dapat meningkatkan brand awareness yang kita telah bangun sekian lama. Untuk menyediakan kualitas salon potong rambut yang terstandarisasi dengan kualitas maksimal yang dapat membantu kita untuk menyediakan lapangan pekerjaan bagi teman teman diluar sana yang membutuhkan pekerjaan.', 50000000, '2023-01-30', '2022-11-28 01:55:59'),
(22, 12, 'The Loox Salon Profesional', 'produk/16M1u3y0rEhEA.jpg', 'The Loox Salon Profesional adalah penyedia jasa layanan perawatan rambut.  Kami memulai usaha ini sejak tahun 2010, melihat animo masyarakat yang sangat baik, pada akhirnya di tahun 2015 kami memutuskan untuk memfrinchisekan usaha kami.', 30000000, '2023-01-27', '2022-11-28 01:57:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `umkm`
--

CREATE TABLE `umkm` (
  `umkmid` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notelp` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `umkm`
--

INSERT INTO `umkm` (`umkmid`, `nama`, `email`, `notelp`, `password`) VALUES
(3, 'umkm2', 'umkm2@gmail.com', '089999999', '$2y$10$1Vi4Whj18VXBSsXle67hMelJhodU3H0sioyfdIeqGtSgbXMJAgj.a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `nama`, `email`, `notelp`, `password`) VALUES
(6, 'user1', 'user1@gmail.com', '08123456789', '$2y$10$AdL8ymiqYsN08VpePdTdLOBtXSKwgjUEFf9VyHh4mM1N8i1krpkcy');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`iddonasi`),
  ADD UNIQUE KEY `kodeid` (`kodeid`),
  ADD UNIQUE KEY `idproduk` (`idproduk`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Indeks untuk tabel `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`umkmid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `iddonasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `idkonfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `umkm`
--
ALTER TABLE `umkm`
  MODIFY `umkmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `idkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
