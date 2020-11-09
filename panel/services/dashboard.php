<?php
include_once('DatabaseHelper.php');

$result = $conn->query('SELECT 
(SELECT COUNT(*) FROM dusun) AS dusun,
(SELECT COUNT(*) FROM penduduk) AS penduduk,
(SELECT COUNT(DISTINCT nomor_kk) FROM penduduk) AS keluarga,
(SELECT COUNT(*) FROM perangkat_desa) AS perangkat_desa	');
$info_desa = $result->fetch_assoc();

$result = $conn->query('SELECT 
(SELECT COUNT(*) FROM pemudik WHERE status_covid19 = "POSITIF") AS positif,
(SELECT COUNT(*) FROM pemudik WHERE status_covid19 = "pdp") AS pdp,
(SELECT COUNT(*) FROM pemudik WHERE status_covid19 = "odp") AS odp,
(SELECT COUNT(*) FROM pemudik WHERE status_covid19 = "odr") AS odr
');
$covid19_desa = $result->fetch_assoc();