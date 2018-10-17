<?php
require_once 'class/db.php';
require_once 'class/user.php';
if(!Session::existUsername()) Redirect::to('index.php');
$user = new User(Session::getUsername());

$db = new DB();
$main_query = $db->query("history_main");
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
			</div>
            <script type="application/javascript">
                var chart2 = new CircleChart();
                chart2.setColors('#e5eaf1', '#4c709d');
                chart2.init("CircleChart_2", 0);
            </script>

            <div id="control_body_header">
                <h4>Historija ažuriranja</h4>
            </div>
            <div id="content_of_body">
                <div id="table_of_updated" style="display: block;">
                    <?php 
                    while($main = $main_query -> fetch()){
                        ?>
                        <div class="date_of_update">
                            <p><?php echo $main['d'].'. '.$main['m'].' '.$main['y'].'. '.$main['time'].'h.'; ?></p>
                        </div>
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
                        <?php
                        $second_query = $db->query("history_table");
                        while($second = $second_query -> fetch()){
                            if($main['hash'] == $second['hash']){
                                ?>
                                <div class="table_row table_row_second">
                                    <div class="post_value post_num post_num2">
                                        <p><?php echo $second['post_id']; ?></p>
                                    </div>
                                    <div class="post_value post_title post_title2">
                                        <p><?php echo $second['post_title']; ?></p>
                                    </div>
                                    <div class="post_value post_before post_before2">
                                        <p><?php echo $second['post_before']; ?></p>
                                    </div>
                                    <div class="post_value post_after post_before2">
                                        <p><?php echo $second['post_after']; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
</body>
</html>