<?php
require_once 'class/db.php';
require_once 'class/user.php';
if(!Session::existUsername()) Redirect::to('index.php');
$user = new User(Session::getUsername());
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Database</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/update.css">

    <!-- loading bar -->
    <script src="js/CircleChart.js" type="application/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<?php require_once 'includes/menu.php'; ?>

	<div id="control_body">
			<div id="loading_part">
				<canvas id="CircleChart_2">Some text here...</canvas>
                <div id="additional_options">
                    <!--<div class="show_user">
                        <p>Datoteka uspješno spremljena </p>
                    </div> -->
                    <!-- <div class="show_user" id="progres_bar">
                        <p id="percent_number">Progres [ 12% ]</p>
                        <p id="open"> [ </p>
                        <div id="progress">
                            <div id="final_progress"></div>
                        </div>
                        <p id="closed"> ] </p>
                    </div> -->
                </div>
			</div>
            <script type="application/javascript">
                var chart2 = new CircleChart();
                chart2.setColors('#e5eaf1', '#4c709d');
                chart2.init("CircleChart_2", 0);
            </script>

            <div id="control_body_header">
                <h4>Ažuriranje podataka</h4>
            </div>
            <div id="content_of_body">
                <div id="update_files">
                	<img src="images/update_huge.png">
                	<form enctype="multipart/form-data" title="Odaberite .xml fajl">
		                <label for="file">
		                    <div id="update_button">
		                		<p>ODABERITE DATOTEKU</p>
		                	</div>
		                </label>
		                <input type="file" onchange="upload_files();" id="file" name="file[]" multiple="multiple"  style="display: none;">
		            </form>
                </div>
                
                <div id="table_of_updated">
                	 
                	<div class="table_row">
                		<div class="post_value post_num">
                			<p>#</p>
                		</div>
                		<div class="post_value post_title">
                			<p>NAZIV ARTIKLA</p>
                		</div>
                		<div class="post_value post_before">
                			<p>PRETHODNO STANJE</p>
                		</div>
                		<div class="post_value post_after">
                			<p>NOVO STANJE</p>
                		</div>
                	</div>
                    <!--
                	<div class="table_row table_row_second">
                		<div class="post_value post_title">
                			<p>NAZIV ARTIKLA</p>
                		</div>
                		<div class="post_value post_before">
                			<p>PRETHODNO STANJE</p>
                		</div>
                		<div class="post_value post_after">
                			<p>NOVO STANJE</p>
                		</div>
                	</div> 
                	-->
                </div>
            </div>
        </div>
</body>
</html>