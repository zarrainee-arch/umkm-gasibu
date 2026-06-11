<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT * FROM mitra
         WHERE id_mitra=$id"
    )
);

if(isset($_POST['update'])){

    $nama = $_POST['nama_mitra'];

    mysqli_query($koneksi,"
    UPDATE mitra
    SET nama_mitra='$nama'
    WHERE id_mitra=$id
    ");

    header("Location:list.php");
}
?>

<form method="POST">

    <h2>Edit Mitra</h2>

    <input
        type="text"
        name="nama_mitra"
        value="<?= $data['nama_mitra']; ?>"
        required
    >

    <button
        type="submit"
        name="update">
        Update
    </button>

</form>