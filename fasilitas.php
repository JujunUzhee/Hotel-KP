<?php
session_start();
include "logic/functions.php";

$dataSuperior = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'Standard' ");
$dataDeluxe = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'deluxe' ");

if (!$_GET['page']) {
    header("Location: ./fasilitas.php?page=fasilitas");
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

        <!-- Fasilitas -->
         <div class="my-4 text-center">
         <h1 class=" fw-bold typing">FASILITAS</h1>
         </div>
        
        <div class="card card-primary card-outline card-outline-tabs mb-5">
            <div class="card-header p-0 border-bottom-0 d-flex justify-content-center">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#standard"
                            role="tab" aria-controls="standard" aria-selected="true">Standard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#deluxe"
                            role="tab" aria-controls="deluxe" aria-selected="false">Deluxe</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <!-- Tab Standard -->
                    <div class="tab-pane fade active show" id="standard" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="row">
                            <?php foreach ($dataSuperior as $superior) : ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <a href="img/fasilitas/<?= $superior['gambar'] ?>" data-toggle="lightbox"
                                            data-title="<?= $superior['fasilitas'] ?>" data-gallery="gallery">
                                            <img src="img/fasilitas/<?= $superior['gambar'] ?>" class="card-img-top img-fluid " alt="Responsive image" style="height: 250px; ">
                                        </a>
                                        <h5 class="card-title text-center mt-2 fw-bold"><?= $superior['fasilitas'] ?></h5>
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text text-center flex-grow-1"><?= $superior['deskripsi'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Tab Deluxe -->
                    <div class="tab-pane fade" id="deluxe" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <div class="row">
                            <?php foreach ($dataDeluxe as $deluxe) : ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <a href="img/fasilitas/<?= $deluxe['gambar'] ?>" data-toggle="lightbox"
                                            data-title="<?= $deluxe['fasilitas'] ?>" data-gallery="gallery">
                                            <img src="img/fasilitas/<?= $deluxe['gambar'] ?>" class="card-img-top img-fluid" alt="Fasilitas Hotel" style="height: 250px;">
                                        </a>
                                        <h5 class="card-title text-center fw-bold mt-2"><?= $deluxe['fasilitas'] ?></h5>
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text text-center flex-grow-1"><?= $deluxe['deskripsi'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "layout/footer.php" ?>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });
    </script>
    <script src="src/plugins/jquery/jquery.min.js"></script>
    <script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="src/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script src="src/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="src/plugins/filterizr/jquery.filterizr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>