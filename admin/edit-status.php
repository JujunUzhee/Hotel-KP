<?php
session_start();
include "../logic/functions.php";

$id = $_GET['id'];

if (!isset($_GET['page'])) {
    header("Location: ?page=data-kamar&id=$id");
    exit;
}

if ($_SESSION['level'] == "Pelanggan" || empty($_SESSION['level'])) {
    header("location: ../logic/login.php?pesan=login");
    exit;
}

// Ambil data berdasarkan ID kamar
$kamar = query("SELECT * FROM kamar WHERE id = $id")[0];

// Periksa jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statusBaru = $_POST['status'];
    if (updateStatusKamar($id, $statusBaru) > 0) {
        header("Location: data-kamar.php?pesan=berhasil");
        exit;
    } else {
        $error = "Gagal memperbarui status kamar.";
    }
}

include 'layout/atas.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 70vh;">
                    <div class="row w-50">
                    <div class="col-sm-">
                            <h2 class="my-2 text-center">Edit Status Kamar</h2>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3 class="card-title">Form Edit Status Kamar</h3>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($error)): ?>
                                        <div class="alert alert-danger text-center"><?= $error; ?></div>
                                    <?php endif; ?>

                                    <form action="" method="POST">
                                        <div class="form-group text-center">
                                            <label for="status" class="font-weight-bold">Status</label>
                                            <select name="status" id="status" class="form-control w-50 mx-auto">
                                                <option value="tersedia" <?= $kamar['status'] === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                                <option value="dipesan" <?= $kamar['status'] === 'dipesan' ? 'selected' : '' ?>>Dipesan</option>
                                                <option value="terisi" <?= $kamar['status'] === 'terisi' ? 'selected' : '' ?>>Terisi</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="data-kamar.php" class="btn btn-secondary">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>   
    </div>
</body>
</html>
