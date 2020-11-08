<?php
include_once('DatabaseHelper.php');
$response['code'] = -1;
$response['message'] = "Terjadi kesalahan";
$response['data'] = null;

if (isset($_GET['action']) && isset($_GET['nik'])) {

    if ($_GET['action'] === 'select') {
        if ($_GET['nik'] == 'all')  {
            $stmt = $conn->prepare("SELECT * FROM penduduk");
            $stmt->execute();
            $result = $stmt->get_result();
            $response['data'] = array();
            foreach ($result as $row) {
                $response['data'][] = $row;
            }

            $stmt->close();
            $response['code'] = 0;
            $response['message'] = "Berhasil mengambil semua records";;
        } else {
            $stmt = $conn->prepare('SELECT penduduk.*, rw.id as id_rw, dusun.id as id_dusun FROM penduduk INNER JOIN rt ON rt.id = penduduk.id_rt INNER JOIN rw ON rw.id = rt.id_rw INNER JOIN dusun ON dusun.id = rw.id_dusun WHERE penduduk.nik = ?');
            $stmt->bind_param("s", $_GET['nik']);
            $stmt->execute();
            $result = $stmt->get_result();

            foreach ($result as $row) {
                $response['data'] = $row;
            }
            $foto_path = glob('../assets/images/foto-penduduk/' . $response['data']['nik'] . '*');
            $temp = null;
            foreach($foto_path as $var) {
                $type = pathinfo($var, PATHINFO_EXTENSION);
                $data = file_get_contents($var);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $temp = $base64;
            }
            if($temp != null) {
                $response['data']['foto'] = $temp;
            }
            $stmt->close();
            $response['code'] = 0;
            $response['message'] = "Berhasil mengambil record penduduk berdasarkan nik";
        };
    } elseif ($_GET['action'] === 'insert') {
        $dataLengkap = false;
        $data = array();

        $data['nik'] = $_POST['nik'];
        $data['nomor_kk'] = $_POST['nomor_kk'];
        $data['nama'] = $_POST['nama'];
        $data['jenis_kelamin'] = $_POST['jenis_kelamin'];
        $data['tanggal_lahir'] = $_POST['tanggal_lahir'];
        $data['tempat_lahir'] = $_POST['tempat_lahir'];
        $data['hubungan_dalam_keluarga'] = $_POST['hubungan_dalam_keluarga'];
        $data['agama'] = $_POST['agama'];
        $data['pendidikan_terakhir'] = $_POST['pendidikan_terakhir'];
        $data['pekerjaan'] = $_POST['pekerjaan'];
        $data['status_perkawinan'] = $_POST['status_perkawinan'];
        $data['status_penduduk'] = $_POST['status_penduduk'];
        $data['id_rt'] = $_POST['rt'];

        foreach ($data as $val) {
            if (!isset($val)) {
                $dataLengkap = false;
            } else {
                $dataLengkap = true;
            }
        }

        if ($dataLengkap) {
            $data['nik_ayah'] = $_POST['nik_ayah'];
            $data['nama_ayah'] = $_POST['nama_ayah'];
            $data['nik_ibu'] = $_POST['nik_ibu'];
            $data['nama_ibu'] = $_POST['nama_ibu'];

            $stmt = $conn->prepare("INSERT INTO penduduk(nik, nomor_kk, nama, id_jenis_kelamin, tanggal_lahir, tempat_lahir, id_hubungan_dalam_keluarga, id_agama, id_pendidikan_terakhir, id_pekerjaan, id_status_perkawinan, id_status_penduduk, nik_ayah, nama_ayah, nik_ibu, nama_ibu, id_rt) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssissiiiiissssi", $data['nik'], $data['nomor_kk'], $data['nama'], $data['jenis_kelamin'], $data['tanggal_lahir'], $data['tempat_lahir'], $data['hubungan_dalam_keluarga'], $data['agama'], $data['pendidikan_terakhir'], $data['pekerjaan'], $data['status_perkawinan'], $data['status_penduduk'], $data['nik_ayah'], $data['nama_ayah'], $data['nik_ibu'], $data['nama_ibu'], $data['id_rt']);
            $stmt->execute();
            $stmt->close();
            upload_images();

            $response['code'] = 0;
            $response['message'] = "Data berhasil dimasukkan";
        } else {
            $response['code'] = -1;
            $response['message'] = "Data tidak lengkap";
        }
    } elseif ($_GET['action'] === 'update') {
        $stmt = $conn->prepare('SELECT * FROM penduduk WHERE penduduk.nik = ?');
        $stmt->bind_param("s", $_GET['nik']);
        $stmt->execute();
        $result = $stmt->get_result();
        $old = null;
        foreach ($result as $row) {
            $old = $row;
        }
        $stmt->close();

        $changed = array();

        if($old['nik'] != $_POST['nik']) {
            $changed['nik'] = $_POST['nik'];
        }
        if($old['nomor_kk'] != $_POST['nomor_kk']) {
            $changed['nomor_kk'] = $_POST['nomor_kk'];
        }
        if($old['nama'] !== $_POST['nama']) {
            $changed['nama'] = $_POST['nama'];
        }
        if($old['id_jenis_kelamin'] != $_POST['jenis_kelamin']) {
            $changed['id_jenis_kelamin'] = $_POST['jenis_kelamin'];
        }
        if($old['tanggal_lahir'] != $_POST['tanggal_lahir']) {
            $changed['tanggal_lahir'] = $_POST['tanggal_lahir'];
        }
        if($old['tempat_lahir'] != $_POST['tempat_lahir']) {
            $changed['tempat_lahir'] = $_POST['tempat_lahir'];
        }
        if($old['id_hubungan_dalam_keluarga'] != $_POST['hubungan_dalam_keluarga']) {
            $changed['id_hubungan_dalam_keluarga'] = $_POST['hubungan_dalam_keluarga'];
        }
        if($old['id_agama'] != $_POST['agama']) {
            $changed['agama'] = $_POST['agama'];
        }
        if($old['id_pendidikan_terakhir'] != $_POST['pendidikan_terakhir']) {
            $changed['id_pendidikan_terakhir'] = $_POST['pendidikan_terakhir'];
        }
        if($old['id_pekerjaan'] != $_POST['pekerjaan']) {
            $changed['id_pekerjaan'] = $_POST['pekerjaan'];
        }
        if($old['id_status_perkawinan'] != $_POST['status_perkawinan']) {
            $changed['id_status_perkawinan'] = $_POST['status_perkawinan'];
        }
        if($old['id_status_penduduk'] != $_POST['status_penduduk']) {
            $changed['id_status_penduduk'] = $_POST['status_penduduk'];
        }
        if($old['nik_ayah'] != $_POST['nik_ayah']) {
            $changed['nik_ayah'] = $_POST['nik_ayah'];
        }
        if($old['nama_ayah'] != $_POST['nama_ayah']) {
            $changed['nama_ayah'] = $_POST['nama_ayah'];
        }
        if($old['nik_ibu'] != $_POST['nik_ibu']) {
            $changed['nik_ibu'] = $_POST['nik_ibu'];
        }
        if($old['nama_ibu'] != $_POST['nama_ibu']) {
            $changed['nama_ibu'] = $_POST['nama_ibu'];
        }
        if($old['id_rt'] != $_POST['rt']) {
            $changed['id_rt'] = $_POST['rt'];
        }

        $upload_no_foto = ($_FILES['foto']['name'] == '') OR ($_FILES['foto']['size'] == 0);

        if(count($changed) > 0 || !$upload_no_foto) {
            $response['code'] = 0;
            $response['data'] = $changed;

            $len = count($changed);
            $i = 0;
            $query = "UPDATE penduduk SET ";
            foreach ($changed as $key => $value) {
                if($i < ($len - 1)) {
                    $query .= $key . ' = "' . $value . '", ';
                } else {
                    $query .= $key . ' = "' . $value . '" WHERE nik="' . $old['nik'] . '"';
                }
                $i++;
            }

            $result = $conn->query($query);

            if (!$upload_no_foto) {
                array_map('unlink', glob('../assets/images/foto-penduduk/' . $old['nik'] . '*'));
                upload_images();
            }

            $response['code'] = 0;
            $response['message'] = "Data berhasil diedit berdasarkan nik";
        } else {
            $response['code'] = -1;
            $response['data'] = $changed;
            $response['message'] = "Tidak ada perubahan data";
        }
    } elseif ($_GET['action'] === 'delete') {
        $stmt = $conn->prepare("DELETE FROM penduduk WHERE nik = ?");
        $stmt->bind_param("s", $_GET['nik']);
        $stmt->execute();
        $stmt->close();
        array_map('unlink', glob('../assets/images/foto-penduduk/' . $_GET['nik'] . '*'));
        $response['code'] = 0;
        $response['message'] = "Data penduduk berhasil dihapus berdasarkan nik";
    }

} else {
    $response['message'] = "Parameter tidak valid";
}

echo json_encode($response);

function upload_images() {
    if(isset($_FILES['foto']['tmp_name'])) {
        $target_dir = "../assets/images/foto-penduduk/";
        $target_file = $target_dir . $_POST['nik'] . '.' . pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST)) {
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $response['status'] = 0;
                $uploadOk = 1;
            } else {
                $response['status'] = -1;
                $response['message'] = "File is not an image.";
                $uploadOk = 0;
            }
        }
        if ($_FILES["foto"]["size"] > 500000) {
            $response['status'] = -1;
            $response['message'] =  "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $response['status'] = -1;
            $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $response['status'] = -1;
            $response['message'] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $response['status'] = 0;
                //$response['message'] = "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
            } else {
                $response['status'] = -1;
                $response['message'] = "Sorry, there was an error uploading your file.";
            }
        }
    }
}