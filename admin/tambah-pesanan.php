<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=tambah-pesanan");
}
if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];
$hotel = query("SELECT * FROM identitas")[0];
$kamarList = query("SELECT no_kamar, jenis_kamar FROM kamar WHERE status = 'tersedia'");

if (isset($_POST['submit'])) {
    if (tambahPesananAdmin($_POST) > 0) {
        echo "<script>
              alert('Pesanan berhasil ditambahkan');
              document.location.href = 'index.php?page=data-pesanan';
           </script>";
    } else {
        echo "<script>
              alert('Pesanan gagal ditambahkan');
           </script>";
    }
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
                            <h1 class="m-0">Tambah Pesanan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Tambah Pesanan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card p-5">
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Pemesan</label>
                                                <input type="text" name="nama" class="form-control" id="nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat Rumah</label>
                                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No. Telepon</label>
                                                <input type="tel" name="telp" class="form-control" id="telp" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cekin">Tanggal Check In</label>
                                                <input type="date" name="cekin" class="form-control" id="cekin" required onchange="calculateDuration()">
                                            </div>
                                            <div class="form-group">
                                                <label for="cekout">Tanggal Check Out</label>
                                                <input type="date" name="cekout" class="form-control" id="cekout" required onchange="calculateDuration()">
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_pemesanan">Tanggal Pemesanan</label>
                                                <input type="date" name="tgl_pemesanan" class="form-control" id="tgl_pemesanan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tipe-kamar">Tipe Kamar</label>
                                                <select name="tipe_kamar" class="form-control" id="tipe-kamar" required>
                                                    <option value="" selected disabled>Pilih Tipe Kamar</option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Deluxe">Deluxe</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_kamar">Jumlah Kamar</label>
                                                <input type="number" name="jumlah_kamar" class="form-control" id="jumlah-kamar" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_per_malam">Harga per Malam</label>
                                                <input type="text" name="harga_per_malam" class="form-control" id="harga_per_malam" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="total-biaya">Total Biaya</label>
                                                <input type="text" name="total_biaya" class="form-control" id="total-biaya" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="durasi">Durasi Menginap</label>
                                                <input type="number" name="durasi" class="form-control" id="durasi" required min="1" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="no-kamar">No Kamar</label>
                                                <select name="no_kamar" class="form-control" id="no-kamar" required>
                                                    <option value="" selected disabled>Pilih Nomor Kamar</option>
                                                    <?php foreach ($kamarList as $kamar) : ?>
                                                        <option value="<?= htmlspecialchars($kamar['no_kamar']); ?>">
                                                            <?= htmlspecialchars($kamar['no_kamar']) . " - " . htmlspecialchars($kamar['jenis_kamar']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" class="form-control" id="status" required>
                                                    <option value="belum dibayar">Belum Dibayar</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="berhasil">Berhasil</option>
                                                    <option value="batal">Batal</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Tambah Pesanan</button>
                                </form>
                            </div>
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

    <?php include "layout/bawah.php" ?>
    <script>
        function calculateDuration() {
            const checkInDate = new Date(document.getElementById('cekin').value);
            const checkOutDate = new Date(document.getElementById('cekout').value);
            const timeDifference = checkOutDate - checkInDate;
            const daysDifference = timeDifference / (1000 * 3600 * 24);
            document.getElementById('durasi').value = daysDifference > 0 ? daysDifference : 0;
        }
    </script>
</body>

</html>