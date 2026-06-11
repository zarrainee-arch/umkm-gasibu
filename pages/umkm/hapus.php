<?php
include 'koneksi.php';

// Menangkap ID dari URL
$id = $_GET['id'];

// Query Hapus
$query = "DELETE FROM umkm WHERE id_umkm = '$id'";

if(mysqli_query($koneksi, $query)) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus data!";
}
?>