<?php
include_once('DatabaseHelper.php');

$response['code'] = -1;
$response['message'] = 'Terjadi kesalahan';

if(isset($_GET['action'])) {
    if($_GET['action'] === 'select') {
        $result = $conn->query('SELECT * FROM identitas_desa WHERE id=1');
        $response['data'] = $result->fetch_assoc();

        $logo_path = '../assets/images/logo-desa/logo-desa.png';
        $type = pathinfo($logo_path, PATHINFO_EXTENSION);
        $data = file_get_contents($logo_path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $response['data']['logo'] = $base64;

        $response['code'] = 0;
        $response['message'] = "Berhasil mengambil identitas desa";
    } else if($_GET['action'] === 'update') {
        $stmt = $conn->prepare("UPDATE identitas_desa SET nama = ?, kode_pos = ?, alamat_kantor = ?, email = ?, telepon = ?, kecamatan = ?, kabupaten = ?, provinsi = ? WHERE id=1");
        $stmt->bind_param('ssssssss', $_POST['nama'], $_POST['kode_pos'], $_POST['alamat-kantor'], $_POST['email'], $_POST['telepon'], $_POST['kecamatan'], $_POST['kabupaten'], $_POST['provinsi']);
        $stmt->execute();
        $stmt->close();

        $response['code'] = 0;
        $response['message'] = "Berhasil mengubah identitas desa";
    } else if($_GET['action'] === 'upload_logo') {
        
        if(isset($_FILES['logo-desa']['tmp_name'])) {
            $target_dir = "../assets/images/logo-desa/";
            $target_file = $target_dir . 'logo-desa.png';
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is a actual image or fake image
            if (isset($_POST)) {
                $check = getimagesize($_FILES["logo-desa"]["tmp_name"]);
                if ($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $response['code'] = 0;
                    $uploadOk = 1;
                } else {
                    $response['code'] = -1;
                    $response['message'] = "File is not an image.";
                    $uploadOk = 0;
                }
            }
            if ($_FILES["logo-desa"]["size"] > 500000) {
                $response['code'] = -1;
                $response['message'] =  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                $response['code'] = -1;
                $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $response['code'] = -1;
                $response['message'] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["logo-desa"]["tmp_name"], $target_file)) {
                    $response['code'] = 0;
                    //$response['message'] = "The file " . htmlspecialchars(basename($_FILES["logo-desa"]["name"])) . " has been uploaded.";
                } else {
                    $response['code'] = -1;
                    $response['message'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $response['code'] = 0;
        $response['message'] = "Berhasil upload logo desa";
    }
}

echo json_encode($response);