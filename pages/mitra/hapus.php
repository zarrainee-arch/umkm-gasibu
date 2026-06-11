<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(
    $koneksi,
    "DELETE FROM mitra
     WHERE id_mitra=$id"
);

header("Location:list.php");