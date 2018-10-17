<?php
require_once 'class/db.php';
require_once 'class/user.php';

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new User();
    if($user->login($username, $password)){
        Redirect::to('update.php?what=update');
    }
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login form</title>
        <link rel="stylesheet" href="css/index.css" type="text/css" />
    </head>
    <body>       
        <div id="login_form">
            <div id="login_form_image">
                <img src="images/avatar.png"></img>
            </div>
            <div id="login_form_inputs">
                <form method="post">
                    <input type="text" name="username" placeholder="Your username" autocomplete="off"/>
                    <input type="password" name="password" placeholder="Your password"/>
                    <input id="submit_button" type="submit" value="LOGIN"/>
                </form>
            </div>
        </div>
        
    </body>
</html>