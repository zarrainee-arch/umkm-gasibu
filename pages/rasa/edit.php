<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM rasa
         WHERE id_rasa=$id"
    )
);

if(isset($_POST['update'])){

    $nama = $_POST['nama_rasa'];

    mysqli_query($koneksi,"
    UPDATE rasa
    SET nama_rasa='$nama'
    WHERE id_rasa=$id
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Rasa</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Edit Rasa</h2>

<form method="POST">

    <input
        type="text"
        name="nama_rasa"
        value="<?= $data['nama_rasa']; ?>"
        required>

    <button
        type="submit"
        name="update">
        Update
    </button>

</form>

</body>
</html>