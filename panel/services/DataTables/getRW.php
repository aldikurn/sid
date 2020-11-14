<?php
include_once('../DatabaseHelper.php');

$result = $conn->query
('
SELECT
    rw.id as id,
	rw.nik_kepala_rw as nik_kepala_rw,
    penduduk.nama as nama_kepala_rw,
    dusun.nama as dusun,
	rw.nomor as nomor_rw
FROM rw 
INNER JOIN dusun
	ON dusun.id = rw.id_dusun
INNER JOIN penduduk
	ON penduduk.nik = rw.nik_kepala_rw
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