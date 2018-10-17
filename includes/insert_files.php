<?php
require '../class/db.php';

ini_set('max_execution_time', 3000);
ini_set("memory_limit","1024M");

//All files
$count = count($_FILES['file']['name']);


for ($i = 0; $i < $count; $i++) {
    //$ext = pathinfo($_FILES['file']['name'][$i],PATHINFO_EXTENSION);
    //$name = md5($_FILES['file']['name'][$i].time()).'.'.$ext;
    $name = $_FILES['file']['name'][$i];
    if(move_uploaded_file($_FILES['file']['tmp_name'][$i], ''. $name)){
        echo true;
        //chmod("web.xls", 0777);
    }
}