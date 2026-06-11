<?php
include '../../config/koneksi.php';

$data = mysqli_query($koneksi,"
SELECT *
FROM asal_daerah
ORDER BY id_asal_daerah
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Asal Daerah</title>
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
            <li><a href="list.php">ASAL DAERAH</a></li>
        </ul>

    </aside>

    <main class="content">

        <h1>DATA ASAL DAERAH</h1>

        <a href="tambah.php" class="btn-tambah">
            TAMBAH ASAL DAERAH
        </a>

        <table class="tabel-hasil">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Asal Daerah</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($data)){ ?>

                <tr>

                    <td><?= $row['id_asal_daerah']; ?></td>

                    <td><?= $row['nama_asal_daerah']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $row['id_asal_daerah']; ?>">
                            Edit
                        </a>

                        |

                        <a href="hapus.php?id=<?= $row['id_asal_daerah']; ?>"
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