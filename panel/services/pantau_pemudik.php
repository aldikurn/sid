<?php
include_once('DatabaseHelper.php');
$response['code'] = -1;
$response['message'] = "Terjadi kesalahan";
$response['data'] = null;

if (isset($_GET['action']) && isset($_GET['nik'])) {

    if ($_GET['action'] === 'select') {
        if ($_GET['nik'] == 'all') {
            $stmt = $conn->prepare("SELECT pantau_pemudik.*, penduduk.nama, pemudik.status_covid19 FROM pantau_pemudik INNER JOIN penduduk ON penduduk.nik = pantau_pemudik.nik INNER JOIN pemudik ON pemudik.nik = pantau_pemudik.nik");
            $stmt->execute();
            $result = $stmt->get_result();
            $response['data'] = array();
            foreach ($result as $row) {
                $response['data'][] = $row;
            }

            $response['message'] = "Berhasil mengambil semua records";
            $stmt->close();
            $response['code'] = 0;
        } else {
            $stmt = $conn->prepare('SELECT pantau_pemudik.*, penduduk.nama, pemudik.status_covid19 FROM pantau_pemudik INNER JOIN penduduk ON penduduk.nik = pantau_pemudik.nik INNER JOIN pemudik ON pemudik.nik = pantau_pemudik.nik WHERE pemudik.nik = ?');
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
        $data['tanggal_pantau'] = $_POST['tanggal_pemantauan'];
        $data['suhu_tubuh'] = $_POST['suhu-tubuh'];
        if(isset($_POST['batuk'])) {
            $data['batuk'] = 'ya';
        } else {
            $data['batuk'] ='tidak';
        }
        if(isset($_POST['flu'])) {
            $data['flu'] = 'ya';
        } else {
            $data['flu'] = 'tidak';
        }
        if(isset($_POST['sesak-nafas'])) {
            $data['sesak_nafas'] = 'ya';
        } else {
            $data['sesak_nafas'] = 'tidak';
        }
        $data['keluhan_lain'] = $_POST['keluhan-lain'];


        foreach ($data as $val) {
            if (!isset($val)) {
                $dataLengkap = false;
            } else {
                $dataLengkap = true;
            }
        }
        if ($dataLengkap) {
            $stmt = $conn->prepare("INSERT INTO pantau_pemudik(nik, tanggal_pantau, suhu_tubuh, batuk, flu, sesak_nafas, keluhan_lain) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $data['nik'], $data['tanggal_pantau'], $data['suhu_tubuh'], $data['batuk'], $data['flu'], $data['sesak_nafas'], $data['keluhan_lain']);
            $stmt->execute();
            $stmt->close();

            $response['code'] = 0;
            $response['message'] = "Data berhasil dimasukkan";
        } else {
            $response['code'] = -1;
            $response['message'] = "Data tidak lengkap";
        }
    } elseif ($_GET['action'] === 'delete') {
        if(isset($_GET['nik']) && isset($_GET['tanggal_pantau'])) {
            $stmt = $conn->prepare("DELETE FROM pantau_pemudik WHERE nik = ? AND tanggal_pantau = ?");
            $stmt->bind_param("ss", $_GET['nik'], $_GET['tanggal_pantau']);
            $stmt->execute();
            $stmt->close();
            $response['code'] = 0;
            $response['message'] = "Data penduduk berhasil dihapus berdasarkan nik";
        }
    } else {
        $response['message'] = "Parameter tidak valid";
    }
}
echo json_encode($response);