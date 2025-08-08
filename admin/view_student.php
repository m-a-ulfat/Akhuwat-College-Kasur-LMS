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

        $student_number = $_GET["student_number"];
        $ret = "SELECT * FROM  iL_Students WHERE s_number = ?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param("s", $student_number);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) {

            if ($row->s_dpic == "") {
                $profile_pic =
                    "<img src='assets/img/avatars/user_icon.png' alt='user avatar'/>";
            } else {
                $profile_pic = "<img src='assets/img/avatars/students/$row->s_dpic' alt='user avatar'/>";
            }
            if ($row->s_acc_status == "Active") {
                $account_status = "<span class='md-list-heading uk-text-success'>$row->s_acc_status</span>";
            } elseif ($row->s_acc_status == "Pending") {
                $account_status = "<span class='md-list-heading uk-text-warning'>$row->s_acc_status</span>";
            } else {
                $account_status = "<span class='md-list-heading uk-text-danger'>$row->s_acc_status</span>";
            }
            ?>
        <div id="page_content">
            <!--Breadcrums-->
            <div id="top_bar hidden-print">
                    <ul id="breadcrumbs">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="#">Students</a></li>
                        <li><a href="manage_student.php">Manage Students</a></li>
                        <li><span><?php echo $row->s_name; ?> Account</span></li>
                    </ul>
                </div>
            <div id="page_content_inner">
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-7-10">
                        <div class="md-card">
                            <div class="user_heading user_heading_bg" style="background-image: url('assets/img/auk.jpg')">
                                <div class="bg_overlay">
                                    <div class="user_heading_menu hidden-print">
                                        <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;</i></div>
                                    </div>
                                    <div class="user_heading_avatar">
                                        <div class="thumbnail">
                                            <?php echo $profile_pic; ?>
                                        </div>
                                    </div>
                                    <div class="user_heading_content">
                                        <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $row->s_name; ?></span><span class="sub-heading">Student @iLibrary</span></h2>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_menu hidden-print">
                                    <div class="uk-display-inline-block" data-uk-dropdown="{pos:'left-top'}">
                                    </div>
                                </div>
                            </div>
                            <div class="user_content">
                                <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                    <li class="uk-active"><a href="#"><?php echo $row->s_name; ?> Profile</a></li>
                                </ul>
                                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <?php echo $row->s_bio; ?>
                                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Contact And Personal Info</h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">&#xE158;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->s_email; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Email</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">&#xE0CD;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->s_phone; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Phone</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">add_location</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->s_adr; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Address</span>
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
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">verified_user</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->s_number; ?></span>
                                                            <span class="uk-text-small uk-text-muted">iLibrary Number</span>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">wc</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <?php echo $row->s_sex; ?>
                                                            <span class="uk-text-small uk-text-muted">Gender</span>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">settings</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <?php echo $account_status; ?>
                                                            <span class="uk-text-small uk-text-muted">Account Status</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-3-10 hidden-print">
                        <div class="md-card">
                            <div class="md-card-content">
                                
                                <h3 class="heading_c uk-margin-bottom">Borrowed Books</h3>
                                <ul class="md-list md-list-addon uk-margin-bottom">
                                    <?php
                                    $student_number = $_GET["student_number"];
                                    $ret =
                                        "SELECT * FROM  iL_LibraryOperations WHERE s_number = ?";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param("s", $student_number);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {

                                        $tsamp = $row->created_at;
                                        if ($row->lo_status == "Returned") {
                                            $opsType = "<span class='uk-text-small uk-text-success uk-text-muted'>$row->lo_status</span>";
                                        } elseif (
                                            $row->lo_status == "Damanged"
                                        ) {
                                            $opsType = "<span class='uk-text-small uk-text-warning uk-text-muted'>$row->lo_status</span>";
                                        } else {
                                            $opsType = "<span class='uk-text-small  uk-text-danger uk-text-muted'>$row->lo_status</span>";
                                        }
                                        ?>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="md-list-heading"><?php echo $row->b_title; ?></span>
                                                <?php echo $opsType; ?>
                                                <span class='uk-text-small uk-text-primary uk-text-muted'>Date Borrowed :
                                                    <?php echo date(
                                                        "d-M-Y",
                                                        strtotime($tsamp)
                                                    ); ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
        ?>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>