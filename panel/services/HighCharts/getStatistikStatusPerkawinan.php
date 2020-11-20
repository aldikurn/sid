<?php
include_once('../DatabaseHelper.php');

$result = $conn->query("
SELECT
    dt_status_perkawinan.nama,
    COUNT(penduduk.id_status_perkawinan) jumlah
FROM dt_status_perkawinan
LEFT JOIN penduduk
    ON penduduk.id_status_perkawinan = dt_status_perkawinan.id
GROUP BY dt_status_perkawinan.id
");

$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['nama'],
        'y' =>  intval($row['jumlah'])
    ));
}

echo json_encode($data);