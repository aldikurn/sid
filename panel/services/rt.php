<?php
include_once('./DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi Kesalahan';
$response['data'] = null;

if(isset($_GET['action'])) {
    if($_GET['action'] === 'select') {
        if(isset($_GET['id_rt'])) {
            $stmt = $conn->prepare('
                SELECT
                    rt.id,
                    rt.nik_kepala_rt,
                    penduduk.nama nama_kepala_rt,
                    dusun.nama nama_dusun,
                    rw.nomor nomor_rw,
                    rt.nomor nomor_rt,
                    dusun.id id_dusun,
                    rt.id_rw
                FROM rt
                INNER JOIN penduduk
                    ON penduduk.nik = rt.nik_kepala_rt
                INNER JOIN rw
                    ON rw.id = rt.id_rw
                INNER JOIN dusun
                    ON dusun.id = rw.id_dusun
                WHERE rt.id = ?
            ');
            $stmt->bind_param('s', $_GET['id_rt']);
            $stmt->execute();
            $result = $stmt->get_result();
            $response['data'] = $result->fetch_assoc();
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengambil data';
        } else {
            $result = $conn->query('SELECT * FROM rt');
            $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengambil data';
        }
    } elseif($_GET['action'] === 'insert') {
        $stmt = $conn->prepare('INSERT INTO rt(id_rw, nomor, nik_kepala_rt) VALUES(?, ?, ?)');
        $stmt->bind_param('sss', $_POST['rw'], $_POST['nomor'], $_POST['nik_kepala_rt']);
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil menambah dusun';
    } elseif($_GET['action'] === 'update') {
        if(isset($_GET['id_rt'])) {
            $stmt = $conn->prepare('
                UPDATE
                    rt
                SET
                    id_rw = ?,
                    nomor = ?,
                    nik_kepala_rt = ?
                WHERE id = ?
            ');
            $stmt->bind_param('ssss', $_POST['id_rw'], $_POST['nomor'], $_POST['nik_kepala_rt'], $_GET['id_rt']);
            $stmt->execute();
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengubah data';
        }
    } elseif($_GET['action'] === 'delete') {
        if(isset($_GET['id_rt'])) {
            $stmt = $conn->prepare('DELETE FROM rt WHERE id = ?');
            $stmt->bind_param('s', $_GET['id_rt']);
            $stmt->execute();
            $response['code'] = 0;
            $response['message'] = 'Berhasil menghapus data';
        }
    }
}

echo json_encode($response);