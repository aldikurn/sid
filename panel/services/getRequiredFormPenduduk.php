<?php
include_once('DatabaseHelper.php');

$result = mysqli_query($databaseHelper->getConnection(), 'SELECT * FROM dt_jenis_kelamin');
$jenis_kelamin = array();
foreach($result as $row) {
    $jenis_kelamin[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT *  FROM dt_hubungan_dalam_keluarga");
$hubungan_dalam_keluarga = array();
foreach($result as $row) {
    $hubungan_dalam_keluarga[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM dt_agama");
$agama = array();
foreach($result as $row) {
    $agama[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM dt_pendidikan_terakhir");
$pendidikan_terakhir = array();
foreach($result as $row) {
    $pendidikan_terakhir[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM dt_pekerjaan");
$pekerjaan = array();
foreach($result as $row) {
    $pekerjaan[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM dt_status_perkawinan");
$status_perkawinan = array();
foreach($result as $row) {
    $status_perkawinan[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM dusun");
$dusun = array();
foreach($result as $row) {
    $dusun[] = array(
        'id' => $row['id'],
        'nama' => $row['nama']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM rw");
$rw = array();
foreach($result as $row) {
    $rw[] = array(
        'id' => $row['id'],
        'id_dusun' => $row['id_dusun'],
        'nomor' => $row['nomor']
    );
}

$result = mysqli_query($databaseHelper->getConnection(), "SELECT * FROM rt");
$rt = array();
foreach($result as $row) {
    $rt[] = array(
        'id' => $row['id'],
        'id_rw' => $row['id_rw'],
        'nomor' => $row['nomor']
    );
};
