<?php
include '../../config/koneksi.php';

$data = mysqli_query($koneksi,"
SELECT *
FROM rasa
ORDER BY id_rasa
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Rasa</title>
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
            <li><a href="list.php">DATA RASA</a></li>
        </ul>

    </aside>

    <main class="content">

        <h1>DATA RASA</h1>

        <a href="tambah.php" class="btn-tambah">
            TAMBAH RASA
        </a>

        <table class="tabel-hasil">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Rasa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($data)){ ?>

                <tr>

                    <td><?= $row['id_rasa']; ?></td>

                    <td><?= $row['nama_rasa']; ?></td>

                    <td>

                        <a href="edit.php?id=<?= $row['id_rasa']; ?>">
                            Edit
                        </a>

                        |

                        <a href="hapus.php?id=<?= $row['id_rasa']; ?>"
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