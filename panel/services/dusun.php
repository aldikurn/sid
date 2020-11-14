<?php
include_once('./DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi Kesalahan';
$response['data'] = null;

if(isset($_GET['action'])) {
    if($_GET['action'] === 'select') {
        if(isset($_GET['nama_dusun'])) {
            $stmt = $conn->prepare('
                SELECT
                    dusun.nama as nama_dusun,
                    dusun.nik_kepala_dusun as nik_kepala_dusun,
                    penduduk.nama as nama_kepala_dusun
                FROM dusun
                INNER JOIN penduduk
                    ON penduduk.nik = dusun.nik_kepala_dusun
                WHERE dusun.nama = ?
            ');
            $stmt->bind_param('s', $_GET['nama_dusun']);
            $stmt->execute();
            $result = $stmt->get_result();
            $response['data'] = $result->fetch_assoc();
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengambil data';
        }
    } elseif($_GET['action'] === 'insert') {
        $stmt = $conn->prepare('INSERT INTO dusun(nama, nik_kepala_dusun) VALUES(?, ?)');
        $stmt->bind_param('ss', $_POST['nama_dusun'], $_POST['nik_kepala_dusun']);
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil menambah dusun';
    } elseif($_GET['action'] === 'update') {
        if(isset($_GET['nama_dusun'])) {
            $stmt = $conn->prepare('
                UPDATE
                    dusun
                SET
                    nama = ?,
                    nik_kepala_dusun = ?
                WHERE nama = ?
            ');
            $stmt->bind_param('sss', $_POST['nama_dusun'], $_POST['nik_kepala_dusun'], $_GET['nama_dusun']);
            $stmt->execute();
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengambil data';
        }
    } elseif($_GET['action'] === 'delete') {
        if(isset($_GET['nama_dusun'])) {
            $stmt = $conn->prepare('DELETE FROM dusun WHERE nama = ?');
            $stmt->bind_param('s', $_GET['nama_dusun']);
            $stmt->execute();
            $response['code'] = 0;
            $response['message'] = 'Berhasil menghapus data';
        }
    }
}

echo json_encode($response);