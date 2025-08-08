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
    $operationChecksum = $_GET["operationChecksum"];
    $ret = "SELECT * FROM  iL_LibraryOperations WHERE lo_checksum = ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("s", $operationChecksum);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) {

        //trim timestamp to DD/MM/YYY
        $tsamp = $row->created_at;
        //assign .success .danger .warning classes to  operation type
        if ($row->lo_status == "Returned") {
            $opsType = "<span class='uk-badge-success'>$row->lo_status</span>";
        } elseif ($row->lo_status == "Damanged") {
            $opsType = "<span class='uk-badge-warning'>$row->lo_status</span>";
        } elseif ($row->lo_status == "Lost") {
            $opsType = "<span class='uk-badge-danger'>$row->lo_status</span>";
        } else {
            $opsType = "<span class='uk-badge-primary'>Pending Return</span>";
        }
        ?>
        <div id="page_content">
            <!--Breadcrums-->
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Library Operations</a></li>
                    <li><a href="manage_library_operations.php">Manage Library Operations</a></li>
                    <li><span>View <?php echo $row->lo_number; ?> </span></li>
                </ul>
            </div>
            <div id="page_content_inner">
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading user_heading_bg" style="background-image: url('../admin/assets/img/gallery/Image10.jpg')">
                                <div class="bg_overlay">
                                    <div class="user_heading_menu hidden-print">
                                        <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;</i></div>
                                    </div>
                                    <div class="user_heading_content">
                                        <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate  ">Library Operation Borrowed Book Status: <?php echo $opsType; ?> </span><span class="sub-heading"></span></h2>
                                        
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
                                    <li class="uk-active"><a href="#">Library Operation <?php echo $row->lo_number; ?> Description | Details</a></li>
                                    <!--
                                    <li><a href="#">Photos</a></li>
                                    <li><a href="#">Posts</a></li>
                                    -->
                                </ul>
                                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Book Information</h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">book</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo $row->b_title; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Book Tilte</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">date_range</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo $row->b_isbn_no; ?></span>
                                                            <span class="uk-text-small uk-text-muted ">Book ISBN Number</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">description</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo $row->bc_name; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Book Category</span>
                                                        </div>
                                                    </li>
                                                    <br>
                                                    <h4 class="heading_c uk-margin-small-bottom">Student Information</h4>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">how_to_reg</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo $row->s_name; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Student Name</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">verified_user</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo $row->s_number; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Student Number</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <div class="uk-width-large-1-2">
                                            <br>
                                            <h4 class="heading_c uk-margin-small-bottom">Operation Details</h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">event</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo date(
                                                                "d-M-Y h:m:s",
                                                                strtotime(
                                                                    $tsamp
                                                                )
                                                            ); ?></span>
                                                            <span class="uk-text-small uk-text-muted">Library Operation Timestamp</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">offline_bolt</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo $row->lo_number; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Library Operation Number</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">perm_data_setting</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading text-success uk-text-primary"><?php echo $row->lo_checksum; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Library Operation Checksum</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                                
                                                
                                                <h4 class="heading_c uk-margin-small-bottom">Important Dates </h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">calendar_today</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo date(
                                                                "d-M-Y",
                                                                strtotime(
                                                                    $tsamp
                                                                )
                                                            ); ?></span>
                                                            <span class="uk-text-small uk-text-muted">Date Borrowed</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon material-icons">check_box</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading uk-text-primary"><?php echo date(
                                                                "d-M-Y",
                                                                strtotime(
                                                                    $tsamp
                                                                )
                                                            ); ?></span>
                                                            <span class="uk-text-small uk-text-muted">Date <?php echo $row->lo_status; ?></span>
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
 

</body>

</html>