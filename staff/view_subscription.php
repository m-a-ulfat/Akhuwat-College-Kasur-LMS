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
    $s_id = $_GET["s_id"];
    $ret = "SELECT * FROM  iL_Subscriptions WHERE s_id = ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("s", $s_id);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) {
        //load default book cover page if book is missing a cover image
        if ($row->s_cover_img == "") {
            $cover_image =
                "<img src='../admin/assets/img/books/Image12.jpg' alt='Book Image'>";
        } else {
            $cover_image = "<img src='../admin/assets/magazines/$row->s_cover_img' alt='Book Image'>";
        } ?>
        <div id="page_content">
            <!--Breadcrums-->
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Subscriptions</a></li>
                    <li><a href="view_subscription.php">Manage Subscription</a></li>
                    <li><span>View <?php echo $row->s_title; ?></span></li>

                </ul>
            </div>
            <div id="page_content_inner">
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading user_heading_bg" style="background-image: url('../admin/assets/magazines/<?php echo $row->s_cover_img; ?>')">
                                <div class="bg_overlay">
                                    <div class="user_heading_menu hidden-print">
                                        <div class="uk-display-inline-block"><i class="md-icon md-icon-light material-icons" id="page_print">&#xE8ad;</i></div>
                                    </div>
                                    <div class="user_heading_content">
                                        <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $row->s_title; ?></span><span class="sub-heading">Code: <?php echo $row->s_code; ?></span></h2>
                                        
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
                                    <li class="uk-active"><a href="#"><?php echo $row->s_title; ?> Details</a></li>
                                    <!--
                                    <li><a href="#">Photos</a></li>
                                    <li><a href="#">Posts</a></li>
                                    -->
                                </ul>
                                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                    <li>
                                        <?php echo $row->s_desc; ?>
                                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Magazine Information</h4>
                                                <ul class="md-list md-list-addon">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">storefront</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->s_publisher; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Publisher</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-text-primary material-icons">event_available</i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading"><?php echo $row->s_category; ?></span>
                                                            <span class="uk-text-small uk-text-muted">Magazine Category</span>
                                                        </div>
                                                    </li>
                                                    
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </li>

                                </ul>
                                <!--Book Cover Image-->
                                <h4 class="heading_c uk-margin-small-bottom">Magazine Cover Image</h4>
                                <hr>
                                <div class="md-card md-card-hover">
                                        <div class="gallery_grid_item md-card-content">
                                            <a href="view_magazine.php?s_id=<?php echo $row->s_id; ?>" class="custom-modal-open" data-image-id="7">
                                                <?php echo $cover_image; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

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