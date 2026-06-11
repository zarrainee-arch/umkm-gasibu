<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(
    $koneksi,
    "DELETE FROM metode_pembayaran
     WHERE id_metode_pembayaran=$id"
);

header("Location:list.php");