<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(
    $koneksi,
    "DELETE FROM rasa
     WHERE id_rasa=$id"
);

header("Location:list.php");