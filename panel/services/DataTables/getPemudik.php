<?php
require_once('../DatabaseHelper.php');

$table = 'view_pemudik';
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
    array('db' => 'nama',   'dt' => 'nama'),
    array('db' => 'asal',   'dt' => 'asal'),
    array('db' => 'tujuan',     'dt' => 'tujuan'),
    array('db' => 'durasi',   'dt' => 'durasi'),
    array('db' => 'status_covid19',   'dt' => 'status_covid19'),
    array('db' => 'wajib_pantau',   'dt' => 'wajib_pantau'),
    array('db' => 'keluhan_kesehatan',   'dt' => 'keluhan_kesehatan'),
    array('db' => 'tanggal_tiba',   'dt' => 'tanggal_tiba')
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
