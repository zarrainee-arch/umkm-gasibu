<?php
include '../../config/koneksi.php';

$data = mysqli_query($koneksi,"
SELECT *
FROM kategori
ORDER BY id_kategori
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container-admin">

    <aside class="sidebar">

        <div class="logo-sidebar">
            <img src="../../assets/logo.png">
            <h2>UMKM GASIBU</h2>
        </div>

        <ul>
            <li><a href="../../dashboard.php">DASHBOARD</a></li>
            <li><a href="list.php">DATA KATEGORI</a></li>
        </ul>

    </aside>

    <main class="content">

        <h1>DATA KATEGORI</h1>

        <a href="tambah.php" class="btn-tambah">
            TAMBAH KATEGORI
        </a>

        <table class="tabel-hasil">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($data)){ ?>

                <tr>

                    <td><?= $row['id_kategori']; ?></td>

                    <td><?= $row['nama_kategori']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $row['id_kategori']; ?>">
                            Edit
                        </a>

                        |

                        <a href="hapus.php?id=<?= $row['id_kategori']; ?>"
                           onclick="return confirm('Hapus data?')">
                            Hapus
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </main>

</div>

</body>
</html>