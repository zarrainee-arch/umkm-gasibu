<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(
    $koneksi,
    "DELETE FROM asal_daerah
     WHERE id_asal_daerah=$id"
);

header("Location:list.php");