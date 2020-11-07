<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://data.covid19.go.id/public/api/update.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

$data = json_decode($data);

$data = array_filter($data->update->harian, 'getLast30Day');
$newData = array();

foreach ($data as $key => $value) :
    array_push($newData, array(
        'date' => date('Y-m-d', strtotime($value->key_as_string)),
        'Meninggal' => $value->jumlah_meninggal->value,
        'Positif' => $value->jumlah_positif->value,
        'Sembuh' => $value->jumlah_sembuh->value

    ));
endforeach;

toCsv($newData);

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

function getLast30Day($var)
{
    return $var->key_as_string > date('Y-m-d', strtotime('-30 days'));
}


