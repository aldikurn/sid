<?php
include_once('DatabaseHelper.php');

$result = $conn->query('SELECT * FROM identitas_desa WHERE id = 1');
$info_desa = $result->fetch_assoc();