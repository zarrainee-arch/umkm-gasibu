<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM asal_daerah
         WHERE id_asal_daerah=$id"
    )
);

if(isset($_POST['update'])){

    $nama = $_POST['nama_asal_daerah'];

    mysqli_query($koneksi,"
    UPDATE asal_daerah
    SET nama_asal_daerah='$nama'
    WHERE id_asal_daerah=$id
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Asal Daerah</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Edit Asal Daerah</h2>

<form method="POST">

    <input
        type="text"
        name="nama_asal_daerah"
        value="<?= $data['nama_asal_daerah']; ?>"
        required>

    <button
        type="submit"
        name="update">
        Update
    </button>

</form>

</body>
</html>