<?php
include '../../config/koneksi.php';

$query = mysqli_query($koneksi,"
SELECT *
FROM mitra
ORDER BY id_mitra
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mitra</title>
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
            <li><a href="list.php">DATA MITRA</a></li>
        </ul>

    </aside>

    <main class="content">

        <h1>DATA MITRA</h1>

        <a href="tambah.php" class="btn-tambah">
            TAMBAH MITRA
        </a>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mitra</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($query)){ ?>

                <tr>

                    <td><?= $row['id_mitra']; ?></td>

                    <td><?= $row['nama_mitra']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $row['id_mitra']; ?>">
                            Edit
                        </a>

                        |

                        <a href="hapus.php?id=<?= $row['id_mitra']; ?>"
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