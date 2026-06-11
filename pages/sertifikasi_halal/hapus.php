<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(
    $koneksi,
    "DELETE FROM sertifikasi_halal
     WHERE id_sertifikasi_halal=$id"
);

header("Location:list.php");