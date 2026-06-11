<?php include '../../config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: crud_umkm.php");
    exit;
}

$id_umkm = $_GET['id'];
$query_lama = "SELECT * FROM umkm WHERE id_umkm = '$id_umkm'";
$result_lama = mysqli_query($koneksi, $query_lama);
$data_lama = mysqli_fetch_assoc($result_lama);

if (mysqli_num_rows($result_lama) < 1) {
    die("Data tidak ditemukan.");
}

$qJalan = mysqli_query($koneksi, "SELECT * FROM jalan");
$qHalal = mysqli_query($koneksi, "SELECT * FROM sertifikasi_halal");

if (isset($_POST['update'])) {
    $nama_umkm            = $_POST['nama_umkm'];
    $id_jalan             = $_POST['id_jalan'];
    $jam_buka             = $_POST['jam_buka'];
    $jam_tutup            = $_POST['jam_tutup'];
    $id_sertifikasi_halal = $_POST['id_sertifikasi_halal'];
    
    $query_update = "UPDATE umkm SET 
                        nama_umkm = '$nama_umkm', 
                        id_jalan = '$id_jalan', 
                        jam_buka = '$jam_buka', 
                        jam_tutup = '$jam_tutup', 
                        id_sertifikasi_halal = '$id_sertifikasi_halal' 
                    WHERE id_umkm = '$id_umkm'";
    $update = mysqli_query($koneksi, $query_update);
    
    if ($update) {
        echo "<script>
                alert('Data UMKM Berhasil Diperbarui!');
                window.location='crud_umkm.php';
            </script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH UMKM - ADMIN</title>
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
                    <li><a href="crud_umkm.php">DATA UMKM</a></li>
                    <li><a href="crud_produk.php">DATA PRODUK</a></li> 
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
            <h2>EDIT UMKM</h2>
            <form action="" method="POST">
                <table border="0" cellpadding="8">
                    <tr>
                        <td>Nama UMKM:</td><>
                        <td>
                            <input type="text" name="nama_umkm" value="<?= $data_lama['nama_umkm']; ?>" required size="30">
                        </td>
                    </tr>
                    <tr>
                        <td>Lokasi Jalan:</td>
                        <td>
                            <select name="id_jalan" required>
                                <?php while($jalan = mysqli_fetch_assoc($qJalan)) { ?>
                                    <option value="<?= $jalan['id_jalan']; ?>" <?= ($jalan['id_jalan'] == $data_lama['id_jalan']) ? 'selected' : ''; ?>>
                                        <?= $jalan['nama_jalan']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam Buka:</td>
                        <td>
                            <input type="time" name="jam_buka" value="<?= $data_lama['jam_buka']; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam Tutup:</td>
                        <td>
                            <input type="time" name="jam_tutup" value="<?= $data_lama['jam_tutup']; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Sertifikat Halal:</td>
                        <td>
                            <select name="id_sertifikasi_halal" required>
                                <?php while($halal = mysqli_fetch_assoc($qHalal)) { ?>
                                    <option value="<?= $halal['id_sertifikasi_halal']; ?>" <?= ($halal['id_sertifikasi_halal'] == $data_lama['id_sertifikasi_halal']) ? 'selected' : ''; ?>>
                                        <?= $halal['status_sertifikasi']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="update">SIMPAN PERUBAHAN</button>
                            <button type="button" onclick="window.location='crud_umkm.php'">BATAL</button>
                        </td>
                    </tr>
                </table>
            </form>

            <div class="tombol-kembali">
                <a href="crud_umkm.php">
                    ← Kembali
                </a>
            </div>
        </main>
    </div>
</body>
</html>