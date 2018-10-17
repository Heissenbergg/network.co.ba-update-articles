<?php
mb_internal_encoding("8bit");
require_once 'reader.php';
$excel = new Spreadsheet_Excel_Reader();

$filename = 'C:\xampp\htdocs\excel_reader\files\auu.xls';
if(!file_exists($filename)) die('File could not be found.');

$excel-> read('C:\xampp\htdocs\excel_reader\files\auu.xls');    


for($i = 0; $i < $excel->sheets[0]['numRows']; $i++){
    for($j = 0; $j < $excel->sheets[0]['numCols']; $j++){
        $cell = isset($excel->sheets[0]['cells'][$i][$j]) ? $excel->sheets[0]['cells'][$i][$j] : '';
        if($j == 1){
            echo (int)$cell.' <br>';
        }
    }
    
}

$x=1;
/*
while($x<=$excel->sheets[0]['numRows']) {
    $y=1;
    while($y<=$excel->sheets[0]['numCols']) {
        $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
        $y++;
    }  
    $x++;
}*/