<?php
include_once('./DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi Kesalahan';

if(isset($_GET['action'])) {
    if($_GET['action'] == 'delete') {
        $stmt = $conn->prepare('DELETE FROM perangkat_desa WHERE nik = ?');
        $stmt->bind_param('s', $_GET['nik']);
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil menghapus data';
    }
}

echo json_encode($response);