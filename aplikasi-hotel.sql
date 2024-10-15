-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Waktu pembuatan: 15 Okt 2024 pada 05.08
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
(1, 'Standard', 'Kamar berukuran luas 32m²', '', 'Tipe kamar Superior berukuran 32m persegi.', '410000'),
(2, 'Standard', 'Kamar mandi shower', 'kamar-mandi-shower.jpg', 'Kamar mandi tipe kamar Superior sudah menggunakan shower.', '410000'),
(3, 'Standard', 'Saluran TV Premium', 'tv-premium.jpg', 'Jika Anda bingung ingin melakukan apa di hotel, Anda dapat menonton televisi sembari menikmati empuknya kasur yang disediakan.', '410000'),
(4, 'Standard', 'Coffe maker', 'tea-coffee-maker.jpg', 'Kamar tipe Superior juga sudah dilengkapi dengan fasilitas Coffe Maker.', '410000'),
(5, 'Standard', 'AC', 'ac.png', 'Tersedia AC.', '410000'),
(6, 'Standard', 'LED TV 32 inch', 'tv-32inch.jpg', 'Sudah tersedia TV LED 32 inch.', '410000'),
(7, 'Standard', 'Internet 4G', 'internet.jpg', 'Tersedia Wi-Fi kualitas 4G.', '410000'),
(8, 'Standard', 'Kolam Renang 70m²', 'kolam-renang.jpg', 'kolam renang yang disediakan di hotel juga dirancang untuk menghabiskan waktu bersama keluarga.', '410000'),
(9, 'Standard', 'Fasilitas Hotel Spa', 'spa.jpg', 'Memilih hotel dengan fasilitas spa adalah pilihan terbaik jika kamu ingin memanjakan badanmu.', '410000'),
(10, 'Standard', 'Pusat Kebugaran', 'gym.jpg', 'Fasilitas gym yang ada di dalam Hotel Hebat dibangun khusus untuk tamu yang menginap di hotel.', '410000'),
(11, 'Standard', 'Area Dilarang Merokok', 'no-smoking.jpg', 'Hotel menerapkan kontrak anti rokok sebagai saat check in yang akan membebankan denda besar jika pengunjung ketahuan merokok di dalam kamar.', '410000'),
(12, 'deluxe', 'Kamar berukuran luas 45m²', 'Deluxe.jpg', 'Tipe kamar Superior berukuran 45m persegi.', '450000'),
(13, 'deluxe', 'Kamar mandi shower dan bathtub', 'kamar-mandi-bathtub.jpg', 'Kamar mandi tipe kamar Superior sudah menggunakan shower dan juga sudah termasuk bathtub.', '450000'),
(14, 'deluxe', 'Saluran TV Premium', 'tv-premium.jpg', 'Jika Anda bingung ingin melakukan apa di hotel, Anda dapat menonton televisi sembari menikmati empuknya kasur yang disediakan.', '450000'),
(15, 'deluxe', 'Coffe maker', 'tea-coffee-maker.jpg', 'Kamar tipe Deluxe juga sudah dilengkapi dengan fasilitas Coffe Maker.', '450000'),
(16, 'deluxe', 'AC', 'ac.jpg', 'Tersedia AC.', '450000'),
(17, 'deluxe', 'LED TV 40 inch', 'tv-40inch.jpg', 'Sudah tersedia TV LED 40 inch.', '450000'),
(18, 'deluxe', 'Internet 5G', 'internet.jpg', 'Tersedia Wi-Fi kualitas 5G.', '450000'),
(19, 'deluxe', 'Sauna', 'sauna.jpg', 'Fasilitas yang digemari orang Jepang ini merupakan sebuah ruangan dengan suhu tinggi yang digunakan untuk membuat penggunanya berkeringat.', '450000'),
(20, 'deluxe', 'Kolam Renang 100m²', 'kolam-renang.jpg', 'kolam renang yang disediakan di hotel juga dirancang untuk menghabiskan waktu bersama keluarga.', '450000'),
(21, 'deluxe', 'Fasilitas Hotel Spa', 'spa.jpg', 'Memilih hotel dengan fasilitas spa adalah pilihan terbaik jika kamu ingin memanjakan badanmu.', '450000'),
(22, 'deluxe', 'Pusat Kebugaran', 'gym.jpg', 'Fasilitas gym yang ada di dalam Hotel Hebat dibangun khusus untuk tamu yang menginap di hotel.', '450000'),
(23, 'deluxe', 'Area Khusus Bebas Merokok', 'no-smoking.jpg', 'Hotel menerapkan kontrak anti rokok sebagai saat check in yang akan membebankan denda besar jika pengunjung ketahuan merokok di dalam kamar.', '450000');

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
(2, 'logo-primary.png', 'logo-white.png', 'Hotel Rahayu', 'dikelilingi oleh keindahan pegunungan yang indah, danau dan sawah menghijau. Nikmati                     sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau; Kid\'s Club yang luas                     - menawarkan beragam fasilitas dan kegiatan anak-anak yang akan melengkapi kenyamanan keluarga. Convention Center kami,                     dilengkapi pelayanan lengkap dengan ruang konvensi terbesar di Bandung, mampu mengakomodasi hingga 3.000 delegasi.                     Manfaatkan ruang penyelenggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan adat yang mewah', '666-666-666-666', 'Jl. Panawuan-Sangkanurip No.121, Panawuan, Kec. Cigandamekar, Kabupaten Kuningan, Jawa Barat 45556', '083809192185', 'admin@smkn1kadipaten.sch.id');

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
(1, 1, 'Standard', 'hotel1.png', '12', 'tersedia', NULL, NULL, '120000'),
(3, 2, 'deluxe', 'hotel2.png', '15', 'tersedia', NULL, NULL, '150000'),
(36, 2, 'deluxe', 'hotel2.png', '8', 'tersedia', NULL, NULL, '150000'),
(38, 2, 'deluxe', 'hotel2.png', '14', 'tersedia', NULL, NULL, '150000'),
(39, 1, 'Standard', 'hotel1.png', '21', 'tersedia', NULL, NULL, '120000'),
(40, 2, 'deluxe', 'hotel2.png', '23', 'tersedia', NULL, NULL, '150000');

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
(1, 'default-laki-laki.png', 'Dimas Candraa', 'dimasbomz13@gmail.com', 'laki-laki', 'Udinsenudin', 'Anduskar16', '+6283809192165', 'admin'),
(3, 'dasda', 'Jujun Junaedi', 'jujun@gmail.com', 'laki-laki', 'Udinsenudin', 'Anduskar16', '123213', 'admin'),
(7, 'default-perempuan.png', 'Sri Aminah', 'aminahsri092@gmail.com', 'perempuan', 'sri', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72', '+6283812923195', 'resepsionis'),
(8, 'default-laki-laki.png', 'jujun', 'jujun@gmail.com', 'laki-laki', 'bgjujun', '525347a7921ea6ff2bf29a38e54f5e187a4861a77e6fa12dd817346c4429a962', '21313123', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
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

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`, `email`, `status`, `username`, `password`, `foto`) VALUES
(14, 'Tiyas Frahesta', 'laki-laki', '97009098', 'Desa Kadipaten', 'tiiyas@gmail.com', '', 'tiiyas', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'default-laki-laki.png'),
(19, 'jujun', 'laki-laki', '0859843434', 'jawa', 'Jujun@gmail.com', '', 'jujunz', '525347a7921ea6ff2bf29a38e54f5e187a4861a77e6fa12dd817346c4429a962', 'default-laki-laki.png');

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
(37, 114, '23 Februari 2022', 'Tiyas Frahesta', 'BCA', 'asdasd', 'asdasd', '1.800.000,00', '62153a06280e7.jpg'),
(38, 116, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '34567243', 'asdgfsdf', '4.050.000,00', '62153a4f24e8b.jpg'),
(39, 115, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '2312345435', 'asdfghbvnhfghtf', '1.800.000,00', '62153a700b795.jpg'),
(40, 117, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '12321', 'terdfgsdvfs', '820.000,00', '62153a8551664.jpg'),
(41, 119, '23 Februari 2022', 'Tiyas Frahesta', 'Mandiri', '5434234', 'fgdhesrnj', '410.000,00', '62153af4e289a.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
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
  `batas_pembayaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pelanggan`, `tgl_pemesanan`, `tgl_cek_in`, `tgl_cek_out`, `tipe_kamar`, `harga_permalam`, `jumlah_kamar`, `nama_pemesan`, `alamat`, `telp`, `durasi_menginap`, `total_biaya`, `status`, `batas_pembayaran`) VALUES
(113, 14, '2022-02-23 02:27:00', '2022-02-24', '2022-02-28', 'Deluxe', '450.000,00', '3', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '4', '5.400.000,00', 'belum dibayar', '2022-02-24 12:00:00'),
(114, 14, '2022-02-23 02:28:00', '2022-02-24', '2022-02-25', 'Deluxe', '450.000,00', '4', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '1', '1.800.000,00', 'berhasil', '2022-02-24 12:00:00'),
(115, 14, '2022-02-23 02:28:00', '2022-02-24', '2022-02-26', 'Deluxe', '450.000,00', '2', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '2', '1.800.000,00', 'pending', '2022-02-24 12:00:00'),
(116, 14, '2022-02-23 02:29:00', '2022-02-24', '2022-02-27', 'Deluxe', '450.000,00', '3', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '3', '4.050.000,00', 'pending', '2022-02-24 12:00:00'),
(117, 14, '2022-02-23 02:29:00', '2022-02-24', '2022-02-25', 'Standard', '410.000,00', '2', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '1', '820.000,00', 'pending', '2022-02-24 12:00:00'),
(118, 14, '2022-02-23 02:30:00', '2022-02-24', '2022-02-28', 'Standard', '410.000,00', '3', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '4', '4.920.000,00', 'batal', '2022-02-24 12:00:00'),
(119, 14, '2022-02-23 02:34:00', '2022-02-24', '2022-02-25', 'Standard', '410.000,00', '1', 'Tiyas Frahesta', 'Desa Kadipaten', '97009098', '1', '410.000,00', 'pending', '2022-02-24 12:00:00'),
(121, 19, '2024-10-13 18:25:00', '2024-10-15', '2024-10-22', 'Deluxe', '3.150.000', '1', 'jujun', 'jawa', '0859843434', '7', '3.150.000,00', 'check out', '2024-10-14 12:00:00'),
(122, 19, '2024-10-13 20:25:00', '2024-10-16', '2024-10-18', 'Standard', '820.000', '1', 'jujun', 'jawa', '0859843434', '2', '820.000,00', 'batal', '2024-10-14 12:00:00');

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
(1, '6283809192165', 'dmscndraa', 'dmscndraaaa', 'dmscndraa');

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
(1, 'Standard', 'superior.png', '11', '3'),
(2, 'Deluxe', 'deluxe.png', '16', '4');

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
  ADD KEY `id_pelanggan` (`id_pelanggan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

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
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
