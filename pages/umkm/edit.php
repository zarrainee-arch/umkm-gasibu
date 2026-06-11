<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {

    $id_umkm = $_POST['id_umkm'];
    $nama_umkm = $_POST['nama_umkm'];
    $id_jalan = $_POST['id_jalan'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];
    $link_umkm = $_POST['link_umkm'];
    $id_sertifikasi_halal = $_POST['id_sertifikasi_halal'];
    $foto_umkm = $_POST['foto_umkm'];

    $query = "UPDATE umkm SET
                nama_umkm = '$nama_umkm',
                id_jalan = '$id_jalan',
                jam_buka = '$jam_buka',
                jam_tutup = '$jam_tutup',
                link_umkm = '$link_umkm',
                id_sertifikasi_halal = '$id_sertifikasi_halal',
                foto_umkm = '$foto_umkm'
              WHERE id_umkm = '$id_umkm'";

    if(mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal mengupdate data!";
        echo "<br>" . mysqli_error($koneksi);
    }
}
?>