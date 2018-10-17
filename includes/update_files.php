<?php
require '../class/db.php';
require_once 'reader.php';

//error_reporting(E_ALL); // or E_STRICT
ini_set('max_execution_time', 30);
//ini_set("display_errors",1);
ini_set("memory_limit","1024M");

//$percent = $_POST['percent'];
//$one_percent = $_POST['one_percent'];

$percent = 0;
$one_percent = 26;

//database variable
$db = new DB();

$excel = new Spreadsheet_Excel_Reader();
$excel-> read('web.xls'); 
//echo '<div class="table_row"><div class="post_value post_num"><p>#</p></div><div class="post_value post_title"><p>NAZIV ARTIKLA</p></div><div class="post_value post_before"><p>PRETHODNO STANJE</p></div><div class="post_value post_after"><p>NOVO STANJE</p></div></div>';

//number of changed articles

$cunter = 1;
if( ($percent * $one_percent ) > $excel->sheets[0]['numRows']){
    $end = $excel->sheets[0]['numRows'];
}else if($percent == 0){
    $end = $one_percent;
}else{
    $end = ($percent + 1) * $one_percent;
}


for($i = ($percent * $one_percent); $i < $end; $i++){
    for($j = 0; $j < $excel->sheets[0]['numCols']; $j++){
        $cell = isset($excel->sheets[0]['cells'][$i][$j]) ? $excel->sheets[0]['cells'][$i][$j] : '';
        if($j == 1){
            $post_id = (int)$cell;
        }else if($j == 9){
        	
        	$posts_query = $db->query("wp1x_posts");
            while($post = $posts_query -> fetch()){
                
            	if($post['post_ids'] == $post_id){
            		$stock_query = $db->query("stock");
            		while($stock =  $stock_query -> fetch()){
            		    
            			if($stock['id'] == $post['ID']){
            				if($stock['in_stock'] != (int)$cell){
                                
                                ?>
                                <div class="table_row table_row_second">
                                    <div class="post_value post_num">
                                        <p><?php echo $cunter++; ?></p>
                                    </div>
                                    <div class="post_value post_title">
                                        <p><?php echo $post['post_title']; ?></p>
                                    </div>
                                    <div class="post_value post_before">
                                        <p><?php echo $stock['in_stock']; ?></p>
                                    </div>
                                    <div class="post_value post_after">
                                        <p><?php echo $cell; ?></p>
                                    </div>
                                </div>
                                <?php
                                
                            }
        			    } 
            		}
            	} 
            }
            
            
            
            echo $cell;
        	echo '<br><br><br><br>';
        }
    }
    
}