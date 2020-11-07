<?php
include_once('../DatabaseHelper.php');
$result = $conn->query("SELECT dt_pekerjaan.nama AS pekerjaan, COUNT(penduduk.id_pekerjaan) AS jumlah FROM penduduk INNER JOIN dt_pekerjaan ON dt_pekerjaan.id = penduduk.id_pekerjaan GROUP BY penduduk.id_pekerjaan");
$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['pekerjaan'],
        'y' =>  intval($row['jumlah'])
    ));
}
echo json_encode($data);
//toCsv($result);

function toCsv ($json) {
    if (empty($json)) {
        die("The JSON string is empty!");
    }

    $fileName = 'data-' . date("Y-m-d") . ".csv";
    $f = fopen($fileName,"w+");

    $firstLineKeys = false;
    foreach ($json as $line) {
        if (empty($firstLineKeys)) {
            $firstLineKeys = array_keys($line);
            fputcsv($f, $firstLineKeys);
            $firstLineKeys = array_flip($firstLineKeys);
        }

        fputcsv($f, array_merge($firstLineKeys, $line));
    }
    fclose($f);

    if (file_exists($fileName)) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.basename($fileName));
        header('Content-Length: ' . filesize($fileName));
        readfile($fileName);
    }

    unlink($fileName);
}

