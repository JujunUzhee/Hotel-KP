<?php
session_start();
include "logic/functions.php";
if (!$_GET['page']) {
    header("Location: ./pesanan.php?page=pesanan");
}

include "layout/cookie.php";

if (!$_SESSION['login']) {
    $_SESSION['login'] = 0;
} else if ($_SESSION['login'] == 1) {
    $id = $_SESSION['id'];
    $data = query("SELECT * FROM pemesanan WHERE id_pelanggan = '$id' ORDER BY status ASC");

    $dataPelanggan = query("SELECT * FROM pelanggan WHERE id = '$id'")[0];
    $nama = $dataPelanggan['nama'];

    $jumlahPesanan = query("SELECT count(*) FROM pemesanan WHERE id_pelanggan = '$id'")[0]['count(*)'];
    $i = 1;
} elseif ($_SESSION['login'] == 2) {
    header("Location: admin/");
} else if ($_SESSION['login'] == 3) {
    header("Location: admin/");
}

if (isset($_POST['batal'])) {
    echo "<script>
                document.location.href = 'logic/proses-batal-pesanan.php?id=" . $_POST['id'] . "';
            </script>";
}

if (isset($_POST['checkout'])) {
    if (checkoutPesanan($_POST) > 0) {
        echo "<script>
            alert('Checkout Berhasil');
            document.location.href = './';
        </script>";
    } else {
        echo "<script>
        alert('Checkout Gagal');
        </script>";
    }
}

if (isset($_POST['hapus'])) {
    if (hapusPesanan($_POST) > 0) {
        echo "<script>
            alert('Pesanan Berhasil Dihapus');
            document.location.href = './';
        </script>";
    } else {
        echo "<script>
        alert('Pesanan Gagal');
        </script>";
    }
}

$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>

