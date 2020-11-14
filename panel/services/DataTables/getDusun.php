<?php
include_once('../DatabaseHelper.php');

$result = $conn->query
('
SELECT
    dusun.nama as nama_dusun,
    dusun.nik_kepala_dusun as nik_kepala_dusun,
    penduduk.nama as nama_kepala_dusun
FROM dusun
INNER JOIN penduduk
    ON penduduk.nik = dusun.nik_kepala_dusun
');

if ($result) {
    $response['code'] = 0;
    $response['message'] = 'Berhasil mendapatkan record';
    $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $response['code'] = -1;
    $response['message'] = 'Terjadi kesalahan';
    $response['data'] = null;
}

echo json_encode($response);