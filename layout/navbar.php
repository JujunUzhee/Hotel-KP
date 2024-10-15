<?php $hotel = query("SELECT * FROM identitas")[0]; ?>
<?php if ($_SESSION['login'] == 1) : ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #AB886D;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo/<?= $hotel['logo_secondary'] ?>" width="30" alt="<?= $hotel['logo_primary'] ?>" style="margin-right: 5px;"> 
                <span style="font-weight: 600;"><?= $hotel['nama_hotel'] ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?= $_GET['page'] == 'index' ? 'active' : ''; ?>" href="./index.php?page=index" style="padding: 10px 15px;">Beranda</a>
                    <a class="nav-link <?= $_GET['page'] == 'profile' ? 'active' : ''; ?>" href="./profile.php?page=profile" style="padding: 10px 15px;">Profil</a>
                    <a class="nav-link <?= $_GET['page'] == 'kamar' ? 'active' : ''; ?>" href="./kamar.php?page=kamar" style="padding: 10px 15px;">Kamar</a>
                    <a class="nav-link <?= $_GET['page'] == 'fasilitas' ? 'active' : ''; ?>" href="./fasilitas.php?page=fasilitas" style="padding: 10px 15px;">Fasilitas</a>
                    <a class="nav-link <?= $_GET['page'] == 'pesanan' ? 'active' : ''; ?>" href="./pesanan.php?page=pesanan" style="padding: 10px 15px;">Pesanan</a>
                    <a class="nav-link" href="./logic/proses-logout.php" style="padding: 10px 15px;">Logout</a>
                </div>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #AB886D;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo/<?= $hotel['logo_secondary'] ?>" width="30" alt="<?= $hotel['logo_primary'] ?>" style="margin-right: 5px;"> 
                <span style="font-weight: 600;"><?= $hotel['nama_hotel'] ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?= $_GET['page'] == 'index' ? 'active' : ''; ?>" href="./index.php?page=index" style="padding: 10px 15px;">Beranda</a>
                    <a class="nav-link <?= $_GET['page'] == 'kamar' ? 'active' : ''; ?>" href="./kamar.php?page=kamar" style="padding: 10px 15px;">Kamar</a>
                    <a class="nav-link <?= $_GET['page'] == 'fasilitas' ? 'active' : ''; ?>" href="./fasilitas.php?page=fasilitas" style="padding: 10px 15px;">Fasilitas</a>
                    <a class="nav-link" href="./logic/login.php" style="padding: 10px 15px;">Login</a>
                </div>
            </div>
        </div>
    </nav>
<?php endif; ?>
