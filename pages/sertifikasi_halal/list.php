<?php
include '../../config/koneksi.php';

$data = mysqli_query($koneksi,"
SELECT *
FROM sertifikasi_halal
ORDER BY id_sertifikasi_halal
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sertifikasi Halal</title>
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
            <li><a href="list.php">SERTIFIKASI HALAL</a></li>
        </ul>

    </aside>

    <main class="content">

        <h1>SERTIFIKASI HALAL</h1>

        <a href="tambah.php" class="btn-tambah">
            TAMBAH STATUS
        </a>

        <table class="tabel-hasil">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status Sertifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($data)){ ?>

                <tr>

                    <td><?= $row['id_sertifikasi_halal']; ?></td>

                    <td><?= $row['status_sertifikasi']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $row['id_sertifikasi_halal']; ?>">
                            Edit
                        </a>

                        |

                        <a href="hapus.php?id=<?= $row['id_sertifikasi_halal']; ?>"
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