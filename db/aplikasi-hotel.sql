-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Waktu pembuatan: 14 Jan 2025 pada 03.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi-hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `tipe_kamar` enum('Standard','deluxe') NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `tipe_kamar`, `fasilitas`, `gambar`, `deskripsi`, `harga`) VALUES
(12, 'deluxe', 'Kamar', 'Deluxe.jpg', 'Kamar nyaman dengan fasilitas AC,Wifi, TV, Shower dan kamar mandi air dingin &amp; air panas alami, ideal untuk penginapan praktis dan terjangkau.', '200000'),
(13, 'deluxe', 'Kamar mandi ', '67716854e3560.jpeg', 'Dilengkapi perlengkapan mandi lengkap untuk kenyamanan Anda, termasuk handuk, sabun, sampo, dan kebutuhan lainnya.', '450000'),
(14, 'deluxe', 'TV LCD', '67716b8ec5fc0.jpg', 'Nikmati hiburan berkualitas dengan fasilitas TV LCD yang menawarkan tampilan jernih dan berbagai saluran pilihan.', '450000'),
(15, 'deluxe', 'AC', '677168cca2a97.jpg', 'Fasilitas AC yang sejuk dan nyaman, memastikan suasana ruangan tetap segar sepanjang hari.', '450000'),
(21, 'deluxe', 'Wifi', '6771699a59dff.jpg', 'Akses WiFi gratis dengan koneksi cepat untuk kebutuhan browsing, streaming, dan tetap terhubung.', '450000'),
(22, 'deluxe', 'Air DIngin &amp; Air Panas Alami', '677169ccafe26.jpg', 'Nikmati sensasi alami dengan fasilitas air dingin dan air panas langsung dari sumber alam, menyegarkan dan menenangkan.', '450000'),
(23, 'deluxe', 'Mini Bar', '67716a7927079.jpeg', 'Fasilitas mini bar dengan tempat duduk yang nyaman, ideal untuk bersantai sambil menikmati waktu Anda di kamar.', '450000'),
(36, 'Standard', 'Kamar', '6739f97e246a5.jpeg', 'Kamar nyaman dengan fasilitas Wifi, TV, Kipas dinding dan kamar mandi air dingin &amp; air panas alami, ideal untuk penginapan praktis dan terjangkau.', '150000'),
(38, 'Standard', 'Air Dingin &amp; Air Panas Alami', '6771655950592.jpg', 'Nikmati sensasi alami dengan fasilitas air dingin dan air panas langsung dari sumber alam, menyegarkan dan menenangkan.', '150000'),
(39, 'Standard', 'Kipas Dinding', '6771659bb7914.jpg', 'Fasilitas kipas dinding yang efisien untuk memberikan kenyamanan dengan sirkulasi udara yang sejuk di dalam ruangan.', '150000'),
(40, 'Standard', 'TV LCD', '67716647707f5.jpg', 'Nikmati hiburan berkualitas dengan fasilitas TV LCD yang menawarkan tampilan jernih dan berbagai saluran pilihan.', '150000'),
(41, 'Standard', 'Kamar Mandi', '677166c910716.jpeg', 'Dilengkapi perlengkapan mandi lengkap untuk kenyamanan Anda, termasuk handuk, sabun, sampo, dan kebutuhan lainnya.', '150000'),
(42, 'Standard', 'Wifi', '6771696a8f670.jpg', 'Akses WiFi gratis dengan koneksi cepat untuk kebutuhan browsing, streaming, dan tetap terhubung.', '150000'),
(43, 'deluxe', 'Shower', '67716acc03f90.jpeg', 'Nikmati kenyamanan mandi dengan fasilitas shower modern yang memberikan kesegaran maksimal di kamar mandi.', '200000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE `identitas` (
  `id` int(11) NOT NULL,
  `logo_primary` varchar(255) NOT NULL,
  `logo_secondary` varchar(255) NOT NULL,
  `nama_hotel` varchar(255) NOT NULL,
  `tentang` text NOT NULL,
  `no_rekening` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id`, `logo_primary`, `logo_secondary`, `nama_hotel`, `tentang`, `no_rekening`, `alamat`, `telp`, `email`) VALUES
(2, '672f1279a5961.png', '672f1279a5c9d.png', 'Hotel Rahayu', 'Hotel Rahayu adalah sebuah usaha keluarga yang didirikan oleh Ibu Tatin Surtini pada tahun 1976 dengan nama awal “Losmen Saleh.” Usaha ini awalnya berfokus pada menyediakan penginapan sederhana bagi wisatawan dan pengunjung yang datang ke wilayah Kuningan, Jawa Barat. Berlokasi di Jl. Panawuan-Sangkanurip No.121, Panawuan, Kecamatan Cigandamekar, Kabupaten Kuningan, lokasi penginapan ini sangat strategis karena dekat dengan kawasan wisata populer dan pemandian air panas Sangkanurip.', '1340021648554', 'Jl. Panawuan-Sangkanurip No.121, Panawuan, Kec. Cigandamekar, Kabupaten Kuningan, Jawa Barat 45556', '087739757599', 'rahayuhotel23@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `id_stok_kamar` int(11) DEFAULT NULL,
  `jenis_kamar` enum('Standard','deluxe') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `no_kamar` varchar(5) NOT NULL,
  `status` enum('tersedia','dipesan','terisi') NOT NULL,
  `tgl_pemesanan` datetime DEFAULT NULL,
  `tgl_check_out` date DEFAULT NULL,
  `tarif` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id`, `id_stok_kamar`, `jenis_kamar`, `gambar`, `no_kamar`, `status`, `tgl_pemesanan`, `tgl_check_out`, `tarif`) VALUES
