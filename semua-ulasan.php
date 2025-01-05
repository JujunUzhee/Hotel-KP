<?php
session_start();
include "logic/functions.php";
include "layout/cookie.php";
if (!$_GET['page']) {
    header("Location: ./semua-ulasan.php?page=semua-ulasan");
}
$ulasan = query("SELECT * FROM reviews ORDER BY created_at DESC");
$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<?php include "layout/atas.php"; ?>
<body style="background-color: #eaeaea;">
<?php include "./layout/navbar.php" ?>
    
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4 mt-5">
            <h2 class="fw-bold">ULASAN PELANGGAN</h2>
            <p class="text-muted">Ulasan dengan rating tertinggi dari pelanggan kami.</p>
        </div>
        <div class="col-lg-10 mb-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($ulasan as $item): ?>
                    <div class="col">
                        <div class="card text-center h-100 shadow-sm">
                            <div class="card-body">
                                <img src="./img/profil/<?= htmlspecialchars($item ['foto'] ?? 'default-laki-laki.png') ?>" alt="Customer" class="rounded-circle mb-2" width="70">
                                <h5 class="fw-bold"><?= htmlspecialchars($item['customer_name']) ?></h5>
                                <p class="card-text">"<?= htmlspecialchars($item['review_text']) ?>"</p>
                                <div class="text-warning">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?= $i <= $item['rating'] ? '★' : '☆' ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



    <?php include "layout/footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>