<?php
include_once('./DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi Kesalahan';
$response['data'] = null;

if(isset($_GET['action'])) {
    if($_GET['action'] === 'select') {
        if(isset($_GET['id_rw'])) {
            $stmt = $conn->prepare('
                SELECT
                    rw.id,
                    rw.nik_kepala_rw,
                    penduduk.nama nama_kepala_rw,
                    dusun.id  id_dusun,
                    dusun.nama nama_dusun,
                    rw.nomor nomor_rw
                FROM rw
                INNER JOIN penduduk
                    ON penduduk.nik = rw.nik_kepala_rw
                INNER JOIN dusun
                    ON dusun.id = rw.id_dusun
                WHERE rw.id = ?
            ');
            $stmt->bind_param('s', $_GET['id_rw']);
            $stmt->execute();
            $result = $stmt->get_result();
            $response['data'] = $result->fetch_assoc();
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengambil data';
        } else {
            $result = $conn->query('SELECT * FROM rw');
            $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengambil data';
        }
    } elseif($_GET['action'] === 'insert') {
        $stmt = $conn->prepare('INSERT INTO rw(id_dusun, nomor, nik_kepala_rw) VALUES(?, ?, ?)');
        $stmt->bind_param('sss', $_POST['dusun'], $_POST['nomor'], $_POST['nik_kepala_rw']);
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil menambah dusun';
    } elseif($_GET['action'] === 'update') {
        if(isset($_GET['id_rw'])) {
            $stmt = $conn->prepare('
                UPDATE
                    rw
                SET
                    id_dusun = ?,
                    nomor = ?,
                    nik_kepala_rw = ?
                WHERE id = ?
            ');
            $stmt->bind_param('ssss', $_POST['dusun'], $_POST['nomor'], $_POST['nik_kepala_rw'], $_GET['id_rw']);
            $stmt->execute();
            $response['code'] = 0;
            $response['message'] = 'Berhasil mengubah data';
        }
    } elseif($_GET['action'] === 'delete') {
        if(isset($_GET['id_rw'])) {
            $stmt = $conn->prepare('DELETE FROM rw WHERE id = ?');
            $stmt->bind_param('s', $_GET['id_rw']);
            $stmt->execute();
            $response['code'] = 0;
            $response['message'] = 'Berhasil menghapus data';
        }
    }
}

echo json_encode($response);