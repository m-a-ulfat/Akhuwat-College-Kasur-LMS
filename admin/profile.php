<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
?>
<!doctype html>
<!DOCTYPE html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <?php include "assets/inc/nav.php"; ?>
    <?php
    include "assets/inc/sidebar.php";
    $id = $_SESSION["id"];
    $ret = "SELECT * FROM  iL_sudo  WHERE id = ? ";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) { ?>
       <div>
       <div id="page_content">
            <div id="page_content_inner">
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading user_heading_bg" style="background-image: url('assets/img/gallery/Imag')">
                                <div class="bg_overlay">
                                    <div class="user_heading_menu hidden-print">
                                        <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;     </i></div>
                                    </div>
                                    <div class="user_heading_content">
                                        <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $row->username; ?></span><span class="sub-heading">Administrator Library</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="user_content">
                                <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                    <li class="uk-active"><a href="#">Profile</a></li>
                                </ul>
                                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">&#xE158;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->email; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Email</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary  material-icons">settings_phone</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->phone; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Phone</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom"></h4>
                                                <br>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons uk-text-primary">verified_user</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->number; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Sudo Number</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">&#xe8a6;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->username; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Username</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
    <?php }
    ?>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>