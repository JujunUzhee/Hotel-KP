<?php
ini_set('date.timezone', 'Asia/Jakarta');
$koneksi = mysqli_connect("localhost", "root", "", "aplikasi-hotel",3307);


// ========================================= LOGIC ===============================================================================================================  
function query($query)
{
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query);
    if (!$hasil) {
        die("Query error: " . mysqli_error($koneksi));
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }
    return $rows;
}

function checkOut()
{
}

function rupiah($angka)
{
    // Menghapus titik (untuk pemisah ribuan) dan mengganti koma dengan titik (untuk desimal)
    $angka = str_replace('.', '', $angka);  // Menghapus titik yang ada (jika ada pemisah ribuan)
    $angka = str_replace(',', '.', $angka); // Mengganti koma menjadi titik untuk desimal

    // Mengonversi menjadi float
    $angka = (float) $angka;

    // Menggunakan number_format untuk format uang
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    
    return $hasil_rupiah;
}


function tanggal_indonesia($tanggal)
{
    $bulan = array(
        1 =>       'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $var = explode('-', $tanggal);
    return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
}
// ========================== Akhir LOGIC =====================================================================================================================  

// ========================== FUNCTION Profil Petugas ==============================================================================================================
// ============ tambah
function tambahPetugas($data)
{
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['password'])));
    $konfirmasiPassword = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['confirm-password'])));
    $email = htmlspecialchars($data['email']);
    $telp = htmlspecialchars($data['telp']);
    $role = htmlspecialchars($data['role']);
    $jenisKelamin = htmlspecialchars($data['jenis-kelamin']);

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM pegawai WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                document.location.href = '?page=tambah-user&pesan=invalid-username';
            </script>";
        $_SESSION['nama'] = $_POST['nama'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['jenis-kelamin'] = $_POST['jenis-kelamin'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['confirm-password'] = $_POST['confirm-password'];
        $_SESSION['telp'] = $_POST['telp'];
        $_SESSION['role'] = $_POST['role'];
        return false;
    }

    if ($password !== $konfirmasiPassword) {
        echo "<script>
                document.location.href = '?page=tambah-user&pesan=invalid-password';
            </script>";
        return false;
    }

    $foto = "default-" . $data['jenis-kelamin'] . ".png";
    $query = "INSERT INTO pegawai VALUES ('', '$foto', '$nama', '$email', '$jenisKelamin', '$username', '$password', '$telp', '$role')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========= ubah
function ubahProfilePetugas($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $telp = htmlspecialchars($data['telp']);
    $email = htmlspecialchars($data['email']);
    $role = htmlspecialchars($data['level']);
    $fotoLama = htmlspecialchars($data['foto-lama']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = uploadProfilePetugas();
        if ($fotoLama !== "default-laki-laki.png " && $fotoLama !== "default-perempuan.png") {
            unlink('../img/profil/' . $fotoLama);
        }
    }

    mysqli_query($koneksi, "UPDATE pegawai SET 
                    foto = '$foto', 
                    nama = '$nama', 
                    email = '$email', 
                    username = '$username', 
                    telp = '$telp', 
                    role = '$role' 
                    WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

// ============ ubah password
function ubahPasswordPegawai($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $passwordLama = htmlspecialchars(hash('sha256', $data['password-lama']));
    $passwordBaru = htmlspecialchars($data['password']);
    $konfirmasiPassword = htmlspecialchars($data['konfirmasi-password']);

    $result = mysqli_query($koneksi, "SELECT password FROM pegawai WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($passwordLama !== $row['password']) {
        echo "<script>
            document.location.href = '?page=profile&pesan=password-lama-salah';
            </script>";
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['password-lama'] = $_POST['password-lama'];
        $_SESSION['konfirmasi-password'] = $_POST['konfirmasi-password'];
        return false;
    }

    if ($passwordBaru !== $konfirmasiPassword) {
        echo "<script>
        document.location.href = './tambah-fasilitas.php?pesan=username-invalid';
        </script>";
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['password-lama'] = $_POST['password-lama'];
        $_SESSION['konfirmasi-password'] = $_POST['konfirmasi-password'];
        return false;
    }

    $passwordBaru = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['password'])));

    mysqli_query($koneksi, "UPDATE pegawai SET password = '$passwordBaru' WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}

// ========= upload
function uploadProfilePetugas()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/profil/' . $namaFileBaru);

    return $namaFileBaru;
}
// ========================== Akhir FUNCTION Profil Petugas =================================================================================================================

// ========================== FUNCTION Profil Pelanggan =================================================================================================================
// ============ tambah
function daftarAkun($data)
{
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);
    $jenisKelamin = htmlspecialchars($data['jenis-kelamin']);
    $telp = htmlspecialchars($data['telp']);
    $alamat = htmlspecialchars($data['alamat']);
    $email = htmlspecialchars($data['email']);
    $nik = htmlspecialchars($data['nik']); // Tambahkan NIK
    $username = strtolower(stripslashes(htmlspecialchars($data['username'])));
    $password = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['password'])));
    $konfirmasiPassword = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['confirm-password'])));

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM pelanggan WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            document.location.href = './register.php?pesan=username-invalid';
            </script>";
        $_SESSION = $_POST;
        return false;
    }

    // cek apakah NIK sudah ada atau belum
    $resultNik = mysqli_query($koneksi, "SELECT nik FROM pelanggan WHERE nik = '$nik'");
    if (mysqli_fetch_assoc($resultNik)) {
        echo "<script>
            document.location.href = './register.php?pesan=nik-invalid';
            </script>";
        $_SESSION = $_POST;
        return false;
    }

    if ($password !== $konfirmasiPassword) {
        echo "<script>
        document.location.href = './register.php?pesan=password-invalid';
        </script>";
        $_SESSION = $_POST;
        return false;
    }

    $foto = "default-" . $data['jenis-kelamin'] . ".png";
    $query = "INSERT INTO pelanggan (id, nama, nik, jenis_kelamin, telp, alamat, email, status, username, password, foto)
    VALUES ('', '$nama', '$nik', '$jenisKelamin', '$telp', '$alamat', '$email', 'aktif', '$username', '$password', '$foto')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// ========= ubah
