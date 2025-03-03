<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-kamar");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$dataKamar = query("SELECT * FROM kamar ORDER BY tarif ASC");
$hotel = query("SELECT * FROM identitas")[0];
$i = 1;
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
                            <h1 class="m-0">Data Kamar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Kamar </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid p-5">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kamar</h3>
                        </div>
                        <?php if (isset($_GET['pesan']) && $_GET['pesan'] === 'berhasil'): ?>
                            <div class="alert alert-success">Status kamar berhasil diperbarui!</div>
                        <?php endif; ?>
                        <?php if (count($dataKamar) > 0) : ?>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="datatab" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                                <thead class="text-center bg-primary">
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Tipe Kamar</th>
                                                        <th scope="col">Nomor Kamar</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Harga Permalam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($dataKamar as $kamar) : ?>
                                                        <tr class="text-center bg-white">
                                                            <td><?= $i++; ?></td>
                                                            <td><?= ucfirst($kamar['jenis_kamar']) ?></td>
                                                            <td><?= $kamar['no_kamar'] ?></td>
                                                            <td><?= $kamar['status'] ?></td>
                                                            <td><?= $kamar['tarif'] ?></td>
                                                            <td>
                                                                <a href="edit-status.php?id=<?= $kamar['id'] ?>" class="btn btn-primary btn-sm text-white">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php else : ?>
                            <h5 class="text-muted text-center"> *Belum ada pesanan </h5>
                        <?php endif; ?>

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

    <?php include "layout/bawah.php" ?>
</body>

</html>