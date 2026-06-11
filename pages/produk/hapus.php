<?php include '../../config/koneksi.php';

$id_produk = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if ($id_produk != '') {
    $hapus_relasi = mysqli_query($koneksi, "DELETE FROM produk_rasa WHERE id_produk = '$id_produk'");

    if ($hapus_relasi) {
        $hapus_produk = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id_produk'");

        if ($hapus_produk) {
            echo "<script>
                    alert('Produk Berhasil Dihapus!');
                    window.location='list.php';
                </script>";
        } else {
            echo "Gagal menghapus produk utama: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal menghapus varian rasa produk: " . mysqli_error($koneksi);
    }

} else {
    header("Location: list.php");
    exit;
}
?>