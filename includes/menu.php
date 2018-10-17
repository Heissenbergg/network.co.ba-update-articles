<div id="top_menu">
            <div id="logout">
                <img src="images/power.png"></img>
                    <a href="logout.php">LOGOUT</a>
            </div>
        </div>
        <div id="left_menu">
            <div id="left_menu_image">
                <img src="images/avatar.png"></img>
            </div>
            <div id="user_name">
                <p><?php echo $user->get_name_and_surname(); ?></p>
            </div>
            
            <div id="left_menu_links">
                <div class="left_menu_link <?php if($_GET['what'] == 'update') echo "left_menu_link_superior"; ?>">
                    <img src="images/update.png"></img>
                    <a href="update.php?what=update">Ažurirajte podatke</a>
                </div>
                <div class="left_menu_link <?php if($_GET['what'] == 'history') echo "left_menu_link_superior"; ?>">
                    <img src="images/history.png"></img>
                    <a href="history.php?what=history">Historija</a>
                </div> 
            </div>
        </div>