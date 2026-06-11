<?php
include '../../config/koneksi.php';

$id_produk = isset($_GET['id_produk']) ? (int)$_GET['id_produk'] : 0;

$query = "SELECT
            p.id_produk,
            p.nama_produk,
            p.harga_produk,
            p.bahan_utama,
            k.nama_kategori,
            a.nama_asal_daerah,
            u.nama_umkm,
            GROUP_CONCAT(r.nama_rasa SEPARATOR ', ') AS rasa
        FROM produk p
        JOIN kategori k ON p.id_kategori = k.id_kategori
        JOIN asal_daerah a ON p.id_asal_daerah = a.id_asal_daerah
        JOIN umkm u ON p.id_umkm = u.id_umkm
        LEFT JOIN produk_rasa pr ON p.id_produk = pr.id_produk
        LEFT JOIN rasa r ON pr.id_rasa = r.id_rasa
        WHERE p.id_produk = $id_produk
        GROUP BY p.id_produk";

$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='list.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Detail Produk</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo UMKM">
            <h1>UMKM GASIBU </h1>
        </div>
    </header>
    
    <!-- SIDE PANEL -->
    <div class="container">
        <aside>
            <nav>
                <ul>
                    <li><a href = "../../index.php">HOME</a></li>
                    <li><a href = "../umkm/list.php">DAFTAR UMKM</a></li>
                    <li><a href = "../umkm/detail.php">DETAIL UMKM</a></li>
                    <li><a href="list.php">DAFTAR PRODUK</a></li>
                    <li><a href = "../../cari_umkm.php">CARI UMKM BUKA</a></li>
                </ul>
            </nav>
        </aside>
        
        <main>
            <h2>DETAIL PRODUK</h2>
            <section class="detail-produk">
                <div class="card-detail">
                    <p>
                        <strong>Nama Produk:</strong>
                        <?= $row['nama_produk']; ?>
                    </p>
                    <p>
                        <strong>Harga:</strong>
                        Rp <?= number_format($row['harga_produk'], 0, ',', '.'); ?>
                    </p>
                    <p>
                        <strong>Kategori:</strong>
                        <?= $row['nama_kategori']; ?>
                    </p>
                    <p>
                        <strong>Bahan Utama:</strong>
                        <?= $row['bahan_utama']; ?>
                    </p>
                    <p>
                        <strong>Asal daerah:</strong>
                        <?= $row['nama_asal_daerah']; ?>
                    </p>
                    <p>
                        <strong>Rasa:</strong>
                        <?= $row['rasa'] ? $row['rasa'] : '-'; ?>
                    </p>
                    <p>
                        <strong>UMKM:</strong>
                        <?= $row['nama_umkm']; ?>
                    </p>
                </div>
            </section>
            
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
            <p>Jl. Diponegoro, Bandung</p>
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

