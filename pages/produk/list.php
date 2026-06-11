<?php include '../../config/koneksi.php'; 

$qKategori = mysqli_query($koneksi, "SELECT * FROM kategori");

$cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
$filter_kategori = isset($_GET['kategori']) ? (int)$_GET['kategori'] : 0;

$query = "SELECT
            p.id_produk,
            p.nama_produk,
            p.harga_produk,
            k.nama_kategori,
            u.nama_umkm,
            ad.nama_asal_daerah,
            GROUP_CONCAT(r.nama_rasa SEPARATOR ', ') AS rasa
        FROM produk p
        JOIN kategori k ON p.id_kategori = k.id_kategori
        JOIN umkm u ON p.id_umkm = u.id_umkm
        JOIN asal_daerah ad ON p.id_asal_daerah = ad.id_asal_daerah
        LEFT JOIN produk_rasa pr ON p.id_produk = pr.id_produk
        LEFT JOIN rasa r ON pr.id_rasa = r.id_rasa
        WHERE 1=1";

if ($cari != '') {
    $query .= " AND p.nama_produk LIKE '%$cari%'";
}
if ($filter_kategori > 0) {
    $query .= " AND p.id_kategori = $filter_kategori";
}

$query .= " GROUP BY p.id_produk ORDER BY p.id_produk DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Eror: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk UMKM Gasibu</title>
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
                    <li><a href="list.php">DAFTAR PRODUK</a></li>
                    <li><a href = "../../cari_umkm.php">CARI UMKM BUKA</a></li>
                </ul>
            </nav>
        </aside>
        
        <main>
            <h2>DAFTAR PRODUK</h2>
            <form class="filter-container" method="GET" action="">
                <!--Mencari produk berdasarkan nama-->
                <div class="search-box">
                    <input type="text" name="cari" 
                    value="<?= stripslashes($cari); ?>" 
                    placeholder="Cari Nama Produk">
                </div>
                
                <!--Mencari prduk berdasarkan kategori-->
                <div class="kategori-box">
                    <select name="kategori" onchange="this.form.submit()">
                        <option value="">
                            Filter Kategori
                        </option>
                        <?php while($kategori = mysqli_fetch_assoc($qKategori)){ ?>
                            <option value="<?= $kategori['id_kategori']; ?>" <?= $filter_kategori == $kategori['id_kategori'] ? 'selected' : ''; ?>>
                                <?= $kategori['nama_kategori']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit">
                    Cari
                </button>
            </form>
            
            <!--Tabel daftar produk -->
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>UMKM</th>
                        <th>Asal Daerah</th>
                        <th>Rasa</th>
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
                            <td><?= $row['nama_produk']; ?></td>
                            <td>Rp <?= number_format($row['harga_produk'],0,',','.'); ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
                            <td><?= $row['nama_umkm']; ?></td>
                            <td><?= $row['nama_asal_daerah']; ?></td>
                            <td><?= $row['rasa'] ? $row['rasa'] : '-'; ?></td>
                            <td>
                                <a href="detail.php?id_produk=<?= $row['id_produk']; ?>">Detail</a>
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