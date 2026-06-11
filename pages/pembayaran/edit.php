<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM metode_pembayaran
         WHERE id_metode_pembayaran=$id"
    )
);

if(isset($_POST['update'])){

    $nama = $_POST['nama_metode'];

    mysqli_query($koneksi,"
    UPDATE metode_pembayaran
    SET nama_metode='$nama'
    WHERE id_metode_pembayaran=$id
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Metode Pembayaran</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Edit Metode Pembayaran</h2>

<form method="POST">

    <input
        type="text"
        name="nama_metode"
        value="<?= $data['nama_metode']; ?>"
        required>

    <button
        type="submit"
        name="update">
        Update
    </button>

</form>

</body>
</html>