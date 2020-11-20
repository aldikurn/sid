<?php
include_once('../DatabaseHelper.php');

$result = $conn->query("
SELECT
    dt_jenis_kelamin.nama,
    COUNT(penduduk.id_jenis_kelamin) jumlah
FROM dt_jenis_kelamin
LEFT JOIN penduduk
    ON penduduk.id_jenis_kelamin = dt_jenis_kelamin.id
GROUP BY dt_jenis_kelamin.id
");

$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['nama'],
        'y' =>  intval($row['jumlah'])
    ));
}

echo json_encode($data);