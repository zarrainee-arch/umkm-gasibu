<?php
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $status = $_POST['status_sertifikasi'];

    mysqli_query($koneksi,"
    INSERT INTO sertifikasi_halal(status_sertifikasi)
    VALUES('$status')
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Sertifikasi Halal</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Tambah Sertifikasi Halal</h2>

<form method="POST">

    <input
        type="text"
        name="status_sertifikasi"
        required
        placeholder="Status Sertifikasi">

    <button
        type="submit"
        name="simpan">
        Simpan
    </button>

</form>

</body>
</html>