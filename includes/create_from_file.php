<?php
require '../class/db.php';
require_once 'reader.php';
ini_set('default_charset', 'utf-8');
//database variable
$db = new DB();

$excel = new Spreadsheet_Excel_Reader();
$excel-> read('web.xls');

$one_percent = 50;
$percent = $_POST['percent']; 

if($percent == 0){
    $end = $one_percent;
}else{
    $end = ($percent + 1) * $one_percent;
}

for($i = 0; $i < $excel->sheets[0]['numRows']; $i++){
    if($i >= ($percent * $one_percent) and $i <= $end){
    	for($j = 0; $j < $excel->sheets[0]['numCols']; $j++){
	        $cell = isset($excel->sheets[0]['cells'][$i][$j]) ? $excel->sheets[0]['cells'][$i][$j] : '';
	        if($j == 1){
	            $post_id = (int)$cell;
	        }else if($j == 3){
	        	$title = $cell;
	        }else if($j == 4){
	        	$desc = $cell;
	        }else if($j == 5){
	        	$prim = $cell;
	        }else if($j == 6){
	        	$sec = $cell;
	        }else if($j == 7){
	        	$vpc = $cell;
	        }else if($j == 8){
	        	$mpc = $cell;
	        }else if($j == 9){
	        	$stock = (int)$cell;
	        }else if($j == 10 and $post_id){
	        	$image = $cell;

	        	$db->action("INSERT into `from_file` (
	        											`code`, 
	        											`title`,
	        											`description`,
	        											`prim`,
	        											`sec`,
	        											`VPC`,
	        											`MPC`,
	        											`stock`,
	        											`image`
	        										  ) 
	        				 VALUES (
	        				 			'{$post_id}',
	        				 			'{$title}',
	        				 			'{$desc}',
	        				 			'{$prim}',
	        				 			'{$sec}',
	        				 			'{$vpc}',
	        				 			'{$mpc}',
	        				 			'{$stock}',
	        				 			'{$image}'
	        				 		)");

	        }

	    }
    }	    
}