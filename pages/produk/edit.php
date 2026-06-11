<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {
    // Menangkap data dari form edit
    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $id_umkm = $_POST['id_umkm'];
    $id_asal_daerah = $_POST['id_asal_daerah'];
    $bahan = $_POST['bahan_utama'];
    $id_kategori = $_POST['id_kategori'];

    // Query Update
    $queryp = "UPDATE produk SET
                nama_produk = '$nama',
                harga_produk = '$harga', 
                id_umkm = '$id_umkm', 
                id_asal_daerah = '$id_asal_daerah', 
                bahan_utama = '$bahan', 
                id_kategori = '$id_kategori'
              WHERE id_produk = '$id'";
   
    if(mysqli_query($koneksi, $queryp)) {
        $id_produk = mysqli_insert_id($koneksi);
        $querypr = "UPDATE produk_rasa SET
            id_rasa = '$id_rasa'
            WHERE id_produk = '$id'";
        if(mysqli_query($koneksi, $querypr)) {
            header("Location: index.php"); // Kembali ke halaman utama jika sukses
        } else {
            echo "Gagal mengupdate rasa!";
        }
    } else {
        echo "Gagal mengupdate produk!";
    }
}
?>
