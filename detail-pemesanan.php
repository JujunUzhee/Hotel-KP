<?php
session_start();
include "data-cekin.php";
include "layout/cookie.php";

$cekin = $_POST['cekin'] . " " . date("23:59:00");
$cekout = $_POST['cekout'];
$hariIni = date("Y-m-d H:i:s");

$cekValidasi = $cekin > $hariIni;
$cekValidasi2 = $cekout > $cekin;
if (!$cekValidasi) {
    echo "<script>
            document.location.href = './kamar.php?page=kamar&pesan=tgl-cekin-salah';
        </script>";
} else if (!$cekValidasi2) {
    echo "<script>
            document.location.href = './kamar.php?page=kamar&pesan=tgltdkvalid';
        </script>";
}


$tipeKamar = $_POST["tipe-kamar"];
$gambar = query("SELECT gambar FROM fasilitas WHERE tipe_kamar = '$tipeKamar'")[0]['gambar'];
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
        </div>
    </nav>

    <div class="container pt-5">
        <h2 class="mt-5 text-center text-uppercase">Detail Pemesanan</h2>
        <div class="container my-5">
            <div class="m-auto rounded-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-5">
                        <div class="card p-4">
                            <img src="img/fasilitas/<?= $gambar ?>" class="card-img-top img-fluid" alt="<?= $gambar ?>" style="max-height: 250px; object-fit: cover;">
                            <div class="row justify-content-center mt-3">
                                <div class="col-6 text-end fw-light">Tipe Kamar : </div>
                                <div class="col-6 fw-light"><?= $_POST['tipe-kamar'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Nomor Kamar : </div>
                                <div class="col-6 fw-light">
                                    <?php if (!empty($_POST['nomor-kamar']) && is_array($_POST['nomor-kamar'])) : ?>
                                        <?php foreach ($_POST['nomor-kamar'] as $nomorKamar) : ?>
                                            (<?= htmlspecialchars($nomorKamar) ?>)
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Tidak ada nomor kamar yang dipilih.</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Harga / Malam : </div>
                                <div class="col-6 fw-light">Rp.<?= $_POST['harga'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Jumlah Kamar : </div>
                                <div class="col-6 fw-light"><?= $_POST['jumlah-kamar'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Nama Pemesan : </div>
                                <div class="col-6 fw-light"><?= $_POST['nama'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Alamat : </div>
                                <div class="col-6 fw-light"><?= $_POST['alamat'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">No Telepon : </div>
                                <div class="col-6 fw-light"><?= $_POST['telp'] ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Check In : </div>
                                <div class="col-6 fw-light"><?= tanggal_indonesia($_POST['cekin']) ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Check Out : </div>
                                <div class="col-6 fw-light"><?= tanggal_indonesia($_POST['cekout']) ?></div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Durasi Menginap : </div>
                                <div class="col-6 fw-light"><?= $durasi; ?> Malam</div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 text-end fw-light">Total Biaya : </div>
                                <div class="col-6 fw-light">Rp. <?= rupiah($totalBiaya); ?></div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" autocomplete="off">
                        <?php for ($j = 1; $j <= $_POST['jumlah-kamar']; $j++) : ?>
                            <input name="id" type="hidden" value="<?= $dataPelanggan['id'] ?>">
                            <input name="tipe-kamar" type="hidden" value="<?= $_POST['tipe-kamar']; ?>">
                            <input name="tipe-kamar" type="hidden" value="<?= $_POST['tipe-kamar']; ?>">
                            <?php if (!empty($_POST['nomor-kamar']) && is_array($_POST['nomor-kamar'])) : ?>
                                <?php foreach ($_POST['nomor-kamar'] as $index => $nomorKamar) : ?>
                                    <input name="nomor-kamar-<?= $index + 1; ?>" type="hidden" value="<?= htmlspecialchars($nomorKamar); ?>">
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <input name="harga" type="hidden" value="<?= $_POST['harga']; ?>">
                            <input name="jumlah-kamar" type="hidden" value="<?= $_POST['jumlah-kamar'] ?>">
                            <input name="nama" type="hidden" value="<?= $_POST['nama'] ?>">
                            <input name="alamat" type="hidden" value="<?= $_POST['alamat'] ?>">
                            <input name="telp" type="hidden" value="<?= $_POST['telp'] ?>">
                            <input name="cekin" type="hidden" value="<?= $_POST['cekin'] ?>">
                            <input name="cekout" type="hidden" value="<?= $_POST['cekout'] ?>">
                            <input name="durasi" type="hidden" value="<?= $durasi; ?>">
                            <input name="total-biaya" type="hidden" value="<?= $totalBiaya; ?>">
                        <?php endfor; ?>
                        <div class="row justify-content-center mt-3">
                            <button class="w-25 btn text-white btn-lg mb-5" style="background-color: #FF6500" name="pesan" type="submit">Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['pesan'])) {
        if (tambahPesanan($_POST) > 0) {
            echo "<script>
                    function pindahHalaman() {
                        document.location.href = './pesanan.php?page=pesanan';
                    }
                    
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Kamar telah dipesan!',
                    showConfirmButton: false,
                    timer: 1500
                    });
                    setTimeout(pindahHalaman, 1500);
                </script>";
        } else {
            echo "<script>
                alert('Pesanan Gagal');
            </script>";
        }
    }
    ?>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>