<?php
require_once('../DatabaseHelper.php');

$table = 'view_pantau_pemudik';
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier - in this case object
// parameter names
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function ($d, $row) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_' . $d;
        }
    ),
    array('db' => 'tanggal_tiba',   'dt' => 'tanggal_tiba'),
    array('db' => 'tanggal_pantau',   'dt' => 'tanggal_pantau'),
    array('db' => 'data_hari_ke',   'dt' => 'data_hari_ke'),
    array('db' => 'nik', 'dt' => 'nik'),
    array('db' => 'nama',   'dt' => 'nama'),
    array('db' => 'suhu_tubuh',     'dt' => 'suhu_tubuh'),
    array('db' => 'batuk',   'dt' => 'batuk'),
    array('db' => 'flu',   'dt' => 'flu'),
    array('db' => 'sesak_nafas',   'dt' => 'sesak_nafas'),
    array('db' => 'keluhan_lain',   'dt' => 'keluhan_lain'),
    array('db' => 'status_covid19',   'dt' => 'status_covid19')
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
