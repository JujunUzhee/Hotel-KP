<?php
session_start();
include "logic/functions.php";

if (!$_GET['page']) {
    header("Location: ./about.php?page=about");
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


    <!-- Foto Tentang -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="card shadow border-0 mt-5">
                    <div  style="background-image: url('https://picsum.photos/1200/400'); height: 400px; background-size: cover; background-position: center; border-radius: 0.5rem;"></div>
                </div>
            </div>
        </div>
    </div>
        <!-- Tentang Kami -->
<div class="container py-5">
    <div class="row justify-content-center ">
        <div class="col-lg-8 text-center ">
            <h1 class="fw-bold mb-4 ">Tentang Kami</h1>
            <p class="lead" style="font-size: 18px; line-height: 1.8;"><?= $hotel['nama_hotel'] ?> <?= $hotel['tentang'] ?></p>
        </div>
    </div>


<!-- Struktur Organisasi -->
<div class="container mt-5">
    <h2 class="text-center org-header mb-4">Struktur Organisasi Hotel</h2>

    <!-- Owner -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-4 text-center">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/100');"></div>
                <div class="card-body">
                    <h5 class="org-title">Owner</h5>
                    <p class="org-name">Nama Owner</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Manager Operasional -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-4 text-center">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/100');"></div>
                <div class="card-body">
                    <h5 class="org-title">Manager Operasional</h5>
                    <p class="org-name">Himmatul Aliyah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff Rows -->
    <div class="row text-center mb-4">
        <div class="col-md-3 mb-3">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/80');"></div>
                <div class="card-body">
                    <h5 class="org-title">Admin</h5>
                    <p class="org-name">Himmatul Aliyah</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/80');"></div>
                <div class="card-body">
                    <h5 class="org-title">Keuangan</h5>
                    <p class="org-name">Uwaisy Al-Qorni</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/80');"></div>
                <div class="card-body">
                    <h5 class="org-title">Maintenance</h5>
                    <p class="org-name">Mumuh Muhidin</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/80');"></div>
                <div class="card-body">
                    <h5 class="org-title">Kontrol Logistik</h5>
                    <p class="org-name">Edi Sumardi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaders -->
    <div class="row text-center mb-4">
        <div class="col-md-6 mb-3">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/80');"></div>
                <div class="card-body">
                    <h5 class="org-title">Leader 1</h5>
                    <p class="org-name">Tatang Herdianto</p>
                    <ul class="list-unstyled mt-3">
                        <li class="org-role">Junaidi</li>
                        <li class="org-role">Wawan</li>
                        <li class="org-role">Aat</li>
                        <li class="org-role">Diki</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card org-card">
                <div class="org-image" style="background-image: url('https://picsum.photos/80');"></div>
                <div class="card-body">
                    <h5 class="org-title">Leader 2</h5>
                    <p class="org-name">Rohman</p>
                    <ul class="list-unstyled mt-3">
                        <li class="org-role">Slamet S</li>
                        <li class="org-role">Tata Suarta</li>
                        <li class="org-role">Jumad</li>
                        <li class="org-role">Edi S</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Hubungi Kami -->
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 text-center">
            <h2 class="fw-bold">Hubungi Kami</h2>
            <p class="mt-2"><?= $hotel['nama_hotel'] ?></p>
            <p class="text-muted"><?= $hotel['alamat'] ?></p>
            <div class="d-flex justify-content-center mt-4">
                <a href="https://api.whatsapp.com/send/?phone=<?= $sosialMedia['whatsapp'] ?>&text&app_absent=0" target="_blank" class="me-4 icon-link">
                    <i class="fab fa-whatsapp fs-2"></i>
                </a>
                <a href="https://www.facebook.com/<?= $sosialMedia['facebook'] ?>" target="_blank" class="me-4 icon-link">
                    <i class="fab fa-facebook fs-2"></i>
                </a>
                <a href="https://twitter.com/<?= $sosialMedia['twitter'] ?>" target="_blank" class="me-4 icon-link">
                    <i class="fab fa-twitter fs-2"></i>
                </a>
                <a href="https://www.instagram.com/<?= $sosialMedia['instagram'] ?>/" target="_blank" class="me-4 icon-link">
                    <i class="fab fa-instagram fs-2"></i>
                </a>
                <a href="mailto:<?= $hotel['email'] ?>" target="_blank" class="icon-link">
                    <i class="fas fa-envelope fs-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>


            <!-- Peta -->
            <div class="col-lg-12">
            <h3 class="mt-5 text-center fw-bold">Peta Lokasi</h3>
                    <div class="col-lg-12">
                    <iframe class="map my-3 shadow" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0414749525626!2d108.50022669619666!3d-6.885635663660207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f19e7a1a8f0dd%3A0x7d120ee5e66d7dc7!2sHotel%20Rahayu!5e0!3m2!1sid!2sid!4v1728752470324!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>