(36, 2, 'deluxe', 'deluxe.png', '19', 'tersedia', NULL, NULL, '200000'),
(40, 2, 'deluxe', 'deluxe.png', '20', 'tersedia', NULL, NULL, '200000'),
(41, 1, 'Standard', 'superior.png', '6', 'tersedia', NULL, NULL, '125000'),
(45, 1, 'Standard', 'superior.png', '7', 'tersedia', NULL, NULL, '125000'),
(46, 2, 'deluxe', 'deluxe.png', '21', 'tersedia', NULL, NULL, '200000'),
(47, 2, 'deluxe', 'deluxe.png', '22', 'tersedia', NULL, NULL, '200000'),
(48, 2, 'deluxe', 'deluxe.png', '23', 'tersedia', NULL, NULL, '200000'),
(49, 2, 'deluxe', 'deluxe.png', '24', 'tersedia', NULL, NULL, '200000'),
(50, 2, 'deluxe', 'deluxe.png', '25', 'tersedia', NULL, NULL, '200000'),
(51, 2, 'deluxe', 'deluxe.png', '26', 'tersedia', NULL, NULL, '200000'),
(52, 2, 'deluxe', 'deluxe.png', '27', 'tersedia', NULL, NULL, '200000'),
(53, 2, 'deluxe', 'deluxe.png', '28', 'tersedia', NULL, NULL, '200000'),
(54, 2, 'deluxe', 'deluxe.png', '29', 'tersedia', NULL, NULL, '200000'),
(55, 2, 'deluxe', 'deluxe.png', '30', 'tersedia', NULL, NULL, '200000'),
(56, 2, 'deluxe', 'deluxe.png', '31', 'tersedia', '2025-01-09 00:00:00', '2025-01-11', '200000'),
(57, 2, 'deluxe', 'deluxe.png', '32', 'tersedia', NULL, NULL, '200000'),
(58, 1, 'Standard', 'superior.png', '8', 'tersedia', NULL, NULL, '125000'),
(59, 1, 'Standard', 'superior.png', '10', 'tersedia', NULL, NULL, '125000'),
(60, 1, 'Standard', 'superior.png', '1', 'tersedia', NULL, NULL, '150000'),
(61, 1, 'Standard', 'superior.png', '2', 'tersedia', NULL, NULL, '150000'),
(62, 1, 'Standard', 'superior.png', '3', 'tersedia', '2025-01-10 23:03:00', '2025-01-12', '150000'),
(63, 1, 'Standard', 'superior.png', '4', 'tersedia', NULL, NULL, '150000'),
(64, 1, 'Standard', 'superior.png', '5', 'tersedia', NULL, NULL, '150000'),
(65, 1, 'Standard', 'superior.png', '1A', 'dipesan', '2025-01-11 13:12:00', '2025-01-13', '150000'),
(66, 1, 'Standard', 'superior.png', '2A', 'tersedia', NULL, NULL, '150000'),
(67, 1, 'Standard', 'superior.png', '3A', 'tersedia', '2025-01-10 23:55:00', '2025-01-12', '150000'),
(68, 1, 'Standard', 'superior.png', '4A', 'tersedia', NULL, NULL, '150000'),
(69, 1, 'Standard', 'superior.png', '5A', 'tersedia', NULL, NULL, '150000'),
(70, 1, 'Standard', 'superior.png', '6A', 'tersedia', NULL, NULL, '150000'),
(71, 1, 'Standard', 'superior.png', '12', 'tersedia', NULL, NULL, '150000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `role` enum('admin','resepsionis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `foto`, `nama`, `email`, `jenis_kelamin`, `username`, `password`, `telp`, `role`) VALUES
(10, 'default-laki-laki.png', 'Hotel Rahayu', 'HotelRahayu021@gmail.com', 'laki-laki', 'HotelRahayu', '00793dfbf0127fa4af57be5b001eff8be8e0961594e26d54cce9f7984eb7284c', '+6285794300712', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `telp` varchar(14) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `nik`, `jenis_kelamin`, `telp`, `alamat`, `email`, `status`, `username`, `password`, `foto`) VALUES
(25, 'jujunz', '1213212112222212', 'laki-laki', '08579430011', 'kuningan', 'jujun@gmail.com', 'aktif', 'jujunz', 'f18eee64b2b4f025d68ec50ac6b2b10dd67a08174dc7a66e172b3b5dbf09c6db', 'default-laki-laki.png'),
(26, 'Muhammad Rinaldi', '', 'laki-laki', '+6285794300733', 'DUSUN III Rt16 Rw03', '', NULL, '', '', ''),
(27, 'Muhammad Rinaldi', '', 'laki-laki', '+6285794300733', 'DUSUN III Rt16 Rw03', '', NULL, '', '', ''),
(28, 'rinal', '1234567891211221', 'laki-laki', '085798080832', 'Oleced', 'rinal12@gmail.com', 'aktif', 'rinal', '4bd31f14db2aabe06eba0947639114a67405c7bf0ae2c390d657f8f2c176456d', 'default-laki-laki.png');

