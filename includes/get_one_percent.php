<?php
require '../class/db.php';
require_once 'reader.php';

$db = new DB();
$dbQuery = $db->query("from_file");

$counter = 0;
while($article = $dbQuery -> fetch()){
	$counter++;
}


echo (ceil(($counter / 100)));

/*$excel = new Spreadsheet_Excel_Reader();
$excel-> read('web.xls'); 

$excel->sheets[0]['numRows'];
echo (ceil(($excel->sheets[0]['numRows'] / 100))); */