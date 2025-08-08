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

    <div id="page_content">
    <!--BreadCrumps-->
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Audits</a></li>
                <li><span>Subscriptions</span></li>
            </ul>
        </div>
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">iLibrary Subscribed Media Catalog</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <th>Title</th>
                            <th>Publisher</th>
                            <th>Category</th>
                            <th>Issue Date</th>
                            <th>Code</th>
                            <th>Action</th>
                        </thead>    
                      
                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  iL_Subscriptions";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) { ?>
                                <tr>
                                    <td class="uk-text-truncate"><?php echo $row->s_title; ?></td>
                                    <td><?php echo $row->s_publisher; ?></td>
                                    <td><?php echo $row->s_category; ?></td>
                                    <td><?php echo $row->s_year; ?></td>
                                    <td class="uk-text-success"><?php echo $row->s_code; ?></td>
                                    <td>
                                        <a href="view_subscription.php?s_id=<?php echo $row->s_id; ?>">
                                            <span class='uk-badge uk-badge-success'>View</span>
                                        </a>
                                        
                                    </td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!--Footer-->
    <?php require_once "assets/inc/footer.php"; ?>
    <!--Footer-->
</body>
</html>