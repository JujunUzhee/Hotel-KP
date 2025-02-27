<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=tambah-fasilitas");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];

if ($data['role'] == "resepsionis") {
    header("location: ../admin/");
}
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
                            <h1 class="m-0">Tambah Fasilitas</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Tambah Fasilitas </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <form action="proses-tambah-fasilitas.php?page=tambah-fasilitas" method="post" autocomplete="off">
                        <div class="container card card-primary card-outline p-5 col-lg-8">

                            <div class="row justify-content-center mb-3">
                                <div class="col-lg-12 text-center">
                                    <label for="tipe-kamar" class="form-label">
                                        <h5>Tipe Kamar</h5>
                                    </label>
                                </div>
                                <div class="col-lg-7 m-auto">
                                    <select name="tipe" id="tipe-kamar" class="form-select" required>
                                        <option value="" disabled selected>Pilih Jenis Kamar</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Deluxe">Deluxe</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <button class="btn btn-primary w-50 m-auto mt-5" name="submit" type="submit">Tambah</button>
                            </div>

                    </form>
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
        <?php if ($_GET['pesan'] == "gagal-tambah-fasilitas") : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Fasilitas gagal ditambahkan!',
                        footer: 'Coba cek kembali data yang diinputkan'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == "gagal-upload-fasilitas") : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Fasilitas gagal ditambahkan!',
                        footer: 'Pilih gambar terlebih dahulu'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == "invalid-upload-fasilitas") : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Fasilitas gagal ditambahkan!',
                        footer: 'Yang anda upload bukan gambar'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
        <?php if ($_GET['pesan'] == "terlalu-besar-fasilitas") : ?>
            <script>
                var delayInMilliseconds = 1000; //1 second

                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Fasilitas gagal ditambahkan!',
                        footer: 'Ukuran gambar terlalu besar'
                    })
                }, delayInMilliseconds);
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php include "layout/bawah.php" ?>
</body>

</html>