<?php
require_once '../class/db.php';

$db = new DB();
$last_query = $db->DESCquery("wp1x_posts");
while($last_ = $last_query -> fetch()){
    $last_id = ( $last_['ID'] + 1 );
    break;
}



//$post_author = 1;
//$post_title = "najnoviji artikal";
//$post_excerpt = "This is your short description, we'll about to find it out !!";
//
//
//$comment_status = "closed";
//$guid = "http://www.network.co.ba/?post_type=product&p=".$last_id;
//$post_type = "product";


$post_author = 1;
$post_title = "post titleeeeeeee";
$post_excerpt = "POST EXCERPT";
$guid = "http://www.network.co.ba/?post_type=product&\#038\;p=".$last_id;
$post_type = "product";
$time_insert = date("Y-m-d",time());

$db->action("INSERT into `wp1x_posts` (`post_author`,`post_date`,`post_date_gmt`,`post_title`,`post_excerpt`,`post_modified`, `guid`, `post_type`) VALUES ('{$post_author}','{$time_insert}','{$time_insert}','{$post_title}','{$post_excerpt}', '{$time_insert}','{$guid}', '{$post_type}')");


//$db->action("INSERT into `wp1x_posts` (
//	        											`id`,
//	        											`post_author`,
//	        											`post_title`,
//	        											`post_excerpt`
//	        										  )
//	        				 VALUES (
//	        				 			'{$last_id}',
//	        				 			'{$post_author}',
//	        				 			'{$post_title}',
//	        				 			'{$post_excerpt}'
//	        				 		)");