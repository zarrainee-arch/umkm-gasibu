<?php
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Query Wajib</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-admin">

    <aside class="sidebar">
        <div class="logo-sidebar">
            <img src="assets/logo.png" alt="">
            <h2>UMKM GASIBU</h2>
        </div>

        <ul>
            <li><a href="dashboard.php">DASHBOARD</a></li>
            <li><a href="query.php">QUERY WAJIB</a></li>
            <li><a href="cari_umkm.php">CARI UMKM</a></li>
        </ul>
    </aside>

    <main class="content">

        <h1>QUERY WAJIB</h1>

<div class="query-card">

    <h3>1. UMKM Berdasarkan Jam Buka</h3>

    <form method="GET">

        <input type="time" name="jam">

        <button type="submit">
            Cari
        </button>

    </form>

    <div class="hasil-query">

        <?php

        if(isset($_GET['jam'])){

            $jam = $_GET['jam'];

            $result = mysqli_query(
                $koneksi,
                "CALL cari_umkm_buka('$jam')"
            );

            while($row = mysqli_fetch_assoc($result)){
                echo $row['nama_umkm'] . "<br>";
            }

            mysqli_free_result($result);

            while(mysqli_more_results($koneksi)){
                mysqli_next_result($koneksi);
            }
        }

        ?>

    </div>

</div>

<div class="query-card">

    <h3>2. Produk Dengan Rentang Harga Tertentu</h3>

    <form method="GET">

        <input
            type="number"
            name="min"
            placeholder="Harga Minimum"
            required>

        <input
            type="number"
            name="max"
            placeholder="Harga Maksimum"
            required>

        <button type="submit">
            Cari
        </button>

    </form>

    <div class="hasil-query">

    <?php

    if(isset($_GET['min']) && isset($_GET['max'])){

        $min = (int)$_GET['min'];
        $max = (int)$_GET['max'];

        $result = mysqli_query(
            $koneksi,
            "CALL cari_produk_harga($min, $max)"
        );

        while($row = mysqli_fetch_assoc($result)){

            echo $row['nama_produk']
                ." | Rp "
                .number_format($row['harga_produk'],0,',','.')
                ." | "
                .$row['nama_umkm']
                ."<br>";
        }

        mysqli_free_result($result);

        while(mysqli_more_results($koneksi)){
            mysqli_next_result($koneksi);
        }
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>3. Mitra Dengan UMKM Terbanyak</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT m.nama_mitra,
           COUNT(um.id_umkm) AS jumlah_umkm
    FROM mitra m
    JOIN umkm_mitra um
    ON m.id_mitra = um.id_mitra
    GROUP BY m.id_mitra, m.nama_mitra
    ORDER BY jumlah_umkm DESC
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['nama_mitra'] .
             " (" .
             $row['jumlah_umkm'] .
             ")<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>4. Metode Pembayaran</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT mp.nama_metode,
           COUNT(ump.id_umkm) AS jumlah_umkm
    FROM metode_pembayaran mp
    JOIN umkm_metode_pembayaran ump
    ON mp.id_metode_pembayaran = ump.id_metode_pembayaran
    GROUP BY mp.id_metode_pembayaran, mp.nama_metode
    ORDER BY jumlah_umkm DESC
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['nama_metode']." (".$row['jumlah_umkm'].")<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>5. Status Sertifikasi Halal</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT
        sh.status_sertifikasi,
        COUNT(u.id_sertifikasi_halal) AS jumlah_umkm
    FROM sertifikasi_halal sh
    LEFT JOIN umkm u
        ON u.id_sertifikasi_halal = sh.id_sertifikasi_halal
    GROUP BY sh.status_sertifikasi
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['status_sertifikasi']." (".$row['jumlah_umkm'].")<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>6. Kategori Rasa</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT
        r.nama_rasa,
        COUNT(DISTINCT u.id_umkm) AS jumlah_umkm
    FROM umkm u
    JOIN produk p ON u.id_umkm = p.id_umkm
    JOIN produk_rasa pr ON p.id_produk = pr.id_produk
    JOIN rasa r ON pr.id_rasa = r.id_rasa
    GROUP BY r.nama_rasa
    ORDER BY COUNT(DISTINCT u.id_umkm) DESC
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['nama_rasa']." (".$row['jumlah_umkm'].")<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>7. Asal Daerah</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT
        ad.nama_asal_daerah,
        COUNT(p.id_asal_daerah) AS produk_per_daerah
    FROM asal_daerah ad
    JOIN produk p
        ON p.id_asal_daerah = ad.id_asal_daerah
    GROUP BY ad.nama_asal_daerah
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['nama_asal_daerah']." (".$row['produk_per_daerah'].")<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>8. Bahan Baku</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT
        p.bahan_utama,
        COUNT(DISTINCT u.id_umkm) AS jumlah_umkm
    FROM umkm u
    JOIN produk p ON u.id_umkm = p.id_umkm
    GROUP BY p.bahan_utama
    ORDER BY COUNT(DISTINCT u.id_umkm) DESC
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['bahan_utama']." (".$row['jumlah_umkm'].")<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>9. Durasi Berjualan</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT
        u.nama_umkm,
        CASE
            WHEN u.jam_tutup > u.jam_buka
            THEN TIMEDIFF(u.jam_tutup, u.jam_buka)

            ELSE TIMEDIFF(
                ADDTIME(u.jam_tutup, '24:00:00'),
                u.jam_buka
            )
        END AS durasi
    FROM umkm u
    ORDER BY durasi DESC
    ");

    while($row = mysqli_fetch_assoc($query)){
        echo $row['nama_umkm']." - ".$row['durasi']."<br>";
    }

    ?>

    </div>

</div>

<div class="query-card">

    <h3>10. Persentase Sertifikasi Halal Tiap Jalan</h3>

    <div class="hasil-query">

    <?php

    $query = mysqli_query($koneksi,"
    SELECT
        j.nama_jalan AS nama_jalan,
        COUNT(u.id_umkm) AS total_umkm,

        SUM(
            CASE
                WHEN sh.status_sertifikasi LIKE '%Sudah%'
                THEN 1
                ELSE 0
            END
        ) AS sudah_halal,

        SUM(
            CASE
                WHEN sh.status_sertifikasi LIKE '%Belum%'
                THEN 1
                ELSE 0
            END
        ) AS belum_halal,

        CONCAT(
            ROUND(
                (
                    SUM(
                        CASE
                            WHEN sh.status_sertifikasi LIKE '%Sudah%'
                            THEN 1
                            ELSE 0
                        END
                    ) / COUNT(u.id_umkm)
                ) * 100,
                2
            ),
            ' %'
        ) AS rasio_halal

    FROM jalan j
    JOIN umkm u
        ON j.id_jalan = u.id_jalan
    JOIN sertifikasi_halal sh
        ON u.id_sertifikasi_halal = sh.id_sertifikasi_halal

    GROUP BY j.id_jalan
    ");

    while($row = mysqli_fetch_assoc($query)){

        echo "<b>".$row['nama_jalan']."</b><br>";

        echo "Total UMKM : "
             .$row['total_umkm']
             ."<br>";

        echo "Sudah Halal : "
             .$row['sudah_halal']
             ."<br>";

        echo "Belum Halal : "
             .$row['belum_halal']
             ."<br>";

        echo "Rasio : "
             .$row['rasio_halal']
             ."<br><br>";
    }

    ?>

    </div>

</div>
    </main>
</div>

</body>
</html>