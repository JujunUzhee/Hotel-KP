<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-fasilitas");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$dataSuperior = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'Standard' ");
$dataDeluxe = query("SELECT * FROM fasilitas WHERE tipe_kamar = 'deluxe' ");
$hotel = query("SELECT * FROM identitas")[0];
?>

<?php include 'layout/atas.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php include "layout/preloader.php" ?>

        <?php include "layout/navbar.php" ?>

        <?php include "layout/sidebar.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Fasilitas</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Fasilitas </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid p-5">

                    <button class="btn fs-4 text-center d-block m-auto position-relative">
                        Standard
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            <?= count($dataSuperior) ?>
                        </span>
                    </button>
                    <hr class="w-25 m-auto mb-3">
                    <!-- <div class="card p-3"> -->
                    <div class="row mt-3 mb-5 g-3 justify-content-center">
                        <?php foreach ($dataSuperior as $superior) : ?>
                            <div class="col-10 col-lg-3">
                                <div class="card" style="height: 22rem;">
                                    <img src="../img/fasilitas/<?= $superior["gambar"] ?>" class="card-img-top" alt="..." style="height:150px">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 11pt; text-align: center; font-weight: bold;"><?= $superior["fasilitas"] ?></h5>
                                        <p class="card-text mt-3 position-relative-" style="text-align: justify; font-size: 9pt;"><?= $superior["deskripsi"] ?></p>
                                    </div>
                                    <div class="row p-3">
                                        <div class="col-6 text-center">
                                            <a href="ubah-fasilitas.php?id=<?= $superior['id'] ?>" class="btn w-100 btn-success">Ubah</a>
                                        </div>
                                        <div class="col-6 text-center">
                                            <a href="../logic/proses-hapus-fasilitas.php?id=<?= $superior['id'] ?>" class="btn w-100 btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- </div> -->
                    </div>
                </div>

                    <button class="btn fs-4 text-center d-block m-auto position-relative">
                        Deluxe
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            <?= count($dataDeluxe) ?>
                        </span>
                    </button>
                    <hr class="w-25 m-auto">
                    <!-- <div class="card p-3"> -->
                    <div class="row mt-3 mb-5 g-3 justify-content-center">
                        <?php foreach ($dataDeluxe as $deluxe) : ?>
                            <div class="col-10 col-lg-3">
                                <div class="card" style="height: 22rem;">
                                    <img src="../img/fasilitas/<?= $deluxe["gambar"] ?>" class="card-img-top" alt="..." style="height:150px">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 11pt; text-align: center; font-weight: bold;"><?= $deluxe["fasilitas"] ?></h5>
                                        <p class="card-text mt-3" style="text-align: justify; font-size: 9pt;"><?= $deluxe["deskripsi"] ?></p>
                                    </div>
                                    <div class="row p-3">
                                        <div class="col-6 text-center">
                                            <a href="ubah-fasilitas.php?id=<?= $deluxe['id'] ?>" class="btn w-100 btn-success">Ubah</a>
                                        </div>
                                        <div class="col-6 text-center">
                                            <a href="../logic/proses-hapus-fasilitas.php?id=<?= $deluxe['id'] ?>" class="btn w-100 btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- </div> -->
                    </div>

                </div>

        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="#">Hotel Rahayu</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 5.1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == 'berhasil-ubah-fasilitas') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Fasilitas berhasil diubah!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'berhasil-hapus-fasilitas') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Fasilitas berhasil dihapus!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == 'berhasil-tambah-fasilitas') : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Fasilitas berhasil ditambahkan!'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php include "layout/bawah.php" ?>
</body>

</html>