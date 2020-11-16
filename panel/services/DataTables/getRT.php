<?php
include_once('../DatabaseHelper.php');

$result = $conn->query
('
SELECT
    rt.id as id,
	rt.nik_kepala_rt as nik_kepala_rt,
    penduduk.nama as nama_kepala_rt,
    dusun.nama as dusun,
	rw.nomor as nomor_rw,
	rt.nomor as nomor_rt
FROM rt 
INNER JOIN rw
	ON rw.id = rt.id_rw
INNER JOIN dusun
	ON dusun.id = rw.id_dusun
INNER JOIN penduduk
	ON penduduk.nik = rt.nik_kepala_rt
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