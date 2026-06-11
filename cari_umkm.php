<?php
include 'config/koneksi.php';

$hasil = null;

if(isset($_GET['jam']) && $_GET['jam'] != ''){

    $jam = $_GET['jam'];

    $query = mysqli_query(
        $koneksi,
        "CALL cari_umkm_buka('$jam')"
    );

    $hasil = $query;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cari UMKM Buka</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-admin">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo-sidebar">
            <img src="assets/logo.png" alt="">
            <h2>UMKM GASIBU</h2>
        </div>

        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="pages/umkm/list.php">DAFTAR UMKM</a></li>
            <li><a href="pages/produk/list.php">DAFTAR PRODUK</a></li>
            <li><a href="cari_umkm.php">CARI UMKM BUKA</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <h1>CARI UMKM BUKA</h1>

        <form method="GET" class="form-cari">

            <input
                type="time"
                name="jam"
                value="<?= isset($_GET['jam']) ? $_GET['jam'] : '' ?>"
                required
            >

            <button type="submit">
                Cari
            </button>

        </form>

        <h2 class="hasil-title">
            Hasil Pencarian:
        </h2>

            <table class="tabel-hasil">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama UMKM</th>
                    <th>Jalan</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Link UMKM</th>
                </tr>
            </thead>

            <tbody>

            <?php
            if($hasil){

                $no = 1;

                while($row = mysqli_fetch_assoc($hasil)){
            ?>

                <tr>
                    <td><?= $no++ ?></td>

                    <td><?= $row['nama_umkm'] ?></td>

                    <td><?= $row['nama_jalan'] ?></td>

                    <td><?= $row['jam_buka'] ?></td>

                    <td><?= $row['jam_tutup'] ?></td>

                    <td>
                        <a href="<?= $row['link_umkm'] ?>" target="_blank">
                            Kunjungi
                        </a>
                    </td>
                </tr>

            <?php
                }
            }
            ?>

            </tbody>

        </table>

    </main>

</div>

<footer>
    <div>
        <p>&copy; 2026 UMKM Gasibu</p>
        <p>Jl. Diponegoro, Bandung</p>
    </div>

    <div>
        <h3>UMKM GASIBU</h3>
        <p>Dukung Lokal, Kuatkan Ekonomi</p>
    </div>
</footer>
<?php
if($hasil){
    mysqli_free_result($hasil);

    while(mysqli_more_results($koneksi)){
        mysqli_next_result($koneksi);
    }
}
?>
</body>
</html>