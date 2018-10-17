<?php
require '../class/db.php';
require_once 'reader.php';

//error_reporting(E_ALL); // or E_STRICT
ini_set('max_execution_time', 90);
//ini_set("display_errors",1);
ini_set("memory_limit","1024M");

$percent = $_POST['percent'];
$one_percent = $_POST['one_percent'];

//database variable
$db = new DB();

//number of changed articles

$counter = 1; $newCounter = 1;
if($percent == 0){
    $end = $one_percent;
}else{
    $end = ($percent + 1) * $one_percent;
}

$count = 1;

//iterate through database - read data from file (copied data from file to table from_file)
$from_file_query = $db->query("from_file");
while($from_file = $from_file_query -> fetch()){
    if($counter >= ($percent * $one_percent) and $counter <= $end){
        //find id of post via code
        $posts_query = $db->query("wp1x_posts");    
        while($post = $posts_query -> fetch()){
            if($from_file['code'] == $post['post_ids']){
                //find stock value from copied table 
                $stock_query = $db->query("stock");
                while($stock = $stock_query -> fetch()){
                    if($stock['post_id'] == $post['ID']){
                        if($stock['in_stock'] != $from_file['stock']){
                            $id = $post['ID'];
                            $meta_key = '_stock';

                            $_hash = $_SESSION['hash'];
                            $_post_ajdi = $post['ID'].' ('.$from_file['code'].')';
                            $_post_title = $post['post_title'];
                            $_bef = $stock['in_stock'];
                            $_aft = $from_file['stock'];
                            $db->action("INSERT into `history_table` (`hash`, `post_id`, `post_title`, `post_before`, `post_after`) 
                                         VALUES ('{$_hash}', '{$_post_ajdi}', '{$_post_title}', '{$_bef}', '{$_aft}')");

                            ?>
                            <div class="table_row table_row_second">
                                <div class="post_value post_num post_num2">
                                    <p><?php echo $post['ID'].' ('.$from_file['code'].')'; ?></p>
                                </div>
                                <div class="post_value post_title post_title2">
                                    <p><?php echo $post['post_title']; ?></p>
                                </div>
                                <div class="post_value post_before post_before2">
                                    <p><?php echo $stock['in_stock']; ?></p>
                                </div>
                                <div class="post_value post_after post_before2">
                                    <p><?php echo $from_file['stock']; ?></p>
                                </div>
                            </div>

                            <?php

                            $db->action("UPDATE `wp1x_postmeta` SET `meta_value` = '{$_aft}' WHERE post_id = '$id' AND meta_key = '$meta_key'");
                        }else{

                        }
                    }
                }
            }
        }
    }$counter ++;
}

