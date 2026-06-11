<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM kategori
         WHERE id_kategori=$id"
    )
);

if(isset($_POST['update'])){

    $nama = $_POST['nama_kategori'];

    mysqli_query($koneksi,"
    UPDATE kategori
    SET nama_kategori='$nama'
    WHERE id_kategori=$id
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Edit Kategori</h2>

<form method="POST">

    <input
        type="text"
        name="nama_kategori"
        value="<?= $data['nama_kategori']; ?>"
        required>

    <button
        type="submit"
        name="update">
        Update
    </button>

</form>

</body>
</html>