<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT *
         FROM sertifikasi_halal
         WHERE id_sertifikasi_halal=$id"
    )
);

if(isset($_POST['update'])){

    $status = $_POST['status_sertifikasi'];

    mysqli_query($koneksi,"
    UPDATE sertifikasi_halal
    SET status_sertifikasi='$status'
    WHERE id_sertifikasi_halal=$id
    ");

    header("Location:list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Sertifikasi Halal</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h2>Edit Sertifikasi Halal</h2>

<form method="POST">

    <input
        type="text"
        name="status_sertifikasi"
        value="<?= $data['status_sertifikasi']; ?>"
        required>

    <button
        type="submit"
        name="update">
        Update
    </button>

</form>

</body>
</html>