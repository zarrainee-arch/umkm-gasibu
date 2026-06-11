<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $id_umkm = $_POST['id_umkm'];
    $id_asal_daerah = $_POST['id_asal_daerah'];
    $bahan = $_POST['bahan_utama'];
    $id_kategori = $_POST['id_kategori'];

    // Query Insert
    $queryp = "INSERT INTO produk (nama_produk, harga_produk, id_umkm, id_asal_daerah, bahan_utama, id_kategori)
        VALUES ('$nama', '$harga', '$id_umkm', '$id_asal_daerah', '$bahan', '$id_kategori')";
   
    if(mysqli_query($koneksi, $queryp)) {
        $id_produk = mysqli_insert_id($koneksi);
        $querypr = "INSERT INTO produk_rasa (id_produk, id_rasa)
            VALUES ('$id_produk', '$id_rasa')";
            
            if(mysqli_query($koneksi, $querypr)) {
                header("Location: index.php"); // Kembali ke halaman utama jika sukses
            } else {
                echo "Gagal menambah rasa!";
            }
    } else {
        echo "Gagal menambah produk!";
    }
}
?>