--
-- Trigger `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `update_review_foto` AFTER UPDATE ON `pelanggan` FOR EACH ROW BEGIN
    UPDATE reviews 
    SET foto = NEW.foto
    WHERE customer_name = NEW.nama;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `tgl_pembayaran` varchar(255) NOT NULL,
  `nama_pembayar` varchar(255) NOT NULL,
  `bank` enum('Mandiri','BCA','BNI','BRI') NOT NULL,
  `no_rekening` varchar(15) NOT NULL,
  `nama_pemilik_kartu` varchar(255) NOT NULL,
  `total_akhir` varchar(25) NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pemesanan`, `tgl_pembayaran`, `nama_pembayar`, `bank`, `no_rekening`, `nama_pemilik_kartu`, `total_akhir`, `bukti`) VALUES
(105, 256, '11 Januari 2025', 'jujunz', 'BCA', '123242121', 'Jujun Junaedi', '300.000', '67820bd6457a0.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `tgl_cek_in` date NOT NULL,
  `tgl_cek_out` date NOT NULL,
  `tipe_kamar` enum('Standard','Deluxe') NOT NULL,
  `harga_permalam` varchar(30) NOT NULL,
  `jumlah_kamar` varchar(2) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `durasi_menginap` varchar(10) NOT NULL,
  `total_biaya` varchar(25) NOT NULL,
  `status` enum('belum dibayar','batal','check out','pending','berhasil') NOT NULL,
  `batas_pembayaran` datetime NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pelanggan`, `id_kamar`, `tgl_pemesanan`, `tgl_cek_in`, `tgl_cek_out`, `tipe_kamar`, `harga_permalam`, `jumlah_kamar`, `nama_pemesan`, `alamat`, `telp`, `durasi_menginap`, `total_biaya`, `status`, `batas_pembayaran`, `is_deleted`) VALUES
(256, 25, 65, '2025-01-11 13:12:00', '2025-01-11', '2025-01-13', 'Standard', '150.000', '1', 'jujunz', 'kuningan', '08579430011', '2', '300000', 'berhasil', '2025-01-12 12:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `review_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`review_id`, `customer_name`, `email`, `rating`, `review_text`, `created_at`, `order_id`, `customer_id`, `foto`) VALUES
(15, 'Riski Saputra', 'Riski12@gmail.com', 5, 'Sangat Nyaman Sekali', '2025-01-02 23:14:36', 174, NULL, '6776bc8154653.jpg'),
(16, 'jujunz', 'jujun@gmail.com', 5, 'Nyaman Sekali', '2025-01-11 12:14:21', 247, NULL, NULL),
(17, 'rinal', 'rinal12@gmail.com', 5, 'suasana yang nyaman sekali', '2025-01-11 12:19:45', 249, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id` int(11) NOT NULL,
  `whatsapp` text NOT NULL,
  `instagram` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sosial_media`
--

INSERT INTO `sosial_media` (`id`, `whatsapp`, `instagram`, `facebook`, `twitter`) VALUES
(1, '6287739757599', 'rahayu.hotel', 'RahayuHotel', 'rahayu.hotel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_kamar`
--

CREATE TABLE `stok_kamar` (
  `id_stok_kamar` int(11) NOT NULL,
  `tipe` enum('Standard','Deluxe') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jumlah_kamar` varchar(2) NOT NULL,
  `stok` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_kamar`
--

INSERT INTO `stok_kamar` (`id_stok_kamar`, `tipe`, `gambar`, `jumlah_kamar`, `stok`) VALUES
(1, 'Standard', 'superior.png', '29', '15'),
(2, 'Deluxe', 'deluxe.png', '28', '14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stok_kamar` (`id_stok_kamar`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_kamar_2` (`id_kamar`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_kamar`
--
ALTER TABLE `stok_kamar`
  ADD PRIMARY KEY (`id_stok_kamar`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stok_kamar`
--
ALTER TABLE `stok_kamar`
  MODIFY `id_stok_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_stok_kamar`) REFERENCES `stok_kamar` (`id_stok_kamar`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_kamar` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