<body style="background-color: #eaeaea;">
    <?php include "./layout/navbar.php" ?>

    <h1 class="container text-center " style="margin-top: 5rem; margin-bottom: 3rem;"> DATA PESANAN</h1>
    <?php if ($jumlahPesanan > 0) : ?>
        <div class="row justify-content-center">
            <?php foreach ($data as $pesanan) : ?>
                <div class="col-lg-3 mb-5">
                    <div class="card" style="width: 98%; margin: auto;">
                        <div class="card-header">
                            <?php if ($pesanan['status'] == "check out" || $pesanan['status'] == "batal") : ?>
                                <a onclick="return konfirmasi()" href="javascript:void(0)"><i class="fas fa-trash position-absolute text-secondary" style="right: 1rem; top: 1rem;"></i></a>
                            <?php endif; ?>
                            <h5 class="text-center" style="font-size: 12pt;"><?= $pesanan['tipe_kamar'] ?></h5>
                            <div class="d-block text-center" style="margin-top: -.7rem;">
                                <span class="text-muted text-center" style="font-size:8pt"><?= tanggal_indonesia(substr($pesanan['tgl_pemesanan'], 0, 10)) ?></span>
                                <span class="text-muted text-center" style="font-size:8pt"><?= substr($pesanan['tgl_pemesanan'], 10, 6) ?> <?= substr($pesanan['tgl_pemesanan'], 11, 2) > 12 ? "PM" : "AM" ?></span>
                            </div>
                        </div>
                        <form action="" method="POST" autocomplete="off">
                            <input type="hidden" name="id" id="id" value="<?= $pesanan['id'] ?>">
                            <input type="hidden" name="jumlah-kamar" id="jumlah-kamar" value="<?= $pesanan['jumlah_kamar']; ?>">
                            <input type="hidden" name="tgl-pemesanan" value="<?= $pesanan['tgl_pemesanan']; ?>">
                            <input type="hidden" name="tipe-kamar" id="tipe-kamar" value="<?= $pesanan['tipe_kamar']; ?>">
                            <div class="card-body" style="font-size: 9pt;">
                                <div class="row justify-content-center g-1">
                                    <div class="col-5 text-lg-end">
                                        Nama:
                                    </div>
                                    <div class="col-6 offset-lg-1">
                                        <?= $pesanan['nama_pemesan'] ?>
                                    </div>
                                    <div class="col-5 text-lg-end">
                                        Jumlah:
                                    </div>
                                    <div class="col-6 offset-lg-1">
                                        <?= $pesanan['jumlah_kamar'] ?> Kamar
                                    </div>
                                    <div class="col-5 text-lg-end">
                                        Durasi:
                                    </div>
                                    <div class="col-6 offset-lg-1">
                                        <?= $pesanan['durasi_menginap'] ?> Malam
                                    </div>
                                    <div class="col-5 text-lg-end">
                                        CheckIn:
                                    </div>
                                    <div class="col-6 offset-lg-1">
                                        <?= tanggal_indonesia($pesanan['tgl_cek_in']) ?>
                                    </div>
                                    <div class="col-5 text-lg-end">
                                        CheckOut:
                                    </div>
                                    <div class="col-6 offset-lg-1">
                                        <?= tanggal_indonesia($pesanan['tgl_cek_out']) ?>
                                    </div>
                                    <div class="col-5 text-lg-end">
                                        Total:
                                    </div>
                                    <div class="col-6 offset-lg-1">
                                    Rp. <?= rupiah($pesanan['total_biaya']); ?>
                                    </div>
                                    <div class="col-12 text-center mt-3"><?= Ucfirst($pesanan['status']) ?><?= $pesanan['status'] == 'pending' ? '...' : '' ?></div>
                                </div>
                            </div>
                            <?php if ($pesanan['status'] == 'belum dibayar') : ?>
                                <div class="row justify-content-center text-center" style="font-size: 10pt;">
                                    <div class="col-12">Tranfer Ke Rekening: <?= $hotel['no_rekening'] ?></div>
                                </div>

                                <div class="row my-2 mt-3" style="font-size: 10pt;">
                                    <div class="col-12 text-center">Segera Lakukan Pembayaran Sebelum</div>
                                    <div class="col-12 text-center">Tanggal: <?= tanggal_indonesia(substr($pesanan['batas_pembayaran'], 0, 10)); ?> <?= substr($pesanan['batas_pembayaran'], 11, 5); ?> <?= substr($pesanan['batas_pembayaran'], 11, 5) > 12 ? "AM" : "PM" ?></div>
                                    <div class="col-12 text-center mt-1" style="font-size: 8pt;">*Jika tidak maka pesanan akan dibatalkan secara otomatis</div>
                                </div>
                                <div class="p-3 row justify-content-center">
                                    <div class="col-6 text-center">
                                        <a href="./pembayaran.php?id=<?= $pesanan['id']; ?>" class="btn btn-success m-auto mt-4 w-100">Bayar</a>
                                    </div>
                                    <div class="col-6 text-center">
                                        <button class="btn btn-danger m-auto mt-4 w-100" name="batal">Batal</button>
                                    </div>
                                </div>
                                <?php
                                $tglsekarang = date('Y-m-d H:i');
                                $batasBayar = date('Y-m-d H:i', strtotime($pesanan['batas_pembayaran']));
                                $tglCheckout = date('Y-m-d 12:00', strtotime($pesanan['tgl_cek_out']));
                                $jumlahKamar = intval($pesanan['jumlah_kamar']);
                                $tipeKamar = $pesanan['tipe_kamar'];
                                $tglPemesanan = $pesanan['tgl_pemesanan'];
                                $noKamar = query("SELECT no_kamar FROM kamar WHERE tgl_pemesanan = '$tglPemesanan' ORDER BY no_kamar ASC LIMIT $jumlahKamar");

                                if ($tglsekarang >= $batasBayar) {
                                    $id = $pesanan['id'];
                                    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'batal' WHERE status = 'belum dibayar' AND id = $id");
                                    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok + $jumlahKamar WHERE tipe = '$tipeKamar'");

                                    foreach ($noKamar as $no) {
                                        $nomor = $no['no_kamar'];
                                        mysqli_query($koneksi, "UPDATE kamar SET status = 'tersedia', tgl_pemesanan = NULL, tgl_check_out = NULL WHERE no_kamar = $nomor");
                                    }
                                    echo "<script>
                                            alert('Pesanan telah dibatalkan secara otomatis karena melebihi batas waktu pembayaran')
                                            document.location.href = './';
                                        </script>";
                                }

                                if ($pesanan['status'] == "berhasil" && $tglsekarang >= $tglCheckout) {
                                    $id = $pesanan['id'];
                                    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'check out' WHERE status = 'belum dibayar' AND id = $id");
                                    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok + $jumlahKamar WHERE tipe = '$tipeKamar'");

                                    foreach ($noKamar as $no) {
                                        $nomor = $no['no_kamar'];
                                        mysqli_query($koneksi, "UPDATE kamar SET status = 'tersedia', tgl_pemesanan = NULL, tgl_check_out = NULL WHERE no_kamar = $nomor");
                                    }
                                    echo "<script>
                                                alert('Checkout Otomatis');
                                                document.location.href = './';
                                            </script>";
                                }
                                ?>
                            <?php endif; ?>
                            <?php if ($pesanan['status'] == "pending") : ?>
                                <div class="row my-2 mb-5">
                                    <div class="col-12 text-center" style="font-size: 10pt;">Menunggu Verifikasi Pembayaran<?= $pesanan['status'] == 'pending' ? '...' : '' ?></div>
                                    <p class="text-muted text-center" style="font-size: 9pt;">*resepsionis akan memverifikasi pembayaran anda</p>
                                </div>
                            <?php endif; ?>
                            <?php if ($pesanan['status'] == "berhasil") : ?>
                                <div class="row my-2">
                                    <h5 class="text-muted text-center" style="font-size: 10pt;">Kamar berhasil dipesan</h5>
                                    <h5 class="text-muted text-center" style="font-size: 7pt;">*Kami tunggu kedatangannya pada <?= tanggal_indonesia($pesanan['tgl_cek_in']) ?> Jam 12.00 Siang </h5>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $pesanan['id']; ?>">
                                        <input type="hidden" name="jumlah-kamar" value="<?= $pesanan['jumlah_kamar']; ?>">
                                        <input type="hidden" name="tgl-cek-in" value="<?= $pesanan['tgl_cek_in']; ?>">
                                        <input type="hidden" name="tgl-pemesanan" value="<?= $pesanan['tgl_pemesanan']; ?>">
                                        <input type="hidden" name="tgl-cek-out" value="<?= $pesanan['tgl_cek_out']; ?>">
                                        <input type="hidden" name="durasi-menginap" value="<?= $pesanan['durasi_menginap']; ?>">
                                        <input type="hidden" name="total-biaya" value="<?= $pesanan['total_biaya']; ?>">
                                        <input type="hidden" name="nama-pemesan" value="<?= $pesanan['nama_pemesan']; ?>">
                                        <input type="hidden" name="telp" value="<?= $pesanan['telp']; ?>">
                                        <input type="hidden" name="alamat" value="<?= $pesanan['alamat']; ?>">
                                        <input type="hidden" name="status" value="<?= $pesanan['status']; ?>">
                                        <input type="hidden" name="batas-pembayaran" value="<?= $pesanan['batas_pembayaran']; ?>">
                                        <button class="btn btn-danger m-auto w-50 my-3" name="checkout">Check Out</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
           
            <?php endforeach; ?>
        </div>
        
    <?php else : ?>
        <div class="my-5">
            <h5 class="text-muted text-center">Anda belum memesan kamar</h5>
            <h5 class="text-muted text-center" style="font-size: 9pt; margin-bottom: 30rem;">*Silahkan pesan terlebih dahulu</h5>
        </div>
    <?php endif; ?>
   
    </div>
  
    </div>
    <?php include "layout/footer.php" ?>
    

    <?php if (isset($_GET['pesan'])) : ?>
        <?php if ($_GET['pesan'] == "berhasil-dibatalkan") : ?>
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
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Pesanan dibatalkan!'
                    })
                </script>
            </div>
        <?php endif; ?>
    <?php endif; ?>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        var delayInMilliseconds = 1000; //1 second

        function konfirmasi() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Terhapus!',
                        'Pesanan berhasil dihapus.',
                        'success'
                    )
                    setTimeout(function() {
                        document.location.href = "hapus-pesanan.php?id=<?= $pesanan['id']; ?>";
                    }, delayInMilliseconds);
                }
            })
        }
    </script>
</body>

</html>