<?php include '../../config/koneksi.php';

$qJalan = mysqli_query($koneksi, "SELECT * FROM jalan");
$qHalal = mysqli_query($koneksi, "SELECT * FROM sertifikasi_halal");

if (isset($_POST['simpan'])) {
    $nama_umkm            = $_POST['nama_umkm'];
    $id_jalan             = $_POST['id_jalan'];
    $jam_buka             = $_POST['jam_buka'];
    $jam_tutup            = $_POST['jam_tutup'];
    $id_sertifikasi_halal = $_POST['id_sertifikasi_halal'];
    
    $query = "INSERT INTO umkm (nama_umkm, id_jalan, jam_buka, jam_tutup, id_sertifikasi_halal) 
            VALUES ('$nama_umkm', '$id_jalan', '$jam_buka', '$jam_tutup', '$id_sertifikasi_halal')";
    $insert = mysqli_query($koneksi, $query);
    
    if ($insert) {
        echo "<script>
                alert('Data UMKM Berhasil Ditambahkan!');
                window.location='crud_umkm.php';
            </script>";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
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
                    <li><a href="../produk/crud_produk.php">DATA PRODUK</a></li> 
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
            <h2>TAMBAH UMKM</h2>
            <form action="" method="POST">
                <table border="0" cellpadding="8">
                    <tr>
                        <td>Nama UMKM:</td>
                        <td><input type="text" name="nama_umkm" placeholder="Masukkan Nama UMKM" required size="30"></td>
                    </tr>
                    <tr>
                        <td>Lokasi Jalan:</td>
                        <td>
                            <select name="id_jalan" required>
                                <option value="">-- Pilih Jalan --</option>
                                <?php while($jalan = mysqli_fetch_assoc($qJalan)) { ?>
                                    <option value="<?= $jalan['id_jalan']; ?>"><?= $jalan['nama_jalan']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam Buka:</td>
                        <td><input type="time" name="jam_buka" required></td>
                    </tr>
                    <tr>
                        <td>Jam Tutup:</td>
                        <td><input type="time" name="jam_tutup" required></td>
                    </tr>
                    <tr>
                        <td>Sertifikat Halal:</td>
                        <td>
                            <select name="id_sertifikasi_halal" required>
                                <option value="">-- Pilih Status Halal --</option>
                                <?php while($halal = mysqli_fetch_assoc($qHalal)) { ?>
                                    <option value="<?= $halal['id_sertifikasi_halal']; ?>"><?= $halal['status_sertifikasi']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="simpan">SIMPAN DATA</button>
                            <button type="reset">RESET</button>
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