function ubahAkun($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $jenisKelamin = htmlspecialchars($data['jenis-kelamin']);
    $telp = htmlspecialchars($data['telp']);
    $alamat = htmlspecialchars($data['alamat']);
    $email = htmlspecialchars($data['email']);
    $gambarLama = htmlspecialchars($data['gambar-lama']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $gambarLama;
    } else {
        $foto = uploadProfil();
        if ($gambarLama !== "default-laki-laki.png" && $gambarLama !== "default-perempuan.png") {
            unlink('img/profil/' . $gambarLama);
        }
    }

    $query = "UPDATE pelanggan SET
            nama = '$nama',
            username = '$username',
            jenis_kelamin = '$jenisKelamin',
            telp = '$telp',
            alamat = '$alamat',
            email = '$email',
            foto = '$foto'
            WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========= ubah password
function ubahPassword($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $passwordLama = htmlspecialchars(hash('sha256', $data['password-lama']));
    $passwordBaru = htmlspecialchars($data['password-baru']);
    $konfirmasiPassword = htmlspecialchars($data['konfirmasi-password']);

    $result = mysqli_query($koneksi, "SELECT password FROM pelanggan WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($passwordLama !== $row['password']) {
        echo "<script>
        document.location.href = '?page=profile&pesan=password-lama-salah';
        </script>";
        $_SESSION['password-lama'] = $_POST['password-lama'];
        $_SESSION['password-baru'] = $_POST['password-baru'];
        $_SESSION['konfirmasi-password'] = $_POST['konfirmasi-password'];
        return false;
    }

    if ($passwordLama === $passwordBaru) {
        echo "<script>
        document.location.href = '?page=profile&pesan=password-sama';
        </script>";
        $_SESSION['password-lama'] = $_POST['password-lama'];
        $_SESSION['password-baru'] = $_POST['password-baru'];
        $_SESSION['konfirmasi-password'] = $_POST['konfirmasi-password'];
        return false;
    }

    if ($passwordBaru !== $konfirmasiPassword) {
        echo "<script>
        document.location.href = '?page=profile&pesan=konfirmasi-password-salah';
        </script>";
        $_SESSION['password-lama'] = $_POST['password-lama'];
        $_SESSION['password-baru'] = $_POST['password-baru'];
        $_SESSION['konfirmasi-password'] = $_POST['konfirmasi-password'];
        return false;
    }

    $passwordBaru = hash('sha256', mysqli_real_escape_string($koneksi, $passwordBaru));

    $query = "UPDATE pelanggan SET
            password = '$passwordBaru'
            WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========= upload
function uploadProfil()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','jfif'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang anda upload bukan gambar');
        </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/profil/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapusAkun($id)
{
    global $koneksi;

    // Mengambil data pelanggan berdasarkan ID
    $pelanggan = query("SELECT * FROM pelanggan WHERE id = $id");

    // Validasi jika data pelanggan ditemukan
    if (!empty($pelanggan)) {
        $pelanggan = $pelanggan[0]; // Ambil elemen pertama dari hasil query

        // Periksa apakah gambar bukan default, lalu hapus file gambar
        if ($pelanggan['gambar'] != 'default-laki-laki.jpg' && $pelanggan['gambar'] != 'default-perempuan.jpg') {
            if (file_exists('img/' . $pelanggan['gambar'])) {
                unlink('img/' . $pelanggan['gambar']);
            } else {
                echo "Gambar tidak ditemukan di folder.";
            }
        }

        // Hapus data terkait di tabel reviews
        mysqli_query($koneksi, "DELETE FROM reviews WHERE customer_id = $id") or die(mysqli_error($koneksi));

        // Hapus data terkait di tabel pemesanan
        mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pelanggan = $id") or die(mysqli_error($koneksi));

        // Hapus data pelanggan dari database
        mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id = $id") or die(mysqli_error($koneksi));
    } else {
        echo "Data pelanggan tidak ditemukan.";
        return 0; // Keluar dari fungsi
    }

    return mysqli_affected_rows($koneksi);
}


// ========================== Akhir FUNCTION Profil Pelanggan ======================================================================================================

// ========================== FUNCTION Pemesanan ======================================================================================================================
// ============ tambah
function tambahPesanan($data)
{
    global $koneksi;

    $idPelanggan = $data['id'];
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $hargaPermalam = htmlspecialchars($data['harga_per_malam']);
    $jumlahKamar = htmlspecialchars($data['jumlah-kamar']);
    $namaPemesan = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $noTelp = htmlspecialchars($data['telp']);
    $checkIn = htmlspecialchars($data['cekin']);
    $checkOut = htmlspecialchars($data['cekout']);
    $durasiMenginap = htmlspecialchars($data['durasi']);
    $totalBiaya = htmlspecialchars($data['total-biaya']);
    $batasBayar = date('Y-m-d 12:00', strtotime('1 day'));
    $bayar = date('Y-m-d H:i');
    $isDeleted = 0;

    // Ambil id kamar berdasarkan nomor kamar
    $nomorKamarList = [];
    for ($i = 1; $i <= $jumlahKamar; $i++) {
        if (!isset($data["nomor-kamar-$i"])) {
            die("Error: Nomor kamar ke-$i tidak ditemukan.");
        }
        $nomorKamarList[] = htmlspecialchars($data["nomor-kamar-$i"]);
    }
    $nomorKamarSql = implode("','", $nomorKamarList);

    // Query untuk mendapatkan ID kamar
    $result = mysqli_query($koneksi, "SELECT id FROM kamar WHERE no_kamar IN ('$nomorKamarSql')");
    if (!$result) {
        die("Query Error (SELECT id kamar): " . mysqli_error($koneksi));
    }

    // Gabungkan ID kamar menjadi string
    $idKamarList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $idKamarList[] = $row['id'];
    }

    // Cek apakah semua nomor kamar ditemukan
    if (count($idKamarList) !== count($nomorKamarList)) {
        die("Error: Tidak semua nomor kamar valid atau ditemukan.");
    }

    $idKamarStr = implode(',', $idKamarList); // Gabungkan ID kamar

    // Masukkan data pemesanan
    $query = "INSERT INTO `pemesanan` 
              (id_pelanggan, tgl_pemesanan, tgl_cek_in, tgl_cek_out, tipe_kamar, harga_permalam, jumlah_kamar, 
              id_kamar, nama_pemesan, alamat, telp, durasi_menginap, total_biaya, status, batas_pembayaran, is_deleted) 
              VALUES 
              ('$idPelanggan', '$bayar', '$checkIn', '$checkOut', '$tipeKamar', '$hargaPermalam', '$jumlahKamar', 
              '$idKamarStr', '$namaPemesan', '$alamat', '$noTelp', '$durasiMenginap', '$totalBiaya', 
              'belum dibayar', '$batasBayar', '$isDeleted')";
    if (!mysqli_query($koneksi, $query)) {
        die("Query Error (INSERT pemesanan): " . mysqli_error($koneksi));
    }

    // Perbarui status kamar
    $updateKamarQuery = "UPDATE kamar 
                         SET status = 'dipesan', tgl_pemesanan = '$bayar', tgl_check_out = '$checkOut' 
                         WHERE no_kamar IN ('$nomorKamarSql')";
    if (!mysqli_query($koneksi, $updateKamarQuery)) {
        die("Query Error (UPDATE kamar): " . mysqli_error($koneksi));
    }

    // Perbarui stok kamar
    $updateStokQuery = "UPDATE stok_kamar SET stok = stok-$jumlahKamar WHERE tipe = '$tipeKamar'";
    if (!mysqli_query($koneksi, $updateStokQuery)) {
        die("Query Error (UPDATE stok_kamar): " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}


function tambahPesananAdmin($data)
{
    global $koneksi;

    // Mengambil data dari $data dan memprosesnya
    $tipeKamar = htmlspecialchars($data['tipe_kamar']);
    $hargaPermalam = htmlspecialchars($data['harga_per_malam']);
    $jumlahKamar = htmlspecialchars($data['jumlah_kamar']);
    $namaPemesan = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $noTelp = htmlspecialchars($data['telp']);
    $checkIn = htmlspecialchars($data['cekin']);
    $checkOut = htmlspecialchars($data['cekout']);
    $durasiMenginap = htmlspecialchars($data['durasi']);
    $totalBiaya = htmlspecialchars($data['total_biaya']);
    $tglPemesanan = htmlspecialchars($data['tgl_pemesanan']);
    $status = htmlspecialchars($data['status']);

    // Membuat list nomor kamar
    $nomorKamarList = [];
    for ($i = 1; $i <= $jumlahKamar; $i++) {
        $nomorKamarList[] = htmlspecialchars($data["no_kamar"]);
    }
    $nomorKamarStr = implode("','", $nomorKamarList);

    // Perbarui status kamar dalam satu query
    $updateQuery = "UPDATE kamar 
                    SET status = 'dipesan', tgl_pemesanan = '$tglPemesanan', tgl_check_out = '$checkOut' 
                    WHERE no_kamar IN ('$nomorKamarStr')";
    if (!mysqli_query($koneksi, $updateQuery)) {
        die("Query Error (UPDATE kamar): " . mysqli_error($koneksi));
    }

    // Masukkan data pesanan
    foreach ($nomorKamarList as $nomorKamar) {
        $result = mysqli_query($koneksi, "SELECT id FROM kamar WHERE no_kamar = '$nomorKamar'");
        if (!$result) {
            die("Query Error (SELECT id): " . mysqli_error($koneksi));
        }
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            die("Error: Kamar dengan nomor '$nomorKamar' tidak ditemukan.");
        }
        $idKamar = $row['id'];

        // Query INSERT tanpa is_deleted
        $query = "INSERT INTO `pemesanan` 
                  (id_kamar, tgl_pemesanan, tgl_cek_in, tgl_cek_out, tipe_kamar, harga_permalam, 
                  jumlah_kamar, nama_pemesan, alamat, telp, durasi_menginap, total_biaya, status) 
                  VALUES 
                  ('$idKamar', '$tglPemesanan', '$checkIn', '$checkOut', '$tipeKamar', '$hargaPermalam', 1, 
                  '$namaPemesan', '$alamat', '$noTelp', '$durasiMenginap', '$totalBiaya', '$status')";
        if (!mysqli_query($koneksi, $query)) {
            die("Query Error (INSERT): " . mysqli_error($koneksi));
        }
    }

    // Perbarui stok kamar
    $stokUpdateQuery = "UPDATE stok_kamar SET stok = stok - $jumlahKamar WHERE tipe = '$tipeKamar'";
    if (!mysqli_query($koneksi, $stokUpdateQuery)) {
        die("Query Error (UPDATE stok_kamar): " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}



// ============ batal 
function batalkanPesanan($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $tipeKamar = htmlspecialchars($data['tipe_kamar']);
    $jumlahKamar = htmlspecialchars($data['jumlah_kamar']);
    $tglPemesanan = htmlspecialchars($data['tgl_pemesanan']);
    $data = query("SELECT * FROM kamar WHERE tgl_pemesanan = '$tglPemesanan'");

    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok+$jumlahKamar WHERE tipe = '$tipeKamar'");
    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'batal' WHERE id = '$id'");

    foreach ($data as $row) {
        $nomorKamar = $row['no_kamar'];
        mysqli_query($koneksi, "UPDATE kamar SET status = 'tersedia', tgl_pemesanan = NULL, tgl_check_out = NULL WHERE no_kamar = '$nomorKamar'");
    }
    return mysqli_affected_rows($koneksi);
}



// ============ checkout
function checkoutPesanan($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $jumlahKamar = htmlspecialchars($data['jumlah_kamar']);
    $tipeKamar = htmlspecialchars($data['tipe_kamar']);
    $tglPemesanan = htmlspecialchars($data['tgl_pemesanan']);
    $data = query("SELECT * FROM kamar WHERE tgl_pemesanan = '$tglPemesanan'");

    foreach ($data as $row) {
        $nomorKamar = $row['no_kamar'];
        mysqli_query($koneksi, "UPDATE kamar SET status = 'tersedia', tgl_pemesanan = NULL, tgl_check_out = NULL WHERE no_kamar = '$nomorKamar'");
    }

    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'check out' WHERE id = '$id'");
    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok+$jumlahKamar WHERE tipe = '$tipeKamar'");

    return mysqli_affected_rows($koneksi);
}

// ============ hapus
function hapusPesanan($id) {
    global $koneksi;

    // Validasi input ID
    $id = intval($id); // Konversi ke integer
    if ($id <= 0) {
        die("ID pesanan tidak valid."); // Hentikan jika ID tidak valid
    }

    // Query update flag is_deleted
    $query = "UPDATE pemesanan SET is_deleted = 1 WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    // Cek jika query gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi); // Mengembalikan jumlah baris yang terpengaruh
}

function hapusPesananAdmin($id) {
    global $koneksi;

    // Validasi input ID
    $id = intval($id); // Konversi ke integer
    if ($id <= 0) {
        die("ID pesanan tidak valid."); // Hentikan jika ID tidak valid
    }

    // Query delete
    $query = "DELETE FROM pemesanan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    // Cek jika query gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi); // Mengembalikan jumlah baris yang terpengaruh
}



// ========================== Akhir FUNCTION Pemesanan ==========================================================================================================


// ========================== FUNCTION Pembayaran ====================================================================================================================
// ============= tambah
function tambahPembayaran($data)
{
    global $koneksi;
    $namaPemesan = htmlspecialchars($data['nama-pembayar']);
    $bank = htmlspecialchars($data['bank']);
    $nomorRekening = htmlspecialchars($data['nomor-rekening']);
    $namaPemilikKartu = htmlspecialchars($data['nama-pemilik-kartu']);
    $jumlahBayar = htmlspecialchars($data['total-bayar']);
    // $bukti = htmlspecialchars($data['bukti']);
    $jumlah = htmlspecialchars($data['jumlah-kamar']);
    $id = htmlspecialchars($data['id']);

    // upload gambar
    $bukti = uploadBuktiTF();
    if (!$bukti) {
        return false;
    }

    $bayar = date('Y-m-d', strtotime('1 day'));

    $pembayaran = tanggal_indonesia(date('Y-m-d'));

    $query = "INSERT INTO pembayaran VALUES('', $id, '$pembayaran', '$namaPemesan', '$bank', '$nomorRekening', '$namaPemilikKartu', '$jumlahBayar','$bukti')";
    for ($i = 1; $i <= intval($jumlah); $i++) {
        $nomorKamar = htmlspecialchars($data["nomor-kamar-$i"]);
        mysqli_query($koneksi, "UPDATE kamar SET status = 'terisi' WHERE no_kamar = '$nomorKamar'");
    }

    mysqli_query($koneksi, $query);
    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'pending' WHERE id = '$id'");
    return mysqli_affected_rows($koneksi);
    header("Location: ./pesanan.php");
}

// ============= upload
function uploadBuktiTF()
{
    $namaFile = $_FILES['bukti']['name'];
    $ukuranFile = $_FILES['bukti']['size'];
    $error = $_FILES['bukti']['error'];
    $tmpName = $_FILES['bukti']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','jfif'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/bukti/' . $namaFileBaru);

    return $namaFileBaru;
}

// ============ hapus
function hapusPembayaran($id)
{
    $id = $_GET['id'];

    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id = $id") or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

// =========================== Akhir FUNCTION Pembayaran =================================================================================================================


// =========================== FUNCTION Data Hotel ===================================================================================================================
// ============== Tambah Kamar
function tambahKamar($data)
{
    global $koneksi;
    $idStokKamar = htmlspecialchars($data["id-stok-kamar"]);
    $jenisKamar = htmlspecialchars($data["tipe-kamar"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $nomorKamar = htmlspecialchars($data["no-kamar"]);
    $tarif = htmlspecialchars($data["tarif"]);

    $jumlahTambah = htmlspecialchars($data['jumlah']);
    mysqli_query($koneksi, "INSERT INTO kamar VALUES ('', '$idStokKamar', '$jenisKamar', '$gambar', '$nomorKamar', 'tersedia', null, null, '$tarif')");
    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok+$jumlahTambah WHERE tipe = '$jenisKamar'");
    mysqli_query($koneksi, "UPDATE stok_kamar SET jumlah_kamar = jumlah_kamar+$jumlahTambah WHERE tipe = '$jenisKamar'");
    return mysqli_affected_rows($koneksi);
}

// ============== Identitas Hotel
function ubahIdentitasHotel($data)
{
    global $koneksi;
    $namaHotel = htmlspecialchars($data['nama-hotel']);
    $nomorRekening = htmlspecialchars($data['rekening-hotel']);
    $telp = htmlspecialchars($data['telp-hotel']);
    $alamat = htmlspecialchars($data['alamat-hotel']);
    $email = htmlspecialchars($data['email-hotel']);
    $logoPrimaryLama = htmlspecialchars($data['logo-primary-lama']);
    $logoSecondaryLama = htmlspecialchars($data['logo-secondary-lama']);

    if ($_FILES['logo-primary']['error'] === 4) {
        $logoPrimary = $logoPrimaryLama;
    } else {
        $logoPrimary = uploadLogoPrimary();
    }

    if ($_FILES['logo-secondary']['error'] === 4) {
        $logoSecondary = $logoSecondaryLama;
    } else {
        $logoSecondary = uploadLogoSecondary();
    }

    mysqli_query($koneksi, "UPDATE identitas SET nama_hotel = '$namaHotel', no_rekening = '$nomorRekening', telp = '$telp', alamat = '$alamat', email = '$email', logo_primary = '$logoPrimary', logo_secondary = '$logoSecondary'");

    return mysqli_affected_rows($koneksi);
}

// ============== Sosial Media
function ubahSosialMedia($data)
{
    global $koneksi;
    $identitas = query("SELECT * FROM identitas")[0];

    $facebook = htmlspecialchars($data['facebook']);
    $instagram = htmlspecialchars($data['instagram']);
    $whatsapp = htmlspecialchars($data['whatsapp']);
    $twtter = htmlspecialchars($data['twitter']);
    $email = htmlspecialchars($data['email']);

    mysqli_query($koneksi, "UPDATE sosial_media SET facebook = '$facebook', instagram = '$instagram', whatsapp = '$whatsapp', twitter = '$twtter'");
    if ($email !== $identitas['email']) {
        mysqli_query($koneksi, "UPDATE identitas SET email = '$email'");
    }


    return mysqli_affected_rows($koneksi);
}

// ============== Upload Logo Primary
function uploadLogoPrimary()
{
    $namaFile = $_FILES['logo-primary']['name'];
    $ukuranFile = $_FILES['logo-primary']['size'];
    $error = $_FILES['logo-primary']['error'];
    $tmpName = $_FILES['logo-primary']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','jfif'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/logo/' . $namaFileBaru);

    return $namaFileBaru;
}

// ============== Upload Logo Secondary
function uploadLogoSecondary()
{
    $namaFile = $_FILES['logo-secondary']['name'];
    $ukuranFile = $_FILES['logo-secondary']['size'];
    $error = $_FILES['logo-secondary']['error'];
    $tmpName = $_FILES['logo-secondary']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/logo/' . $namaFileBaru);

    return $namaFileBaru;
}
// =========================== Akhir Function Data Hotel =======================================================================================================

// =========================== Function Data Fasilitas ================================================
// ========== Tambah Fasilitas
function tambahFasilitas($data)
{
    global $koneksi;

    $fasilitas = htmlspecialchars($data['fasilitas']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $gambar = uploadFasilitas();
    if (!$gambar) {
        return false;
    }

    if ($tipeKamar == "Standard") {
        $harga = "150000";
    } elseif ($tipeKamar == "deluxe") {
        $harga = "200000";
    }

    $query = "INSERT INTO fasilitas VALUES ('','$tipeKamar','$fasilitas','$gambar','$deskripsi','$harga')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========== Ubah Fasilitas
function ubahFasilitas($data)
{
    global $koneksi;

    $idFasilitas = htmlspecialchars($data['id-fasilitas']);
    $fasilitas = htmlspecialchars($data['fasilitas']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $gambarLama = htmlspecialchars($data['gambar-lama']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadFasilitas();
        unlink('../img/fasilitas/' . $gambarLama);
    }

    $query = "UPDATE fasilitas SET 
                tipe_kamar = '$tipeKamar', 
                fasilitas = '$fasilitas', 
                gambar = '$gambar', 
                deskripsi = '$deskripsi' 
                WHERE id = $idFasilitas";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========== Upload Gambar Fasilitas
function uploadFasilitas()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                document.location.href = './tambah-fasilitas.php?page=tambah-fasilitas&pesan=gagal-upload-fasilitas';
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png','jfif'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    document.location.href = './tambah-fasilitas.php?page=tambah-fasilitas&pesan=invalid-upload-fasilitas';',
                  </script>";

        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
                    document.location.href = './tambah-fasilitas.php?page=tambah-fasilitas&pesan=terlalu-besar-fasilitas';',
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/fasilitas/' . $namaFileBaru);

    return $namaFileBaru;
}

// ========== Hapus Fasilitas
function hapusFasilitas($id)
{
    global $koneksi;
    //menghapus gambar difolder
    $fasilitas = query("SELECT * FROM fasilitas WHERE id = $id")[0];
    unlink('../img/fasilitas/' . $fasilitas['gambar']);
    mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id = $id") or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

// =========================== Akhir Function Data Fasilitas ============================================

// ===========================  Function Ulasan Pelanggan ============================================

// Fungsi untuk menyimpan ulasan pelanggan ke database
function saveReview($koneksi, $nama, $email, $rating, $ulasan, $order_id) {
    $nama = htmlspecialchars(trim($nama));
    $email = htmlspecialchars(trim($email));
    $rating = intval($rating);
    $ulasan = htmlspecialchars(trim($ulasan));

    // Validasi input
    if (empty($nama) || empty($email) || empty($rating) || empty($ulasan)) {
        return "Semua field harus diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email tidak valid.";
    }

    if ($rating < 1 || $rating > 5) {
        return "Rating harus antara 1 hingga 5.";
    }

    // Query untuk menyimpan ulasan
    $query = "INSERT INTO reviews (order_id, customer_name, email, rating, review_text, created_at) 
              VALUES ('$order_id', '$nama', '$email', $rating, '$ulasan', NOW())";

    if (mysqli_query($koneksi, $query)) {
        return true;
    } else {
        return "Gagal menyimpan ulasan: " . mysqli_error($koneksi);
    }
}

// Fungsi untuk memeriksa apakah ulasan sudah ada untuk pesanan ini
function hasReviewForOrder($koneksi, $order_id) {
    $query = "SELECT COUNT(*) as count FROM reviews WHERE order_id = '$order_id'";
    $result = mysqli_query($koneksi, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['count'] > 0; // Kembalikan `true` jika ulasan sudah ada
    }
    return false; // Kembalikan `false` jika belum ada ulasan
}

// =========================== Akhir Function Ulasan Pelanggan ============================================
function updateStatusKamar($id, $statusBaru) {
    global $koneksi; // Pastikan variabel koneksi global digunakan

    // Ambil data kamar berdasarkan ID
    $kamar = query("SELECT id_stok_kamar, status FROM kamar WHERE id = $id")[0];

    // Ambil tipe kamar untuk stok_kamar
    $id_stok_kamar = $kamar['id_stok_kamar'];
    $statusLama = $kamar['status'];

    // Update status kamar
    $query = "UPDATE kamar SET status = '$statusBaru' WHERE id = $id";
    mysqli_query($koneksi, $query);

    // Update stok berdasarkan perubahan status
    if ($statusLama !== 'tersedia' && $statusBaru === 'tersedia') {
        // Jika kamar berubah menjadi tersedia, tambahkan stok
        $stokQuery = "UPDATE stok_kamar SET stok = stok + 1 WHERE id_stok_kamar = $id_stok_kamar";
    } elseif ($statusLama === 'tersedia' && ($statusBaru === 'dipesan' || $statusBaru === 'terisi')) {
        // Jika kamar berubah dari tersedia ke dipesan atau terisi, kurangi stok
        $stokQuery = "UPDATE stok_kamar SET stok = stok - 1 WHERE id_stok_kamar = $id_stok_kamar";
    } else {
        // Tidak ada perubahan stok jika status tetap atau berubah antara "dipesan" dan "terisi"
        $stokQuery = null;
    }

    // Eksekusi query stok jika ada
    if ($stokQuery !== null) {
        mysqli_query($koneksi, $stokQuery);
    }

    // Kembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($koneksi);
}

