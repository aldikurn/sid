<?php

// Handling data in JSON format on the server-side using PHP
//header("Content-Type: application/json");
//// build a PHP variable from JSON sent using POST method
//$v = json_decode(stripslashes(file_get_contents("php://input")));
//echo json_encode($v);

include_once('../DatabaseHelper.php');

$dataLengkap =
    isset($_POST['nik']) &&
    isset($_POST['nomor_kk']) &&
    isset($_POST['nama']) &&
    isset($_POST['jenis_kelamin']) &&
    isset($_POST['tanggal_lahir']) &&
    isset($_POST['tempat_lahir']) &&
    isset($_POST['hubungan_dalam_keluarga']) &&
    isset($_POST['agama']) &&
    isset($_POST['pendidikan_terakhir']) &&
    isset($_POST['pekerjaan']) &&
    isset($_POST['status_perkawinan']) &&
    isset($_POST['id_rt'])
;


$data = new stdClass();

$data->nik = $_POST['nik'];
$data->nomor_kk = $_POST['nomor_kk'];
$data->nama = $_POST['nama'];
$data->jenis_kelamin = $_POST['jenis_kelamin'];
$data->tanggal_lahir = $_POST['tanggal_lahir'];
$data->tempat_lahir = $_POST['tempat_lahir'];
$data->hubungan_dalam_keluarga = $_POST['hubungan_dalam_keluarga'];
$data->agama = $_POST['agama'];
$data->pendidikan_terakhir = $_POST['pendidikan_terakhir'];
$data->pekerjaan = $_POST['pekerjaan'];
$data->status_perkawinan = $_POST['status_perkawinan'];
$data->id_rt = $_POST['rt'];

$dataLengkap = true;

foreach($data as $val) :
    if(!isset($val)) {
        $dataLengkap = false;
    }
endforeach;
$data->nik_ayah = $_POST['nik_ayah'];
$data->nama_ayah = $_POST['nama_ayah'];
$data->nik_ibu = $_POST['nik_ibu'];
$data->nama_ibu = $_POST['nama_ibu'];


// status 0 = ok, 1 = error
$response['status'] = 0;
$response['message'] = '';

//upload file
if($dataLengkap) {

    $query = 'INSERT INTO penduduk(nik, nomor_kk, nama, id_jenis_kelamin, tanggal_lahir, tempat_lahir, id_hubungan_dalam_keluarga, id_agama, id_pendidikan_terakhir, id_pekerjaan, id_status_perkawinan, nik_ayah, nama_ayah, nik_ibu, nama_ibu, id_rt) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = mysqli_prepare($databaseHelper->getConnection(), $query);
    mysqli_stmt_bind_param($stmt, "sssissiiiiissssi", $data->nik, $data->nomor_kk, $data->nama, $data->jenis_kelamin, $data->tanggal_lahir, $data->tempat_lahir, $data->hubungan_dalam_keluarga, $data->agama, $data->pendidikan_terakhir, $data->pekerjaan, $data->status_perkawinan, $data->nik_ayah, $data->nama_ayah, $data->nik_ibu, $data->nama_ibu, $data->id_rt);
    $stmt->execute();
    $stmt->close();

    $target_dir = "../../assets/images/foto-penduduk/";
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
            $response['status'] = 1;
            $response['message'] = "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["foto"]["size"] > 500000) {
        $response['status'] = 1;
        $response['message'] =  "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $response['status'] = 1;
        $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response['status'] = 1;
        $response['message'] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $response['status'] = 0;
            //$response['message'] = "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
        } else {
            $response['status'] = 1;
            $response['message'] = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $response['status'] = 1;
    $response['message'] .= ' data tidak lengkap';
}

echo json_encode($response);
