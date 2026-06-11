<?php
include 'koneksi.php';

$query = "SELECT
            p.id_produk,
            p.nama_produk,
            p.harga_produk,
            p.bahan_utama,
            GROUP_CONCAT(r.nama_rasa SEPARATOR ', ') AS semua_rasa
          FROM produk p
          LEFT JOIN produk_rasa pr ON p.id_produk = pr.id_produk
          LEFT JOIN rasa r ON pr.id_rasa = r.id_rasa
          GROUP BY p.id_produk";
$result = mysqli_query($koneksi, $query);
?>