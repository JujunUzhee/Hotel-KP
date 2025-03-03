<?php
session_start();
include "logic/functions.php";
$data = query("SELECT * FROM stok_kamar");
$dataSuperior = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'Standard'");
$dataDeluxe = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'deluxe'");
$kamarStandard = query("SELECT stok FROM stok_kamar WHERE tipe = 'Standard'")[0]['stok'];
$kamarDeluxe = query("SELECT stok FROM stok_kamar WHERE tipe = 'Deluxe'")[0]['stok'];

$jumlahKamarStandard = query("SELECT jumlah_kamar FROM stok_kamar WHERE tipe = 'Standard'")[0]['jumlah_kamar'];
$jumlahKamarDeluxe = query("SELECT jumlah_kamar FROM stok_kamar WHERE tipe = 'Deluxe'")[0]['jumlah_kamar'];

$stokKamarDeluxe = query("SELECT * FROM stok_kamar WHERE tipe = 'Deluxe'")[0]['stok'];
$stokKamarStandard = query("SELECT * FROM stok_kamar WHERE tipe = 'Standard'")[0]['stok'];

if (!$_GET['page']) {
    header("Location: ./kamar.php?page=kamar");
}

include "layout/cookie.php";

$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">

    <?php include "./layout/navbar.php" ?>

    <div class="container">

        <div id="carouselExampleIndicators" class="carousel slide h-25" data-bs-ride="carousel" style="margin-top: 7rem;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-block w-100 slide-foto gambar-slider-1"></div>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= $hotel['nama_hotel'] ?></h5>
                        <p>Cari hotel dengan keamanan paling baik? silakan kunjungi <?= $hotel['nama_hotel'] ?> dan
                            dapatkan fasilitas lengkap lainnya.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 slide-foto gambar-slider-2"></div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 slide-foto gambar-slider-3"></div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="text-center mt-5">
        <h2 class="fw-bold typing">TIPE KAMAR</h2>
        <p class="lead text-center mx-5 my-4" style="font-size: 16px; line-height: 1.8;">
            Pilihan kamar dengan fasilitas terbaik untuk kenyamanan Anda.
            Tersedia tipe Deluxe dan Standard, masing-masing memberikan pengalaman menginap yang nyaman.
        </p>
        </div>
        
        <div class="row  mb-5 g-5">
            <?php foreach ($data as $kamar) : ?>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <img src="img/fasilitas/<?= $kamar['gambar'] ?>" class="card-img-top" alt="<?= $kamar['gambar'] ?>">
                        <div class="card-header">
                            <h5 class="text-center my-3 "><?= $kamar['tipe'] ?></h5>
                        </div>
                        <div class="card-body">

                            <?php if ($_SESSION['login'] == 1) : ?>
                                <?php if ($kamar['tipe'] == "Deluxe" && intval($kamarDeluxe) >= 1) : ?>
                                    <p class="text-center bold">Tersedia <?= $kamarDeluxe; ?> Kamar lagi</p>
                                <?php elseif ($kamar['tipe'] == "Deluxe" && intval($kamarDeluxe) < 1) : ?>
                                    <p class="text-center bold" style="<?= $kamarDeluxe ? 'display:none' :  ''; ?>">Kamar Sudah
                                        Penuh</p>
                                <?php endif; ?>
                            <?php endif; ?>


                            <?php if ($_SESSION['login'] == 1) : ?>
                                <?php if ($kamar['tipe'] == "Standard" && intval($kamarStandard) >= 1) : ?>
                                    <p class="text-center bold">Tersedia <?= $kamarStandard; ?> Kamar lagi</p>
                                <?php elseif ($kamar['tipe'] == "Standard" && intval($kamarStandard) < 1) : ?>
                                    <p class="text-center bold">Kamar Sudah Penuh</p>
                                <?php endif; ?>
                            <?php endif; ?>


                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <form action="pemesanan.php" method="POST" autocomplete="off">
                                        <input type="hidden" name="tipe-kamar" value="<?= $kamar["tipe"] ?>">
                                        <?php if ($_SESSION) : ?>
                                            <?php if ($_SESSION['login'] == 1) : ?>
                                                <?php if ($kamar['tipe'] == "Standard") : ?>
                                                    <input required name="jumlah-kamar" type="number"
                                                        style="width: 30%; text-align: center;" class="form-control m-auto"
                                                        placeholder="Jumlah Kamar" min="1" max="<?= $stokKamarStandard ?>">
                                                    <button style="background-color: #FF6500;"
                                                        class="btn text-white w-75 d-block m-auto mt-3"
                                                        <?= $kamar['tipe'] == "Standard" && intval($kamarStandard) < 1 ? 'disabled' : '' ?>>Pesan</button>
                                                <?php endif; ?>
                                                <?php if ($kamar['tipe'] == "Deluxe") : ?>
                                                    <input required name="jumlah-kamar" type="number"
                                                        style="width: 30%; text-align: center;" class="form-control m-auto"
                                                        placeholder="Jumlah Kamar" min="1" max="<?= $stokKamarDeluxe ?>">
                                                    <button style="background-color: #FF6500;"
                                                        class="btn text-white w-75 d-block m-auto mt-3"
                                                        <?= $kamar['tipe'] == "Deluxe" && intval($kamarDeluxe) < 1 ? 'disabled' : '' ?>>Pesan</button>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <a href="./fasilitas.php"
                                                    class="btn w-75 d-block m-auto mt-5"
                                                    style="background-color: #FF6500; color: white; border: 2px solid #FF6500; text-align: center; transition: all 0.3s ease;"
                                                    onmouseover="this.style.backgroundColor='white'; this.style.color='#FF6500';"
                                                    onmouseout="this.style.backgroundColor='#FF6500'; this.style.color='white';">
                                                    Lihat Fasilitas
                                                </a>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include "layout/footer.php" ?>

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == "tgltdkvalid") : ?>
            <div class="container">
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesanan gagal!',
                        text: 'Format Tanggal tidak valid!',
                        footer: 'Coba cek kembali format tanggal'
                    })
                </script>
            </div>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == "tgl-cekin-salah") : ?>
            <div class="container">
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesanan gagal!',
                        text: 'Tanggal Checkin tidak boleh lebih kecil dari tanggal sekarang!',
                    })
                </script>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>