<?php
require '../class/db.php';
//database variable
$db = new DB();

$db->clear_from_file();
$db->clear_stock();