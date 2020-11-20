<?php
include_once('./DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi Kesalahan';

if(isset($_GET['action'])) {
    if($_GET['action'] === 'select') {
        if(isset($_GET['nik'])) {
            $stmt = $conn->prepare('
                SELECT 
                    perangkat_desa.nik,
                    perangkat_desa.nip,
                    penduduk.nama,
                    perangkat_desa.jabatan,
                    perangkat_desa.tanggal_pengangkatan,
                    perangkat_desa.masa_jabatan,
                    perangkat_desa.status
                FROM perangkat_desa
                INNER JOIN penduduk
                    ON penduduk.nik = perangkat_desa.nik
                WHERE perangkat_desa.nik = ?
            ');
            $stmt->bind_param('s', $_GET['nik']);
            $stmt->execute();
            $result = $stmt->get_result();
            $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
            $response['code'] = 0;
            $response['message'] = 'Berhasil menghapus data';
        } else {

        }
    } elseif($_GET['action'] === 'insert') {
        $stmt = $conn->prepare('
            INSERT INTO perangkat_desa (
                    nik,
                    nip,
                    jabatan,
                    tanggal_pengangkatan,
                    masa_jabatan,
                    status
                )
            VALUES (?, ?, ?, ?, ?, ?);
        ');
        $stmt->bind_param(
            'ssssss', 
            $_POST['nik'],
            $_POST['nip'],
            $_POST['jabatan'],
            $_POST['tanggal_pengangkatan'],
            $_POST['masa_jabatan'],
            $_POST['status']
        );
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil menambahkan data';
    } elseif($_GET['action'] === 'update') {
        $stmt = $conn->prepare('
            UPDATE perangkat_desa
                SET 
                    nik = ?,
                    nip = ?,
                    jabatan = ?,
                    tanggal_pengangkatan = ?,
                    masa_jabatan = ?,
                    status = ?
            WHERE nik = ?
        ');
        $stmt->bind_param(
            'sssssss', 
            $_POST['nik'],
            $_POST['nip'],
            $_POST['jabatan'],
            $_POST['tanggal_pengangkatan'],
            $_POST['masa_jabatan'],
            $_POST['status'],
            $_GET['nik']
        );
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil mengubah data';
    } elseif($_GET['action'] == 'delete') {
        $stmt = $conn->prepare('DELETE FROM perangkat_desa WHERE nik = ?');
        $stmt->bind_param('s', $_GET['nik']);
        $stmt->execute();
        $response['code'] = 0;
        $response['message'] = 'Berhasil menghapus data';
    }
}

echo json_encode($response);