<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {

    $nama_umkm = $_POST['nama_umkm'];
    $id_jalan = $_POST['id_jalan'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];
    $link_umkm = $_POST['link_umkm'];
    $id_sertifikasi_halal = $_POST['id_sertifikasi_halal'];
    $foto_umkm = $_POST['foto_umkm'];

    $query = "INSERT INTO umkm (
                nama_umkm,
                id_jalan,
                jam_buka,
                jam_tutup,
                link_umkm,
                id_sertifikasi_halal,
                foto_umkm
              ) VALUES (
                '$nama_umkm',
                '$id_jalan',
                '$jam_buka',
                '$jam_tutup',
                '$link_umkm',
                '$id_sertifikasi_halal',
                '$foto_umkm'
              )";

    if(mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambah data!<br>";
        echo mysqli_error($koneksi);
    }
}
?>