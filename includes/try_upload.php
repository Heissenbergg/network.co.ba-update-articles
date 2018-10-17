<?php
require '../class/db.php';
//require_once 'reader.php';

ini_set('max_execution_time', 3000);
ini_set("memory_limit","1024M");

if(isset($_FILES['file']['name'])){
	//All files
	$count = count($_FILES['file']['name']);
	//check if upload went wrong or not
	$uploaded = true;


	for ($i = 0; $i < $count; $i++) {
	    $ext = pathinfo($_FILES['file']['name'][$i],PATHINFO_EXTENSION);
	    //$name = md5($_FILES['file']['name'][$i].time()).'.'.$ext;
	    $name = $_FILES['file']['name'][$i];
	    if(move_uploaded_file($_FILES['file']['tmp_name'][$i], '../files/'. $name)) echo true;  
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form enctype="multipart/form-data" title="Odaberite .xml fajl" method="post">
        <input type="file" id="file" name="file[]" multiple="multiple"> <br>
        <input type="submit" name="Save">
    </form>
</body>
</html>