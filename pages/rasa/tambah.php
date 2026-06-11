<?php
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_rasa'];

    mysqli_query($koneksi,"
    INSERT INTO rasa(nama_rasa)
    VALUES('$nama')
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Rasa</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Tambah Rasa</h2>

<form method="POST">

    <input
        type="text"
        name="nama_rasa"
        required
        placeholder="Nama Rasa">

    <button
        type="submit"
        name="simpan">
        Simpan
    </button>

</form>

</body>
</html>