<?php
require_once '../class/db.php';
$db = new DB();

$one_percent = 1000;
$percent = $_POST['percent']; 

if($percent == 0){
    $end = $one_percent;
}else{
    $end = ($percent + 1) * $one_percent;
}

$counter = 1;


//clear table

$huge_stock_query = $db->query("wp1x_postmeta");
while($huge_stock = $huge_stock_query -> fetch()){
	if($counter >= ($percent * $one_percent) and $counter <= $end){
		if($huge_stock['meta_key'] == '_stock'){
			$id = $huge_stock['post_id'];
			$stock = $huge_stock['meta_value'];
			$db->action("INSERT into `stock` (`post_id`, `in_stock`) VALUES ('{$id}', '{$stock}')");
		}
	}$counter++;
}
echo true;