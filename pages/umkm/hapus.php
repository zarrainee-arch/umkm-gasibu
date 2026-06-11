<?php include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $id_umkm = $_GET['id'];
    
    $query = "DELETE FROM umkm WHERE id_umkm = '$id_umkm'";
    $delete = mysqli_query($koneksi, $query);
    
    if ($delete) {
        echo "<script>
                alert('Data UMKM Berhasil Dihapus!');
                window.location='crud_umkm.php';
            </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: crud_umkm.php");
    exit;
}
?>