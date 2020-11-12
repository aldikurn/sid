<?php
require_once('../DatabaseHelper.php');

$table = 'view_keluarga';
$primaryKey = 'nomor_kk';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier - in this case object
// parameter names
$columns = array(
    array(
        'db' => 'nomor_kk',
        'dt' => 'DT_RowId',
        'formatter' => function ($d, $row) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_' . $d;
        }
    ),
    array('db' => 'nomor_kk', 'dt' => 'nomor_kk'),
    array('db' => 'nik_kepala_keluarga',   'dt' => 'nik_kepala_keluarga'),
    array('db' => 'nama_kepala_keluarga',   'dt' => 'nama_kepala_keluarga'),
    array('db' => 'jumlah_anggota',     'dt' => 'jumlah_anggota'),
    array('db' => 'dusun',   'dt' => 'dusun'),
    array('db' => 'nomor_rw',   'dt' => 'rw'),
    array('db' => 'nomor_rt',   'dt' => 'rt')
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
