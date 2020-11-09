<?php
include_once('DatabaseHelper.php');
$response['code'] = -1;
$response['message'] = "Terjadi kesalahan";
$response['data'] = null;

if (isset($_GET['action']) && isset($_GET['nik'])) {

    if ($_GET['action'] === 'select') {
        if ($_GET['nik'] == 'all') {
            if(isset($_GET['wajib_pantau'])) {
                if($_GET['wajib_pantau'] === '1') {
                    $stmt = $conn->prepare("SELECT pemudik.*, penduduk.nama FROM pemudik INNER JOIN penduduk ON pemudik.nik = penduduk.nik WHERE wajib_pantau='ya'");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $response['data'] = array();
                    foreach ($result as $row) {
                        $response['data'][] = $row;
                    }

                    $response['message'] = "Berhasil mengambil semua records dengan wajib pantau = 1";
                }
            } else {
                $stmt = $conn->prepare("SELECT * FROM pemudik");
                $stmt->execute();
                $result = $stmt->get_result();
                $response['data'] = array();
                foreach ($result as $row) {
                    $response['data'][] = $row;
                }

                $response['message'] = "Berhasil mengambil semua records";
            }
            $stmt->close();
            $response['code'] = 0;
        } else {
            $stmt = $conn->prepare('SELECT pemudik.*, penduduk.nama FROM pemudik INNER JOIN penduduk ON pemudik.nik = penduduk.nik WHERE pemudik.nik = ?');
            $stmt->bind_param("s", $_GET['nik']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                foreach ($result as $row) {
                    $response['data'] = $row;
                }

                $response['code'] = 0;
                $response['message'] = "Berhasil mengambil record penduduk berdasarkan nik";
            } else {
                $response['code'] = 1;
                $response['message'] = "Data tidak ditemukan";
            }
            $stmt->close();
        };
    } elseif ($_GET['action'] === 'insert') {
        $dataLengkap = false;
        $data = array();

        $data['nik'] = $_POST['nik'];
        $data['asal'] = $_POST['asal'];
        $data['tujuan'] = $_POST['tujuan'];
        $data['durasi'] = $_POST['durasi'];
        $data['status_covid19'] = $_POST['status-covid19'];
        $data['wajib_pantau'] = $_POST['wajib-pantau'];
        $data['keluhan_kesehatan'] = $_POST['keluhan-kesehatan'];


        foreach ($data as $val) {
            if (!isset($val)) {
                $dataLengkap = false;
            } else {
                $dataLengkap = true;
            }
        }

        if ($dataLengkap) {

            $stmt = $conn->prepare("INSERT INTO pemudik(nik, asal, tujuan, durasi, status_covid19, wajib_pantau, keluhan_kesehatan) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $data['nik'], $data['asal'], $data['tujuan'], $data['durasi'], $data['status_covid19'], $data['wajib_pantau'], $data['keluhan_kesehatan']);
            $stmt->execute();
            $stmt->close();

            $response['code'] = 0;
            $response['message'] = "Data berhasil dimasukkan";
        } else {
            $response['code'] = -1;
            $response['message'] = "Data tidak lengkap";
        }
    } elseif ($_GET['action'] === 'delete') {
        $stmt = $conn->prepare("DELETE FROM pemudik WHERE nik = ?");
        $stmt->bind_param("s", $_GET['nik']);
        $stmt->execute();
        $stmt->close();
        $response['code'] = 0;
        $response['message'] = "Data penduduk berhasil dihapus berdasarkan nik";
    } else {
        $response['message'] = "Parameter tidak valid";
    }
}
echo json_encode($response);