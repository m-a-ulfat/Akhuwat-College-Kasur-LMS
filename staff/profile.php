<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
?>
<!doctype html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
        <?php include "assets/inc/nav.php"; ?>
    <!-- main header end -->

    <!-- main sidebar -->
        <?php include "assets/inc/sidebar.php"; ?>
    <!-- main sidebar end -->
    <?php
    $id = $_SESSION["l_id"];
    $ret = "SELECT * FROM  iL_Librarians WHERE l_id = ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("i", $id);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) {

        //display default profile picture
        if ($row->l_dpic == "") {
            $profile_pic =
                "<img src='../admin/assets/img/avatars/user_icon.png' alt='user avatar'/>";
        } else {
            $profile_pic = "<img src='../admin/assets/img/avatars/librarians/$row->l_dpic' alt='user avatar'/>";
        }

        //use .danger, .warning, .success according to account status
        if ($row->l_acc_status == "Active") {
            $account_status = "<span class='md-list-heading uk-text-success'>$row->l_acc_status</span>";
        } elseif ($row->l_acc_status == "Pending") {
            $account_status = "<span class='md-list-heading uk-text-warning'>$row->l_acc_status</span>";
        } else {
            $account_status = "<span class='md-list-heading uk-text-danger'>$row->l_acc_status</span>";
        }
        ?>
        <div id="page_content">
            <div id="page_content_inner">
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading user_heading_bg" style="background-image: url('assets/img/gallery/Image10.jpg')">
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
                                        <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $row->l_name; ?></span><span class="sub-heading">Librarian @iLibrary</span></h2>
                                        
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
                                    <li class="uk-active"><a href="#"><?php echo $row->l_name; ?> Profile</a></li>
                                    <!--
                                    <li><a href="#">Photos</a></li>
                                    <li><a href="#">Posts</a></li>
                                    -->
                                </ul>
                                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <?php echo $row->l_bio; ?>
                                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Contact And Personal Info</h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->l_email; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Email</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->l_phone; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Phone</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">add_location</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->l_adr; ?></span>
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
                                                            <i class="md-list-addon-icon material-icons">verified_user</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->l_number; ?></span>
                                                            <span class="uk-text-small uk-text-muted">iLibrary Number</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">settings</i>
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
             </div>
         </div>
     </div>
    <?php
    }
    ?>
    <!--Footer-->
    <?php require_once "assets/inc/footer.php"; ?>
    <!--Footer-->



</body>

</html>