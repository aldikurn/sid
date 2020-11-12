<?php
include_once('DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi kesalahan';
$response['data'] = null;
 
if(isset($_GET['action'])) {
    if($_GET['action'] === 'select') {
        if(isset($_GET['nomor_kk'])) {
            $result = $conn->query('SELECT penduduk.nik, penduduk.nama, penduduk.tanggal_lahir, dt_jenis_kelamin.nama as jenis_kelamin, dt_hubungan_dalam_keluarga.nama as hubungan_dalam_keluarga FROM penduduk INNER JOIN dt_jenis_kelamin ON dt_jenis_kelamin.id = penduduk.id_jenis_kelamin INNER JOIN dt_hubungan_dalam_keluarga ON dt_hubungan_dalam_keluarga.id = penduduk.id_hubungan_dalam_keluarga WHERE nomor_kk = ' . $_GET['nomor_kk']);
            $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
            $response['code'] = 0;
            $response['message'] = 'Berhasil mendapatkan record';
        } else {
            $response['code'] = -1;
            $response['message'] = 'Parameter tidak lengkap';
        }
    } elseif($_GET['action'] === 'delete') {
        if(isset($_GET['nomor_kk'])) {
            $conn->query('DELETE FROM penduduk WHERE nomor_kk = ' . $_GET['nomor_kk']);
            $response['code'] = 0;
            $response['message'] = 'Berhasil mendapatkan record';
        } else if(isset($_GET['nik'])) {
            $conn->query('UPDATE penduduk SET nomor_kk = NULL WHERE nik = ' . $_GET['nik']);
            $response['code'] = 0;
            $response['message'] = 'Berhasil mendapatkan record';
        } else {
            $response['code'] = -1;
            $response['message'] = 'Parameter tidak lengkap';
        }
    }
} else {
    $response['message'] = 'Parameter tidak lengkap';
}

echo json_encode($response);