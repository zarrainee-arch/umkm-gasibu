<?php
include 'koneksi.php';

// Menangkap ID dari URL
$id = $_GET['id_produk'];

// Query Hapus
$querypr = "DELETE FROM produk_rasa WHERE id_produk = '$id'";

if(mysqli_query($koneksi, $querypr)) {
    $querypr = "DELETE FROM produk WHERE id_produk = '$id'";
    if(mysqli_query($koneksi, $queryp)) {
        header("Location: index.php");
    } else {
        echo "Gagal menghapus ptoduk";
    }
} else {
    echo "Gagal menghapus rasa";
}
?>
