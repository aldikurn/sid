<?php

// Handling data in JSON format on the server-side using PHP
//header("Content-Type: application/json");
//// build a PHP variable from JSON sent using POST method
//$v = json_decode(stripslashes(file_get_contents("php://input")));
//echo json_encode($v);

// status 0 = ok, 1 = error
$response['status'] = 0;
$response['message'] = '';

if(isset($_POST['submit'])) {
    $target_dir = "../../assets/images/foto-penduduk/";
    $target_file = $target_dir . $_POST['nik'] . '.' . pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
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
            $response['message'] = "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
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
