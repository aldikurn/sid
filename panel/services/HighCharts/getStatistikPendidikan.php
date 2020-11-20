<?php
include_once('../DatabaseHelper.php');

$result = $conn->query("
SELECT
    dt_pendidikan_terakhir.nama,
    COUNT(penduduk.id_pendidikan_terakhir) jumlah
FROM dt_pendidikan_terakhir
LEFT JOIN penduduk
    ON penduduk.id_pendidikan_terakhir = dt_pendidikan_terakhir.id
GROUP BY dt_pendidikan_terakhir.id
");

$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['nama'],
        'y' =>  intval($row['jumlah'])
    ));
}

echo json_encode($data);