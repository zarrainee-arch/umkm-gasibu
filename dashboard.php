<?php
include 'config/koneksi.php';

$total_umkm = mysqli_fetch_assoc(
    mysqli_query($koneksi,
    "SELECT COUNT(*) AS total FROM umkm")
);

$total_mitra = mysqli_fetch_assoc(
    mysqli_query($koneksi,
    "SELECT COUNT(*) AS total FROM mitra")
);

$total_halal = mysqli_fetch_assoc(
    mysqli_query($koneksi,
    "SELECT COUNT(*) AS total
     FROM sertifikasi_halal")
);

$total_jalan = mysqli_fetch_assoc(
    mysqli_query($koneksi,
    "SELECT COUNT(*) AS total
     FROM jalan")
);

// Distribusi Mitra
$qMitra = mysqli_query($koneksi,"
SELECT m.nama_mitra,
       COUNT(um.id_umkm) AS jumlah
FROM mitra m
JOIN umkm_mitra um
ON m.id_mitra = um.id_mitra
GROUP BY m.id_mitra
");

// Sertifikasi Halal
$qHalal = mysqli_query($koneksi,"
SELECT sh.status_sertifikasi,
       COUNT(u.id_umkm) AS jumlah
FROM sertifikasi_halal sh
LEFT JOIN umkm u
ON sh.id_sertifikasi_halal = u.id_sertifikasi_halal
GROUP BY sh.id_sertifikasi_halal
");

// Metode Pembayaran
$qPembayaran = mysqli_query($koneksi,"
SELECT mp.nama_metode,
       COUNT(ump.id_umkm) AS jumlah
FROM metode_pembayaran mp
JOIN umkm_metode_pembayaran ump
ON mp.id_metode_pembayaran = ump.id_metode_pembayaran
GROUP BY mp.id_metode_pembayaran
");

// UMKM per Jalan
$qJalan = mysqli_query($koneksi,"
SELECT j.nama_jalan,
       COUNT(u.id_umkm) AS jumlah
FROM jalan j
JOIN umkm u
ON j.id_jalan = u.id_jalan
GROUP BY j.id_jalan
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-admin">

    <aside class="sidebar">

        <div class="logo-sidebar">
            <img src="assets/logo.png">
            <h2>UMKM GASIBU</h2>
        </div>

        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="query.php">QUERY WAJIB</a></li>
            <li><a href="cari_umkm.php">CARI UMKM</a></li>
            <li><a href="pages/umkm/list.php">
        DATA UMKM
    </a></li>

    <li><a href="pages/produk/list.php">
        DATA PRODUK
    </a></li>

    <li><a href="pages/mitra/list.php">
        DATA MITRA
    </a></li>

    <li><a href="pages/pembayaran/list.php">
        METODE PEMBAYARAN
    </a></li>

    <li><a href="pages/sertifikasi_halal/list.php">
        SERTIFIKASI HALAL
    </a></li>

    <li><a href="pages/rasa/list.php">
        RASA
    </a></li>

    <li><a href="pages/kategori/list.php">
        KATEGORI
    </a></li>

    <li><a href="pages/asal_daerah/list.php">
        ASAL DAERAH
    </a></li>
    <li><a href="dokumentasi.php">DOKUMENTASI</a></li>
</ul>
        </ul>

    </aside>

    <main class="content">

        <h1>DASHBOARD ADMIN</h1>

        <div class="dashboard-cards">
            <div class="dashboard-grid">

    <div class="dashboard-box">
        <h3>Distribusi Mitra</h3>

        <?php while($row = mysqli_fetch_assoc($qMitra)){ ?>
            <p>
                <?= $row['nama_mitra']; ?>
                (<?= $row['jumlah']; ?>)
            </p>
        <?php } ?>

    </div>

    <div class="dashboard-box">
        <h3>Sertifikasi Halal</h3>

        <?php while($row = mysqli_fetch_assoc($qHalal)){ ?>
            <p>
                <?= $row['status_sertifikasi']; ?>
                (<?= $row['jumlah']; ?>)
            </p>
        <?php } ?>

    </div>

    <div class="dashboard-box">
        <h3>Metode Pembayaran</h3>

        <?php while($row = mysqli_fetch_assoc($qPembayaran)){ ?>
            <p>
                <?= $row['nama_metode']; ?>
                (<?= $row['jumlah']; ?>)
            </p>
        <?php } ?>

    </div>

    <div class="dashboard-box">
        <h3>Jumlah UMKM per Jalan</h3>

        <?php while($row = mysqli_fetch_assoc($qJalan)){ ?>
            <p>
                <?= $row['nama_jalan']; ?>
                (<?= $row['jumlah']; ?>)
            </p>
        <?php } ?>

    </div>

</div>

            <div class="dashboard-card">
                <h3>Total UMKM</h3>
                <p><?= $total_umkm['total']; ?></p>
            </div>

            <div class="dashboard-card">
                <h3>Total Mitra</h3>
                <p><?= $total_mitra['total']; ?></p>
            </div>

            <div class="dashboard-card">
                <h3>Sertifikasi Halal</h3>
                <p><?= $total_halal['total']; ?></p>
            </div>

            <div class="dashboard-card">
                <h3>Lokasi Jalan</h3>
                <p><?= $total_jalan['total']; ?></p>
            </div>

        </div>

    </main>

</div>

</body>
</html>