<?php include '../../config/koneksi.php';

$id_produk = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';
if ($id_produk == '') {
    header("Location: list.php");
    exit;
}

$query_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
$data_produk  = mysqli_fetch_assoc($query_produk);

if (!$data_produk) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='list.php';</script>";
    exit;
}

$query_rasa_lama = mysqli_query($koneksi, "SELECT id_rasa FROM produk_rasa WHERE id_produk = '$id_produk'");
$rasa_lama_array = [];
while ($rl = mysqli_fetch_assoc($query_rasa_lama)) {
    $rasa_lama_array[] = $rl['id_rasa']; 
}

$qKategori   = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
$qUmkm       = mysqli_query($koneksi, "SELECT * FROM umkm ORDER BY nama_umkm ASC");
$qAsalDaerah = mysqli_query($koneksi, "SELECT * FROM asal_daerah ORDER BY nama_asal_daerah ASC");
$qRasa       = mysqli_query($koneksi, "SELECT * FROM rasa ORDER BY nama_rasa ASC");

if (isset($_POST['update'])) {
    $nama_produk    = mysqli_real_escape_string($koneksi, trim($_POST['nama_produk']));
    $harga_produk   = mysqli_real_escape_string($koneksi, trim($_POST['harga_produk']));
    $id_kategori    = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
    $id_umkm        = mysqli_real_escape_string($koneksi, $_POST['id_umkm']);
    $id_asal_daerah = mysqli_real_escape_string($koneksi, $_POST['id_asal_daerah']);
    $id_rasa_array  = isset($_POST['id_rasa']) ? $_POST['id_rasa'] : [];

    $update_produk = mysqli_query($koneksi, "UPDATE produk SET 
                        nama_produk    = '$nama_produk', 
                        harga_produk   = '$harga_produk', 
                        id_kategori    = '$id_kategori', 
                        id_umkm        = '$id_umkm', 
                        id_asal_daerah = '$id_asal_daerah' 
                    WHERE id_produk  = '$id_produk'");

    if ($update_produk) {
        mysqli_query($koneksi, "DELETE FROM produk_rasa WHERE id_produk = '$id_produk'");
        foreach ($id_rasa_array as $id_rasa) {
            $id_rasa = mysqli_real_escape_string($koneksi, $id_rasa);
            mysqli_query($koneksi, "INSERT INTO produk_rasa (id_produk, id_rasa) VALUES ('$id_produk', '$id_rasa')");
        }
        echo "<script>
                alert('Produk Berhasil Diperbarui!');
                window.location='list.php';
            </script>";
    } else {
        echo "Gagal memperbarui produk: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>EDIT PRODUK - ADMIN</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo UMKM">
            <h1>UMKM GASIBU</h1>
        </div>
    </header>
    
    <!-- SIDE PANEL -->
    <div class="container">
        <aside>
            <nav>
                <ul>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="list.php">DATA UMKM</a></li>
                    <li><a href="list.php">DATA PRODUK</a></li> 
                    <li><a href="cari_umkm.php">MITRA</a></li>
                    <li><a href="cari_umkm.php">METODE PEMBAYARAN</a></li>
                    <li><a href="cari_umkm.php">SERTIFIKAT HALAL</a></li>
                    <li><a href="cari_umkm.php">RASA</a></li>
                    <li><a href="cari_umkm.php">KATEGORI</a></li>
                    <li><a href="cari_umkm.php">ASAL DAERAH</a></li>
                </ul>
            </nav>
        </aside>
        
        <main>
            <h2 class="form-title">
    EDIT PRODUK
</h2>

<div class="form-card">
            <form action="" method="POST">
                <table border="0" cellpadding="8">
                    <tr>
                        <td>Nama Produk:</td>
                        <td><input type="text" name="nama_produk" value="<?= $data_produk['nama_produk']; ?>" required size="30" placeholder="Masukkan Nama Produk"></td>
                    </tr>
                    <tr>
                        <td>Harga (Rupiah):</td>
                        <td><input type="number" name="harga_produk" value="<?= $data_produk['harga_produk']; ?>" required min="0" placeholder="Contoh: 15000"></td>
                    </tr>
                    <tr>
                        <td>Kategori:</td>
                        <td>
                            <select name="id_kategori" required style="min-width: 175px;">
                                <option value="">-- Pilih Kategori --</option>
                                <?php while($kategori = mysqli_fetch_assoc($qKategori)) { 
                                    // Beri atribut selected jika id cocok dengan data lama
                                    $selected = ($kategori['id_kategori'] == $data_produk['id_kategori']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $kategori['id_kategori']; ?>" <?= $selected; ?>><?= $kategori['nama_kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>UMKM:</td>
                        <td>
                            <select name="id_umkm" required style="min-width: 175px;">
                                <option value="">-- Pilih Nama UMKM--</option>
                                <?php while($umkm = mysqli_fetch_assoc($qUmkm)) { 
                                    $selected = ($umkm['id_umkm'] == $data_produk['id_umkm']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $umkm['id_umkm']; ?>" <?= $selected; ?>><?= $umkm['nama_umkm']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Asal Daerah:</td>
                        <td>
                            <select name="id_asal_daerah" required style="min-width: 175px;">
                                <option value="">-- Pilih Asal Daerah --</option>
                                <?php while($asal = mysqli_fetch_assoc($qAsalDaerah)) { 
                                    $selected = ($asal['id_asal_daerah'] == $data_produk['id_asal_daerah']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $asal['id_asal_daerah']; ?>" <?= $selected; ?>><?= $asal['nama_asal_daerah']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Varian Rasa:</td>
                        <td>
                            <?php while($rasa = mysqli_fetch_assoc($qRasa)) { 
                                $checked = in_array($rasa['id_rasa'], $rasa_lama_array) ? 'checked' : '';
                            ?>
                            <label style="display: block; margin-bottom: 5px; cursor: pointer;">
                                <input type="checkbox" name="id_rasa[]" value="<?= $rasa['id_rasa']; ?>" <?= $checked; ?>>
                                    <?= $rasa['nama_rasa']; ?>
                                </label>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="update" class="btn-simpan">SIMPAN PERUBAHAN</button>
                            <button type="button" class="btn-reset" onclick="window.location='list.php'">BATAL</button>
                        </td>
                    </tr>
                </table>
            </form>
            </div>
            <div class="tombol-kembali">
                <a href="list.php">
                    ← Kembali
                </a>
            </div>
        </main>
    </div>
</body>
</html>