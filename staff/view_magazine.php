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
                    <li><a href="manage_subscriptions.php">Manage Subscription</a></li>
                    <li><span>View <?php echo $row->s_title; ?></span></li>

                </ul>
            </div>
            <div id="page_content_inner">
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                    <div class="uk-width-large-10-10">
                       
                        <div class="md-card">
                            <div class="user_content">
                                
                                <div class="md-card md-card-hover">
                                        <div class="gallery_grid_item md-card-content">
                                            <iframe src="../admin/assets/magazines/<?php echo $row->s_file; ?>" class ="uk-width-large-10-10" height="900px">
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