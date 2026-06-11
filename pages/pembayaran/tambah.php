<?php
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_metode'];

    mysqli_query($koneksi,"
    INSERT INTO metode_pembayaran(nama_metode)
    VALUES('$nama')
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Metode Pembayaran</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Tambah Metode Pembayaran</h2>

<form method="POST">

    <input
        type="text"
        name="nama_metode"
        required
        placeholder="Nama Metode">

    <button
        type="submit"
        name="simpan">
        Simpan
    </button>

</form>

</body>
</html>