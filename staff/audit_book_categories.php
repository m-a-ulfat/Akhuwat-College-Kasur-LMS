<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
//delete booc categoory
if (isset($_GET["deleteBookCategory"])) {
    $id = intval($_GET["deleteBookCategory"]);
    $adn = "DELETE FROM  iL_BookCategories  WHERE bc_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        $info = "Book Category Deleted";
    } else {
        $err = "Try Again Later";
    }
}
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
                <li><span>Book Categories</span></li>
            </ul>
        </div>
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">iLibrary Book Categories</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Book Category Name</th>
                            <th>Actions</th>
                        </tr>
                      
                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  iL_BookCategories";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) { ?>
                                <tr>
                                    <td><?php echo $row->bc_name; ?></td>
                                    <td>
                                        <a href="view_book_category.php?category_code=<?php echo $row->bc_code; ?>">
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