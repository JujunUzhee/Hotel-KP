<?php
session_start();
include "logic/functions.php";
include "layout/cookie.php";

$ulasan = query("SELECT * FROM reviews ORDER BY created_at DESC");
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
    
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4 mt-5">
            <h2 class="fw-bold">ULASAN PELANGGAN</h2>
            <p class="text-muted">Ulasan dengan rating tertinggi dari pelanggan kami.</p>
        </div>
        <div class="col-lg-10 mb-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($ulasan as $item): ?>
                    <div class="col">
                        <div class="card text-center h-100 shadow-sm">
                            <div class="card-body">
                                <img src="./img/profil/<?= htmlspecialchars($item['foto'] ?? 'default-laki-laki.png') ?>" alt="Customer" class="rounded-circle mb-2" width="70">
                                <h5 class="fw-bold"><?= htmlspecialchars($item['customer_name']) ?></h5>
                                <p class="card-text">"<?= htmlspecialchars($item['review_text']) ?>"</p>
                                <div class="text-warning">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?= $i <= $item['rating'] ? '★' : '☆' ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>