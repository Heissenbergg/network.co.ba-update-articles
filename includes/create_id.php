<?php
require_once '../class/db.php';
$db = new DB();

$_SESSION['hash'] = time();

function getMonth($m){
	if($m == 1) return 'Januar';
	else if($m == 2) return 'Februar';
	else if($m == 3) return 'Martt';
	else if($m == 4) return 'April';
	else if($m == 5) return 'Maj';
	else if($m == 6) return 'Juni';
	else if($m == 7) return 'Juli';
	else if($m == 8) return 'August';
	else if($m == 9) return 'Septembar';
	else if($m == 10) return 'Oktobar';
	else if($m == 11) return 'Novembar';
	else if($m == 12) return 'Decembar';
}

$hash = $_SESSION['hash'];
$day = date('d');
$month = getMonth(date('m'));
$year = date('Y');

$time = date('G').':'.date('i');

$db->action("INSERT into `history_main` (`hash`, `d`, `m`, `y`, `time`)
			 VALUES ('{$hash}', '{$day}', '{$month}', '{$year}', '{$time}')");

$post_query = $db->query("wp1x_posts");
while($post = $post_query -> fetch()){
	$id = $post['ID'];
	$post_excerpt = $post['post_excerpt'];
	if(strlen($post_excerpt) >= 5){
		$new_id = 0;

		for($i = 0; $i < 5; $i++){
			$new_id *= 10;
			$new_id += (ord($post_excerpt[$i]) - 48);
		}
		$db->action("UPDATE `wp1x_posts` SET `post_ids` = '{$new_id}' WHERE ID = '$id'");
		echo $new_id.'<br> <br>';
	} 
}