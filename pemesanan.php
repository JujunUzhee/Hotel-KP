<?php
session_start();
include "pesan.php";

if (isset($_POST)) {
    if (!$_POST['tipe-kamar']) {
        header("location:./");
    }
}

include "layout/cookie.php";

$id = $_SESSION['id'];
$stokKamar = query("SELECT * FROM stok_kamar WHERE tipe = '$tipeKamar'")[0]['stok'];
$idKamar = query("SELECT * FROM kamar WHERE jenis_kamar = '$tipeKamar'");
$nomorKamar = query("SELECT no_kamar, tarif FROM kamar WHERE jenis_kamar = '$tipeKamar' AND status = 'tersedia'");
$dataPelanggan = query("SELECT * FROM pelanggan WHERE id = '$id'")[0];
$jumlahKamar = $_POST['jumlah-kamar'];
$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #FF6500;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo/<?= $hotel['logo_secondary'] ?>" width="30" alt="<?= $hotel['logo_primary'] ?>"
                    style="margin-right: 5px;">
                <span style="font-weight: 600;"><?= $hotel['nama_hotel'] ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="./index.php?page=index"
                        style="padding: 10px 15px;">Beranda</a>
                    <a class="nav-link" href="./about.php?page=about"
                        style="padding: 10px 15px;">Tentang</a>
                    <a class="nav-link" href="./kamar.php?page=kamar"
                        style="padding: 10px 15px;">Kamar</a>
                    <a class="nav-link"
                        href="./fasilitas.php?page=fasilitas" style="padding: 10px 15px;">Fasilitas</a>
                    <a class="nav-link" href="./pesanan.php?page=pesanan"
                        style="padding: 10px 15px;">Pesanan</a>

                    <!-- Profile Dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/profil/<?= $dataPelanggan['foto']; ?>" alt="Profile" width="30" height="30"
                                class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item" href="./profile.php?page=profile">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./logic/proses-logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <h2 class="mt-5 text-center pt-5 text-uppercase">Pesan Kamar</h2>
    <div class="container my-5">
        <div class="m-auto rounded-3">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 card">
                    <img src="img/fasilitas/<?= $gambar ? "$gambar" : "hotel.jpg" ?>" class="d-block m-auto mt-3 img-thumbnail img-fluid" style="max-width: 350px;">
                    <form action="detail-pemesanan.php" method="post" autocomplete="off">
                        <div class="container">
                            <div class="row mt-5 justify-content-center">
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="tipe-kamar" class="form-label">Tipe Kamar</label>
                                        <input required readonly name="tipe-kamar" type="text" class="form-control" placeholder="Tipe Kamar" value="<?= $tipeKamar; ?>">
                                    </div>
                                </div>

                                <!-- Nomor Kamar -->
                                <?php
                                $jumlahKamar = intval($_POST['jumlah-kamar']); 
                                ?>
                                <div id="nomor-kamar-container">
                                    <?php for ($i = 1; $i <= $jumlahKamar; $i++) : ?>
                                        <!-- Nomor Kamar -->
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-lg-9">
                                                <label for="nomor-kamar-<?= $i; ?>" class="form-label">No Kamar <?= $i; ?></label>
                                                <select name="nomor-kamar[]" id="nomor-kamar-<?= $i; ?>" class="form-select kamar-select" required>
                                                    <option value="" selected disabled>Pilih Nomor Kamar</option>
                                                    <?php foreach ($nomorKamar as $noKamar) : ?>
                                                        <option value="<?= htmlspecialchars($noKamar['no_kamar']); ?>" data-harga="<?= htmlspecialchars($noKamar['tarif']); ?>">
                                                            <?= htmlspecialchars($noKamar['no_kamar']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>

                                <!-- Harga / Malam -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="harga" class="form-label">Harga / Malam</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input required readonly name="harga" type="text" class="form-control" id="harga" placeholder="Harga Kamar per malam">
                                        </div>
                                    </div>
                                </div>
                                <!-- Jumlah Kamar -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="jumlah-kamar" class="form-label">Jumlah Kamar</label>
                                        <input required readonly name="jumlah-kamar" type="number" class="form-control" id="jumlah-kamar" min="1" max="<?= $stokKamar; ?>" placeholder="Tersedia <?= $stokKamar; ?>" value="<?= $_POST['jumlah-kamar'] ?>">
                                    </div>
                                </div>

                                <!-- Nama Lengkap -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input required name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?= $dataPelanggan['nama']; ?>">
                                    </div>
                                </div>
                                <!-- Alamat -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input required name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $dataPelanggan['alamat']; ?>">
                                    </div>
                                </div>
                                <!-- Telepon -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="telp" class="form-label">No. Telepon</label>
                                        <input required name="telp" type="tel" class="form-control" id="telp" placeholder="No Telepon" value="<?= $dataPelanggan['telp']; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                </div>
                                <!-- Check-In -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="cekin" class="form-label">Check-In</label>
                                        <input required name="cekin" type="text" placeholder="Pilih tanggal check in" readonly class="form-control" id="cekin">
                                    </div>
                                </div>

                                <!-- Check-Out -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="cekout" class="form-label">Check-Out</label>
                                        <input required name="cekout" type="text" placeholder="Pilih tanggal check out" readonly class="form-control" id="cekout">
                                    </div>
                                </div>

                                <!-- Total Harga -->
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-9">
                                        <label for="hasil" class="form-label">Total Harga</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input required readonly name="harga" type="text" class="form-control" id="hasil" placeholder="Total Harga">
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <input type="hidden" class="form-control d-inline" id="total" placeholder="Harga Kamar perhari">
                                    <button class="w-50 btn text-white btn-lg mb-5" style="background-color: #FF6500" name="submit" type="submit">Pesan</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php include "layout/footer.php" ?>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
    function rubah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    $(function() {
        // Inisialisasi datepicker
        $("#cekin, #cekout").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0 // Tanggal tidak boleh sebelum hari ini
        });

        // Fungsi untuk memperbarui harga per malam
        function updateHargaPerMalam() {
            let totalHarga = 0;

            // Ambil semua dropdown nomor kamar
            document.querySelectorAll('.kamar-select').forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga'); // Ambil harga dari data-harga
                if (harga) {
                    totalHarga += parseInt(harga, 10); // Tambahkan harga ke total
                }
            });

            // Update input harga per malam
            const inputHarga = document.getElementById('harga');
            inputHarga.value = rubah(totalHarga); // Format ke ribuan
        }

        // Fungsi untuk memperbarui total harga
        function updateTotalHarga() {
            const start = $('#cekin').datepicker('getDate');
            const end = $('#cekout').datepicker('getDate');

            if (start && end) {
                const days = (end - start) / (1000 * 60 * 60 * 24); // Hitung jumlah malam
                $('#total').val(days > 0 ? days : 0);

                // Ambil harga per malam
                const hargaPerMalam = parseInt(document.getElementById('harga').value.replace(/\./g, '') || 0, 10);
                const totalHarga = hargaPerMalam * (days > 0 ? days : 0);

                // Update input total harga
                $('#hasil').val(rubah(totalHarga)); // Format ke ribuan
            }
        }

        // Fungsi untuk memperbarui opsi di dropdown kamar
        function updateOptions() {
            const selectedValues = Array.from(document.querySelectorAll('.kamar-select')).map(select => select.value);

            document.querySelectorAll('.kamar-select').forEach(select => {
                Array.from(select.options).forEach(option => {
                    if (selectedValues.includes(option.value) && option.value !== select.value) {
                        option.disabled = true; // Nonaktifkan opsi yang sudah dipilih
                    } else {
                        option.disabled = false; // Aktifkan opsi lainnya
                    }
                });
            });
        }

        // Event listener untuk perubahan nomor kamar
        document.querySelectorAll('.kamar-select').forEach(select => {
            select.addEventListener('change', function() {
                updateHargaPerMalam(); // Perbarui harga per malam
                updateTotalHarga(); // Perbarui total harga (jika tanggal sudah dipilih)
                updateOptions(); // Perbarui opsi di dropdown
            });
        });

        // Event listener untuk perubahan tanggal
        $('#cekin, #cekout').on('change', function() {
            updateTotalHarga(); // Perbarui total harga saat tanggal berubah
        });

        // Perbarui harga per malam dan opsi saat halaman dimuat
        updateHargaPerMalam();
        updateOptions();
    });
</script>




</body>

</html>