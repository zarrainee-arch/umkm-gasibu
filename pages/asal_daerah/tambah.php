<?php
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_asal_daerah'];

    mysqli_query($koneksi,"
    INSERT INTO asal_daerah(nama_asal_daerah)
    VALUES('$nama')
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Asal Daerah</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Tambah Asal Daerah</h2>

<form method="POST">

    <input
        type="text"
        name="nama_asal_daerah"
        required
        placeholder="Nama Asal Daerah">

    <button
        type="submit"
        name="simpan">
        Simpan
    </button>

</form>

</body>
</html>