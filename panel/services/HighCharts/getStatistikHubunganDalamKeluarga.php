<?php
include_once('../DatabaseHelper.php');

$result = $conn->query("
SELECT
    dt_hubungan_dalam_keluarga.nama,
    COUNT(penduduk.id_hubungan_dalam_keluarga) jumlah
FROM dt_hubungan_dalam_keluarga
LEFT JOIN penduduk
    ON penduduk.id_hubungan_dalam_keluarga = dt_hubungan_dalam_keluarga.id
GROUP BY dt_hubungan_dalam_keluarga.id
");

$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['nama'],
        'y' =>  intval($row['jumlah'])
    ));
}

echo json_encode($data);