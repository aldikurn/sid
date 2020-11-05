<?php
include_once('../DatabaseHelper.php');

if(isset($_GET['nik'])) {
    $result = mysqli_query($databaseHelper->getConnection(), "SELECT penduduk.*, rw.id as id_rw, dusun.id as id_dusun FROM penduduk INNER JOIN rt ON rt.id = penduduk.id_rt INNER JOIN rw ON rw.id = rt.id_rw INNER JOIN dusun ON dusun.id = rw.id_dusun WHERE penduduk.nik = '" . $_GET['nik'] . "'");
    foreach($result as $row) {
        echo json_encode($row);
    }
}