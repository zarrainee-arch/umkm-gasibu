<?php
include '../../config/koneksi.php';

$data = mysqli_query($koneksi,"
SELECT *
FROM metode_pembayaran
ORDER BY id_metode_pembayaran
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Metode Pembayaran</title>
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
            <li><a href="list.php">METODE PEMBAYARAN</a></li>
        </ul>

    </aside>

    <main class="content">

        <h1>METODE PEMBAYARAN</h1>

        <a href="tambah.php" class="btn-tambah">
            TAMBAH METODE
        </a>

        <table class="tabel-hasil">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Metode</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($data)){ ?>

                <tr>

                    <td><?= $row['id_metode_pembayaran']; ?></td>

                    <td><?= $row['nama_metode']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $row['id_metode_pembayaran']; ?>">
                            Edit
                        </a>

                        |

                        <a href="hapus.php?id=<?= $row['id_metode_pembayaran']; ?>"
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