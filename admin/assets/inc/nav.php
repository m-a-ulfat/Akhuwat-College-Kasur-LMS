<?php
$id = $_SESSION["id"];
$ret = "SELECT * FROM  iL_sudo  WHERE id = ? ";
$stmt = $mysqli->prepare($ret);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
?>
    <header id="header_main">
            <div class="header_main_content">
                <nav class="uk-navbar">          
                    <div class="uk-navbar-flip">
                        <ul class="uk-navbar-nav user_actions">
                        <li><a href="profile.php">My profile</a></li>
                        <li><a href="settings.php">Settings</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
    </header>