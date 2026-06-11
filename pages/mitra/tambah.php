<?php
include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_mitra'];

    mysqli_query($koneksi,"
    INSERT INTO mitra(nama_mitra)
    VALUES('$nama')
    ");

    header("Location:list.php");
}
?>

<form method="POST">

    <h2>Tambah Mitra</h2>

    <input
        type="text"
        name="nama_mitra"
        required
        placeholder="Nama Mitra"
    >

    <button
        type="submit"
        name="simpan">
        Simpan
    </button>

</form>