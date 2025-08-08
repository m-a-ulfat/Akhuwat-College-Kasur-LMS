<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
if (isset($_GET["deleteBook"])) {
    $id = intval($_GET["deleteBook"]);
    $adn = "DELETE FROM  iL_Subscriptions  WHERE s_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        $info = "Subscribed Media Deleted";
    } else {
        $err = "Try Again Later";
    }
}
?>    
<!doctype html>
<!DOCTYPE html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <?php include "assets/inc/nav.php"; ?>
    <?php include "assets/inc/sidebar.php"; ?>
    <div id="page_content">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Subscriptions</a></li>
                <li><span>Manage Subscription</span></li>
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
                            $stmt->execute();
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
                                        <a href="edit_subscription.php?s_id=<?php echo $row->s_id; ?>">
                                            <span class='uk-badge uk-badge-primary'>Update</span>
                                        </a>                                        
                                        <a href="manage_subscriptions.php?deleteBook=<?php echo $row->s_id; ?>">
                                            <span class='uk-badge uk-badge-danger'>Delete</span>
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
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>