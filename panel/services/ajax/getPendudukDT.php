<?php
require_once('../DatabaseHelper.php');

$table = 'view_penduduk';
$primaryKey = 'nik';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier - in this case object
// parameter names
$columns = array(
    array(
        'db' => 'nik',
        'dt' => 'DT_RowId',
        'formatter' => function ($d, $row) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_' . $d;
        }
    ),
    array('db' => 'nik', 'dt' => 'nik'),
    array('db' => 'nomor_kk',  'dt' => 'nomor_kk'),
    array('db' => 'nama',   'dt' => 'nama'),
    array('db' => 'jenis_kelamin',     'dt' => 'jenis_kelamin'),
    array('db' => 'tanggal_lahir',   'dt' => 'tanggal_lahir'),
    array('db' => 'tempat_lahir',   'dt' => 'tempat_lahir'),
    array('db' => 'hubungan_dalam_keluarga',   'dt' => 'hubungan_dalam_keluarga'),
    array('db' => 'agama',   'dt' => 'agama'),
    array('db' => 'pendidikan_terakhir',   'dt' => 'pendidikan_terakhir'),
    array('db' => 'pekerjaan',   'dt' => 'pekerjaan'),
    array('db' => 'status_perkawinan',   'dt' => 'status_perkawinan'),
    array('db' => 'nik_ayah',   'dt' => 'nik_ayah'),
    array('db' => 'nama_ayah',   'dt' => 'nama_ayah'),
    array('db' => 'nik_ibu',   'dt' => 'nik_ibu'),
    array('db' => 'nama_ibu',   'dt' => 'nama_ibu'),
    array('db' => 'rt',   'dt' => 'rt'),
    array('db' => 'rw',   'dt' => 'rw'),
    array('db' => 'dusun',   'dt' => 'dusun')
);

$sql_details = array(
    'user' => $databaseHelper->getUser(),
    'pass' => $databaseHelper->getPass(),
    'db'   => $databaseHelper->getDB(),
    'host' => $databaseHelper->getHost()
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require('../ssp.class.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
