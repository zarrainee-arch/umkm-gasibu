<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT
        u.id_umkm,
        u.nama_umkm,
        j.nama_jalan,
        u.jam_buka,
        u.jam_tutup,
        u.link_umkm,
        sh.status_sertifikasi,
        u.foto_umkm
    FROM umkm u
    JOIN jalan j
        ON u.id_jalan = j.id_jalan
    JOIN sertifikasi_halal sh
        ON u.id_sertifikasi_halal = sh.id_sertifikasi_halal
");

while($data = mysqli_fetch_assoc($query)) {
    echo "ID UMKM: " . $data['id_umkm'] . "<br>";
    echo "Nama UMKM: " . $data['nama_umkm'] . "<br>";
    echo "Jalan: " . $data['nama_jalan'] . "<br>";
    echo "Jam Buka: " . $data['jam_buka'] . "<br>";
    echo "Jam Tutup: " . $data['jam_tutup'] . "<br>";
    echo "Link: " . $data['link_umkm'] . "<br>";
    echo "Sertifikasi: " . $data['status_sertifikasi'] . "<br>";
    echo "Foto: " . $data['foto_umkm'] . "<br>";
    echo "<hr>";
}
?>