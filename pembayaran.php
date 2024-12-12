<?php
session_start();
include "logic/functions.php";
$id = $_GET['id'];
$idUser = $_SESSION['id'];

if (!$_GET['page']) {
    header("Location: ./pembayaran.php?page=pemesanan&id=$id");
}

include "layout/cookie.php";

$id = $_GET['id'];
$pesanan = query("SELECT * FROM pemesanan WHERE status = 'belum dibayar' && id = '$id'")[0];
$tipeKamar = $pesanan['tipe_kamar'];
$tanggalPesanan = $pesanan['tgl_pemesanan'];

$jumlahKamar = query("SELECT jumlah_kamar FROM pemesanan WHERE tgl_pemesanan = '$tanggalPesanan'");
$pemesan = query("SELECT * FROM pelanggan WHERE id = '$idUser'")[0];
$nomorKamar = query("SELECT no_kamar,jenis_kamar FROM kamar WHERE jenis_kamar = '$tipeKamar' AND status = 'dipesan' AND kamar.tgl_pemesanan = '$tanggalPesanan' ");
$i = 1;
$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <?php include "./layout/navbar.php" ?>

   
    <div class="container my-5 pt-5">
    <div class=" rounded-3 shadow-lg p-4 bg-white ">
    <h1 class="container text-center " >PEMBAYARAN</h1>
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-10 ">
                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $pesanan['id']; ?>">
                    
                    <!-- Tipe Kamar -->
                    <div class="row mt-4 justify-content-center">
                        <div class="col-lg-7">
                            <label for="tipe-kamar" class="form-label">Tipe Kamar</label>
                            <input required readonly name="tipe-kamar" type="text" class="form-control" value="<?= $pesanan['tipe_kamar'] ?>">
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="nama-pembayar" class="form-label">Nama Lengkap</label>
                            <input required name="nama-pembayar" type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $pemesan['nama'] ?>">
                        </div>
                    </div>

                    <!-- Jumlah Kamar -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="jumlah-kamar" class="form-label">Jumlah Kamar</label>
                            <input required readonly name="jumlah-kamar" type="text" class="form-control" value="<?= $pesanan['jumlah_kamar'] ?>">
                        </div>
                    </div>

                    <!-- Pilih Bank -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="bank" class="form-label">Bank</label>
                            <select name="bank" id="bank" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Bank --</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                            </select>
                        </div>
                    </div>

                    <!-- No Rekening -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="nomor-rekening" class="form-label">No. Rekening</label>
                            <input required name="nomor-rekening" type="text" class="form-control" placeholder="No Rekening">
                        </div>
                    </div>

                    <!-- Nama Pemilik Kartu -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="nama-pemilik-kartu" class="form-label">Nama Pemilik Kartu</label>
                            <input required name="nama-pemilik-kartu" type="text" class="form-control" placeholder="Nama Pemilik Kartu">
                        </div>
                    </div>

                    <!-- Bukti Transfer -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="bukti" class="form-label">Bukti Transfer</label>
                            <input required name="bukti" type="file" class="form-control">
                        </div>
                    </div>

                    <!-- Jumlah Bayar -->
                    <div class="row mt-3 justify-content-center">
                        <div class="col-lg-7">
                            <label for="total-bayar" class="form-label">Jumlah Bayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input readonly required name="total-bayar" type="text" class="form-control" value="<?= rupiah($pesanan['total_biaya']); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-6 text-center">
                            <button class="btn text-white btn-lg my-3 w-100" style="background-color: #FF6500" name="bayar" type="submit">Bayar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

    </div>

    <?php
    if (isset($_POST['bayar'])) {
        if (tambahPembayaran($_POST) > 0) {
            echo "<script>
                    function pindahHalaman() {
                        document.location.href = './pesanan.php?page=pesanan';
                    }
                    
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Pesanan telah dibayar!',
                    showConfirmButton: false,
                    timer: 1500
                    });
                    setTimeout(pindahHalaman, 1500);
                </script>";
        } else {
            echo "<script>
        alert('Pesanan Gagal');
        </script>";
        }
    }
    ?>

    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>