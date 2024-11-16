<?php
session_start();
include "logic/functions.php";

if (!$_GET['page']) {
    header("Location: ./index.php?page=index");
}

include "layout/cookie.php";

$hotel = query("SELECT * FROM identitas")[0];
$sosialMedia = query("SELECT * FROM sosial_media")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #F5F7F8;">
    <?php include "./layout/navbar.php" ?>

    <div class="container">
        <!-- Caraousel -->
        <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel" style="margin-top: 7rem;">
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

 <!-- Selamat Datang -->
 <div class="row justify-content-center mt-5">
            <div class="text-center">
                <h3 class="fw-bold">SELAMAT DATANG DI HOTEL RAHAYU</h3>
                <p class="lead text-center mx-5 my-4" style="font-size: 16px; line-height: 1.8;">Hotel Rahayu dikelilingi oleh keindahan pegunungan yang indah, danau dan sawah menghijau. Nikmati sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau.</p>
                <div class="d-flex justify-content-center gap-5 flex-wrap mt-4">
                <div class="card" style="width: 24rem;">
                <img src="./img/Beranda/Pictures1.jpg" class="card-img-top" alt="...">
                </div>
                <div class="card" style="width: 24rem;">
                <img src="./img/Beranda/Pictures2.jpg" class="card-img-top" alt="...">
                </div>
                <div class="card" style="width: 24rem;">
                <img src="./img/Beranda/Pictures3.jpg" class="card-img-top" alt="...">
                </div>
                </div>
            </div>
        
    </div>


    <!-- Hubungi Kami dan informasi -->
    <div class="row justify-content-center mt-5">
    <div class="col-12 text-center mb-4 mt-5">
        <h2 class="fw-bold">HUBUNGI KAMI & INFORMASI</h2>
    </div>
    <div class="col-lg-5 bg-white p-4 text-center rounded shadow-sm me-4">
        <h4 class="fw-bold ">Informasi</h4>
        <div class="mt-4">
            <h5>Check-In</h5>
            <p>Jam Check-In Standar: 12.00 WIB</p>
            <p class="text-muted" style="margin-top: -1.3rem;">*Waktu Check-In dari plan mempunyai prioritas lebih besar</p>
            <h5 class="mt-4">Check-Out</h5>
            <p>Jam Check-Out Standar: 12.00 WIB</p>
            <p class="text-muted" style="margin-top: -1.3rem;">*Waktu Check-Out dari plan mempunyai prioritas lebih besar</p>
        </div>
    </div>
    <div class="col-lg-5 bg-white p-4 text-center rounded shadow-sm">
        <h4 class="fw-bold ">Hubungi Kami</h4>
        <p class="text-muted mt-5"><?= $hotel['alamat'] ?></p>
        <div class="d-flex justify-content-center mt-4">
            <a href="https://api.whatsapp.com/send/?phone=<?= $sosialMedia['whatsapp'] ?>&text&app_absent=0"
                target="_blank" class="me-4 icon-link">
                <i class="fab fa-whatsapp fs-2"></i>
            </a>
            <a href="https://www.facebook.com/<?= $sosialMedia['facebook'] ?>" target="_blank"
                class="me-4 icon-link">
                <i class="fab fa-facebook fs-2"></i>
            </a>
            <a href="https://twitter.com/<?= $sosialMedia['twitter'] ?>" target="_blank" class="me-4 icon-link">
                <i class="fab fa-twitter fs-2"></i>
            </a>
            <a href="https://www.instagram.com/<?= $sosialMedia['instagram'] ?>/" target="_blank"
                class="me-4 icon-link">
                <i class="fab fa-instagram fs-2"></i>
            </a>
            <a href="mailto:<?= $hotel['email'] ?>" target="_blank" class="icon-link">
                <i class="fas fa-envelope fs-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Ulasan -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Judul -->
        <div class="col-12 text-center mb-4 mt-5">
            <h2 class="fw-bold">ULASAN PELANGGAN</h2>
            <p class="text-muted">Terima kasih telah memesan di Hotel Rahayu! Berikut ulasan dari pelanggan kami.</p>
        </div>

        <!-- Card Container -->
        <div class="col-lg-10">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Card 1 -->
                <div class="col">
                    <div class="card text-center h-100 shadow-sm">
                        <div class="card-body">
                            <img src="./img/profil/default-laki-laki.png" alt="Customer" class="rounded-circle mb-2" width="80">
                            <h5 class="fw-bold">James Conway</h5>

                            <p class="card-text">"Pelayanan sangat baik dan fasilitas memuaskan!"</p>
                            <div class="text-warning">
                                ★★★★★
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col">
                    <div class="card text-center h-100 shadow-sm">
                        <div class="card-body">
                            <img src="./img/profil/default-laki-laki.png" alt="Customer" class="rounded-circle mb-2" width="80">
                            <h5 class="fw-bold">Augustine Watkins</h5>
                      
                            <p class="card-text">"Hotel ini memberikan pengalaman terbaik selama liburan."</p>
                            <div class="text-warning">
                                ★★★★☆
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col">
                    <div class="card text-center h-100 shadow-sm">
                        <div class="card-body">
                            <img src="./img/profil/default-perempuan.png" alt="Customer" class="rounded-circle mb-2" width="80">
                            <h5 class="fw-bold">Jorge McLaughlin</h5>
                   
                            <p class="card-text">"Kamar bersih, nyaman, dan lokasi strategis."</p>
                            <div class="text-warning">
                                ★★★★★
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
    <!-- Peta -->
    <div class="col-lg-12 mb-5">
        <h3 class="mt-5 text-center fw-bold">PETA LOKASI</h3>
        <div class="col-lg-12">
            <iframe class="map my-3 shadow"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0414749525626!2d108.50022669619666!3d-6.885635663660207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f19e7a1a8f0dd%3A0x7d120ee5e66d7dc7!2sHotel%20Rahayu!5e0!3m2!1sid!2sid!4v1728752470324!5m2!1sid!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <p class="text-center fw-normal text-muted"><?= $hotel['alamat'] ?></p>
    </div>
    </div>
    </div>

    <?php if (isset($_GET['pesan'])) : ?>
    <?php if ($_GET['pesan'] == "berhasil") : ?>
    <div class="container">
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Anda berhasil Masuk!'
        })
        </script>
    </div>
    <?php endif; ?>
    <?php if ($_GET['pesan'] == "berhasil-logout") : ?>
    <div class="container">
        <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Anda berhasil Keluar!'
        })
        </script>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>