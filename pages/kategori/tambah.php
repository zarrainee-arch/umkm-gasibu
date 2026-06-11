<?php
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_kategori'];

    mysqli_query($koneksi,"
    INSERT INTO kategori(nama_kategori)
    VALUES('$nama')
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Tambah Kategori</h2>

<form method="POST">

    <input
        type="text"
        name="nama_kategori"
        required
        placeholder="Nama Kategori">

    <button
        type="submit"
        name="simpan">
        Simpan
    </button>

</form>

</body>
</html>