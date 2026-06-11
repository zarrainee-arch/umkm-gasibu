<?php include '../../config/koneksi.php';

$cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : "";
$jalan = isset($_GET['jalan']) ? (int)$_GET['jalan'] : "";

$query = "SELECT
            u.id_umkm,
            u.nama_umkm,
            j.nama_jalan,
            u.jam_buka,
            u.jam_tutup,
            sh.status_sertifikasi
        FROM umkm u
        JOIN jalan j ON u.id_jalan = j.id_jalan
        JOIN sertifikasi_halal sh ON u.id_sertifikasi_halal = sh.id_sertifikasi_halal
        WHERE u.nama_umkm LIKE '%$cari%'";

if($jalan > 0){
    $query .= " AND u.id_jalan = '$jalan'";
}
$query .= " ORDER BY u.id_umkm ASC";
$result = mysqli_query($koneksi, $query);
$queryJalan = mysqli_query($koneksi, "SELECT * FROM jalan ORDER BY nama_jalan ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar UMKM Gasibu</title>
     <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../assets/logo.png" alt="Logo UMKM">
            <h1>UMKM GASIBU</h1>
        </div>
    </header>
    
    <!-- SIDE PANEL -->
    <div class="container">
        <aside>
            <nav>
                <ul>
                    <li><a href="../../index.php">HOME</a></li>
                    <li><a href="list.php">DAFTAR UMKM</a></li>
                    <li><a href="../produk/list.php">DAFTAR PRODUK</a></li> 
                    <li><a href="cari_umkm.php">CARI UMKM BUKA</a></li>
                </ul>
        </aside>
        
        <main>
            <h2>DAFTAR UMKM</h2>
            <a href="tambah.php" class="btn-tambah">
    TAMBAH UMKM
</a>
            <form method="GET" class="filter-container">
                <div class="search-box">
                    <input 
                        type="text"
                        name="cari"
                        placeholder="Cari Nama UMKM"
                        value="<?= $cari; ?>">
                </div>
                
                <div class="jalan-box">
                    <select name="jalan" onchange="this.form.submit()">
                        <option value="">
                            Filter: Jalan
                        </option>
                        <?php while($j = mysqli_fetch_assoc($queryJalan)){ ?>
                            <option value="<?= $j['id_jalan']; ?>" <?= $jalan == $j['id_jalan'] ? 'selected' : ''; ?>> 
                                <?= $j['nama_jalan']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button
                type="submit"
                class="btn-tambah">
                Cari
                </button>
            </form>
            
            <!--Tabel daftar produk -->
            <table class="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama UMKM</th>
                        <th>Jalan</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Sertifikat Halal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_umkm']; ?></td>
                            <td><?= $row['nama_jalan']; ?></td>
                            <td><?= $row['jam_buka']; ?></td>
                            <td><?= $row['jam_tutup']; ?></td>
                            <td><?= $row['status_sertifikasi']; ?></td>
                            <td>
                                <a
href="detail.php?id_umkm=<?= $row['id_umkm']; ?>"
class="btn-edit">
Detail
</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
        </main>
    </div>
    
    <footer>
        <div class="footer-kiri">
            <p>&copy;2026 UMKM Gasibu</p>
            <p>Jl. Diponegoro,Bandung</p>
        </div>
        
        <div class="footer-kanan">
            <h3>UMKM Gasibu</h3>
            <p>
                Dukung Lokal,
                Kuatkan Ekonomi
            </p>
        </div>
    </footer>
</body>
</html>