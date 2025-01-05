<?php
session_start();

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";
if (isset($_POST['tambah'])) {
    if (tambahKamar($_POST) > 0) {
        echo "<script>
                alert('Kamar Berhasil Ditambahkan');
                document.location.href= 'index.php';
                </script>";
    } else {
        echo "<script>
                alert('Kamar Gagal Ditambahkan');
                document.location.href= 'index.php';
              </script>";
    }
}

$jenisKamar = strtolower($_POST['tipe']);
$id = $_SESSION['id'];

// Periksa apakah hasil query tidak kosong sebelum mengakses array
$data = query("SELECT * FROM pegawai WHERE id = '$id'");
$dataKamar = query("SELECT * FROM kamar WHERE LOWER(jenis_kamar) = '$jenisKamar'");
$nomorKamarQuery = query("SELECT no_kamar FROM kamar ORDER BY id DESC LIMIT 1");

if (!empty($data) && !empty($dataKamar) && !empty($nomorKamarQuery)) {
    $data = $data[0];
    $dataKamar = $dataKamar[0];
    $nomorKamar = intval($nomorKamarQuery[0]['no_kamar']) + 1;
    $tarif = $dataKamar['tarif'];
} else {
    // Tangani error jika data tidak ditemukan
    echo "<script>
            alert('Data tidak ditemukan, silakan cek kembali.');
            document.location.href= 'tambah-kamar.php';
          </script>";
    exit;
}

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
                            <h1 class="m-0">Input Data Kamar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Input Data Kamar </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="container card p-5 col-lg-8">
                        <h3 class="text-center">Tambah Data Kamar</h3>
                        <form action="" method="post" autocomplete="off">

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="id-stok-kamar" class="form-label">Id Stok Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input readonly value="<?= $dataKamar['id_stok_kamar']; ?>" type="text" class="form-control" name="id-stok-kamar" id="id-stok-kamar" placeholder="Id Stok Kamar">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="tipe-kamar" class="form-label">Tipe Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input readonly value="<?= $dataKamar['jenis_kamar']; ?>" type="text" class="form-control" name="tipe-kamar" id="tipe-kamar" placeholder="Id Stok Kamar">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="jumlah" class="form-label">Jumlah Tambah</label>
                                </div>
                                <div class="col-lg-6">
                                    <input readonly value="1" type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Id Stok Kamar">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="tarif" class="form-label">Tarif Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control" name="tarif" value="<?= $tarif; ?>" id="tarif">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3 d-none">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="gambar" class="form-label">Gambar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input readonly type="text" class="form-control" name="gambar" id="gambar" value="<?= $dataKamar['gambar']; ?>">
                                </div>
                            </div>

                            <div class="row justify-content-center my-3">
                                <div class="col-lg-3 text-end mt-1">
                                    <label for="no-kamar" class="form-label">Nomor Kamar</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="no-kamar" value="<?= $nomorKamar; ?>" id="no-kamar">
                                </div>
                            </div>


                            <div class="row justify-content-center">
                                <button class="btn btn-primary w-50 m-auto mt-5" type="submit" name="tambah">Tambah</button>
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

    <?php include "layout/bawah.php" ?>
</body>

</html>