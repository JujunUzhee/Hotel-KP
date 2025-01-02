<?php
session_start();
include "logic/functions.php";
include "layout/cookie.php";

// Mendapatkan data hotel dari database
$hotel = query("SELECT * FROM identitas")[0];

$success = $error = "";
$order_id = $_GET['order_id'] ?? null; // Pastikan order_id dikirimkan melalui URL atau form

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];

    // Periksa apakah ulasan sudah ada untuk pesanan ini
    if (hasReviewForOrder($koneksi, $order_id)) {
        $error = "Ulasan untuk pesanan ini sudah pernah dikirim.";
    } else {
        // Panggil fungsi saveReview untuk menyimpan ulasan
        $result = saveReview($koneksi, $nama, $email, $rating, $ulasan, $order_id);

        if ($result === true) {
            $success = "Ulasan Anda telah berhasil dikirim!";
        } else {
            $error = $result;
        }
    }
}

?>
<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>
<style>
.rating i {
   font-size: 2rem;
   color: #ddd;
   cursor: pointer;
}

.rating i.selected {
   color: #FFD700;
}

    </style>
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

    <h2 class="mt-5 text-center pt-5 text-uppercase">Form Ulasan</h2>
    <div class="container my-5">
        <div class="m-auto rounded-3">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 card p-4">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success text-center">
                            <?= $success ?>
                        </div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger text-center">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post" autocomplete="off">

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input required name="nama" type="text" class="form-control" id="nama" value="<?= $dataPelanggan['nama']; ?>" readonly>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input required name="email" type="email" class="form-control" id="email" value="<?= $dataPelanggan['email']; ?>" readonly>
                        </div>

                        <!-- Rating -->
                        <div class="mb-4">
        <label for="rating" class="form-label">Rating</label>
        <div class="rating d-flex justify-content-center" id="star-rating">
    <i class="fas fa-star" data-value="1"></i>
    <i class="fas fa-star" data-value="2"></i>
    <i class="fas fa-star" data-value="3"></i>
    <i class="fas fa-star" data-value="4"></i>
    <i class="fas fa-star" data-value="5"></i>
</div>
<input type="hidden" name="rating" id="rating-value">

                        <!-- Ulasan -->
                        <div class="mb-4">
                            <label for="ulasan" class="form-label">Ulasan</label>
                            <textarea required name="ulasan" class="form-control" id="ulasan" rows="5"
                                placeholder="Tulis ulasan Anda di sini"></textarea>
                        </div>

                        <!-- Hidden Input for Order ID -->
                        <input type="hidden" name="order_id" value="<?= $pesanan['id_pesanan']; ?>">

                        <div class="text-center">
                            <button class="btn text-white btn-lg w-100" style="background-color: #FF6500;" type="submit">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        <script>
        const stars = document.querySelectorAll('#star-rating i');
const ratingValue = document.getElementById('rating-value');

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        // Set nilai rating berdasarkan bintang yang diklik
        const value = star.getAttribute('data-value');
        ratingValue.value = value;

        // Tambahkan class 'selected' untuk bintang aktif
        stars.forEach((s, i) => {
            if (i < index + 1) {
                s.classList.add('selected');
            } else {
                s.classList.remove('selected');
            }
        });
    });

    // Highlight bintang saat hover
    star.addEventListener('mouseover', () => {
        stars.forEach((s, i) => {
            if (i < index + 1) {
                s.classList.add('hover');
            } else {
                s.classList.remove('hover');
            }
        });
    });

    // Reset highlight saat mouse keluar
    star.addEventListener('mouseout', () => {
        stars.forEach(s => s.classList.remove('hover'));
    });
});

    </script>
</body>

</html>