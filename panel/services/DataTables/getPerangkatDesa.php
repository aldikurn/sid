<?php
include_once('../DatabaseHelper.php');

$result = $conn->query('
SELECT 
    perangkat_desa.nik,
    perangkat_desa.nip,
    perangkat_desa.tanggal_pengangkatan,
    perangkat_desa.jabatan,
    perangkat_desa.masa_jabatan,
    perangkat_desa.status,
    penduduk.nama
FROM perangkat_desa
INNER JOIN penduduk
    ON penduduk.nik = perangkat_desa.nik
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