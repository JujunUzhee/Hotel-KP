<?php
session_start();

if (!$_GET['page']) {
    header("Location: ?page=data-pesanan");
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
}

include "../logic/functions.php";

if (isset($_POST['batal'])) {
    if (batalkanPesanan($_POST) > 0) {
        echo "<script>
              alert('data berhasil dibatalkan');
              document.location.href = '?page=detail-pemesanan';
           </script>";
    } else {
        echo "<script>
              alert('data berhasil dibatalkan');
              document.location.href = '?page=detail-pemesanan';
           </script>";
    }
}
if (isset($_POST['hapus'])) {
    $id = $_POST['id']; // Pastikan ID pesanan dikirim melalui POST
    if (hapusPesananAdmin($id) > 0) {
        echo "<script>
            alert('Pesanan Berhasil Dihapus');
            document.location.href = '?page=data-pesanan';
        </script>";
    } else {
        echo "<script>
            alert('Pesanan Gagal Dihapus');
        </script>";
    }
}

$id = $_SESSION['id'];
$data = query("SELECT * FROM pegawai WHERE id = '$id'")[0];

$dataPemesanan = query("SELECT * FROM pemesanan");
$i = 1;
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
                            <h1 class="m-0">Data Pesanan</h1>
                        </div><!-- /.col -->
                    
                        <div class="col-sm-6 text-right">
                            <a href="tambah-pesanan.php" class="btn btn-success">Tambah Pesanan</a>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <?php if (count($dataPemesanan) > 0) : ?>
                        <table id="table" class="table table-striped hover" style="width:100%">
                            <thead class="text-center bg-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pemesan</th>
                                    <th scope="col">Tipe Kamar</th>
                                    <th scope="col">Jumlah Kamar</th>
                                    <th scope="col">Lama Inap</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataPemesanan as $pemesanan) : ?>
                                    <tr class="text-center">
                                        <td><?= $i++; ?></td>
                                        <td><?= $pemesanan['nama_pemesan'] ?></td>
                                        <td><?= $pemesanan['tipe_kamar'] ?></td>
                                        <td><?= $pemesanan['jumlah_kamar'] ?> Kamar</td>
                                        <td><?= $pemesanan['durasi_menginap'] ?> Malam</td>
                                        <td><?= ucfirst($pemesanan['status']) ?></td>
                                        <td>
                                            <a href="detail-pemesanan.php?id=<?= $pemesanan['id']; ?>" class="btn btn-primary mx-2">Detail</a>
                                            <button type="button" class="btn btn-danger mx-2" onclick="confirmDelete(<?= $pemesanan['id']; ?>)">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <h5 class="text-muted text-center"> *Belum ada pesanan </h5>
                    <?php endif; ?>

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
        $(document).ready(function() {
            $('#table').DataTable();
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('<form>', {
                        "method": "POST",
                        "html": '<input type="hidden" name="id" value="' + id + '"><input type="hidden" name="hapus" value="true">'
                    }).appendTo(document.body).submit();
                }
            })
        }
    </script>
</body>

</html>