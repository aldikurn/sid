<?php
include_once('../DatabaseHelper.php');

$result = $conn->query("
SELECT
    dt_agama.nama,
    COUNT(penduduk.id_agama) jumlah
FROM dt_agama
LEFT JOIN penduduk
    ON penduduk.id_agama = dt_agama.id
GROUP BY dt_agama.id
");

$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['nama'],
        'y' =>  intval($row['jumlah'])
    ));
}

echo json_encode($data);