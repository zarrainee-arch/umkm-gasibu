<?php include '../../config/koneksi.php';

$id_umkm = isset($_GET['id_umkm']) ? (int)$_GET['id_umkm'] : 0;
$queryUmkm = mysqli_query($koneksi,"
        SELECT
            u.id_umkm,
            u.nama_umkm,
            j.nama_jalan,
            u.jam_buka,
            u.jam_tutup
        FROM umkm u
        JOIN jalan j ON u.id_jalan = j.id_jalan
        WHERE u.id_umkm = '$id_umkm'
        ");
$dataUmkm = mysqli_fetch_assoc($queryUmkm);

$queryMitra = mysqli_query($koneksi,"
        SELECT m.nama_mitra
        FROM umkm_mitra um
        JOIN mitra m ON um.id_mitra = m.id_mitra
        WHERE um.id_umkm = '$id_umkm'
        ");
$mitra = [];
while($m = mysqli_fetch_assoc($queryMitra)){
    $mitra[] = $m['nama_mitra'];
}

$queryMetode = mysqli_query($koneksi,"
        SELECT mp.nama_metode
        FROM umkm_metode_pembayaran ump
        JOIN metode_pembayaran mp ON ump.id_metode_pembayaran = mp.id_metode_pembayaran
        WHERE ump.id_umkm = '$id_umkm'
        ");
$metode = [];
while($p = mysqli_fetch_assoc($queryMetode)){
    $metode[] = $p['nama_metode'];
}

$queryProduk = mysqli_query($koneksi,"
        SELECT
            p.id_produk,
            p.nama_produk,
            p.harga_produk,
            k.nama_kategori,
            GROUP_CONCAT(r.nama_rasa SEPARATOR ', ') AS rasa
        FROM produk p
        JOIN kategori k ON p.id_kategori = k.id_kategori
        LEFT JOIN produk_rasa pr ON p.id_produk = pr.id_produk
        LEFT JOIN rasa r ON pr.id_rasa = r.id_rasa
        WHERE p.id_umkm = '$id_umkm'
        GROUP BY p.id_produk
        ORDER BY p.id_produk ASC
        ");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail UMKM</title>
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
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="list.php">DAFTAR UMKM</a></li>
                    <li><a href="pages/produk/list.php">DAFTAR PRODUK</a></li> 
                    <li><a href="cari_umkm.php">CARI UMKM BUKA</a></li>
                </ul>
            </nav>
        </aside>
        
        <main>
            <h2>DETAIL UMKM</h2>
            <section class="detail-umkm">
                <p>
                    <strong>Nama UMKM:</strong>
                    <?= $dataUmkm['nama_umkm']; ?>
                </p>
                <p>
                    <strong>Jalan:</strong>
                    <?= $dataUmkm['nama_jalan']; ?>
                </p>
                <p>
                    <strong>Jam Buka:</strong>
                    <?= $dataUmkm['jam_buka']; ?>
                    -
                    <?= $dataUmkm['jam_tutup']; ?>
                </p>
                <p>
                    <strong>Mitra:</strong>
                    <?= !empty($mitra) ? implode(', ', $mitra) : '-'; ?>
                </p>
                <p>
                    <strong>Metode Pembayaran :</strong>
                    <?= !empty($metode) ? implode(', ', $metode) : '-'; ?>
                </p>
            </section>
            
            <!--Tabel daftar produk -->
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Rasa</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $no = 1;
                    while($row = mysqli_fetch_assoc($queryProduk)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td> Rp <?= number_format($row['harga_produk'],0,',','.'); ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
                            <td><?= $row['rasa'] ? $row['rasa'] : '-'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <div class="tombol-kembali">
                <a href="list.php">
                    ← Kembali
                </a>
            </div>
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