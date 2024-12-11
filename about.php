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
            <div class="col-lg-8 text-center w-100">
                <div class="card shadow border-0 mt-5">
                    <div  style="background-image: url('https://picsum.photos/1200/400'); height: 400px; background-size: cover; background-position: center; border-radius: 0.5rem;"></div>
                </div>
            </div>
        </div>
    </div>
        <!-- Tentang Kami -->
<div class="container py-5">
    <div class="row justify-content-center ">
        <div class="col-lg-10 text-center ">
            <h1 class="fw-bold mb-4 text-uppercase">Tentang Kami</h1>
            <p class="lead text-center" style="font-size: 18px; line-height: 1.8;"><?= $hotel['nama_hotel'] ?> <?= $hotel['tentang'] ?></p>
        </div>
    </div>


<!-- Struktur Organisasi -->
<div class="container mt-5">
    <h3 class="text-center fw-bold mb-4 text-uppercase">Struktur Hotel Rahayu</h3>
    <div class="d-flex justify-content-center mt-5">
        <img src="./img/Stuktur.png" alt="Struktur Hotel Rahayu" class="img-fluid  custom-responsive">
    </div>
</div>
   
        </div>
    </div>

    <?php if (isset($_GET['pesan'])) : ?>
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
            });

            <?php if ($_GET['pesan'] == "berhasil") : ?>
                Toast.fire({
                    icon: 'success',
                    title: 'Anda berhasil Masuk!'
                });
            <?php elseif ($_GET['pesan'] == "berhasil-logout") : ?>
                Toast.fire({
                    icon: 'success',
                    title: 'Anda berhasil Keluar!'
                });
            <?php endif; ?>
        </script>
    </div>
<?php endif; ?>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>