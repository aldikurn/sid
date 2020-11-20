<?php
include_once('../DatabaseHelper.php');

$result = $conn->query("
    WITH 
        umur AS 
        (
            SELECT
                nik,
                (SELECT TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE())) AS umur
            FROM penduduk
        ),
        kategori AS 
        (
            SELECT 
                nik,
                (
                    CASE
                        WHEN umur.umur <= 5 THEN 'Balita (0 - 5)'
                        WHEN umur.umur <= 12 THEN 'Anak-Anak (6 -11)'
                        WHEN umur.umur <= 17 THEN 'Remaja (12 - 17)'
                        WHEN umur.umur <= 50 THEN 'Dewasa (18 - 50)'
                        WHEN umur.umur > 50 THEN 'Lansia (> 50)'
                    END
                ) AS kategori
            FROM umur
        )
    SELECT
        kategori.kategori,
        COUNT(*) jumlah
    FROM umur
    INNER JOIN kategori
        ON kategori.nik = umur.nik
    GROUP BY kategori.kategori
");

$data = array();
foreach($result as $row) {
    array_push($data, array(
        'name' => $row['kategori'],
        'y' =>  intval($row['jumlah'])
    ));
}

echo json_encode($data);