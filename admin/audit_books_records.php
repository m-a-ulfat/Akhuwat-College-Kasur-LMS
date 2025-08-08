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
    <?php include "assets/inc/sidebar.php"; ?>
    <div id="page_content">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Audits</a></li>
                <li><span>Books Records</span></li>
            </ul>
        </div>
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">iLibrary Books Catalog</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Available Copies</th>
                            <th>Action</th>
                        </thead>    
                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  iL_Books";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) { ?>
                                <tr>
                                    <td class="uk-text-truncate"><?php echo $row->b_title; ?></td>
                                    <td><?php echo $row->b_author; ?></td>
                                    <td><?php echo $row->bc_name; ?></td>
                                    <td><?php echo $row->b_copies; ?> Copies</td>
                                    <td>
                                        <a href="view_book.php?book_id=<?php echo $row->b_id; ?>">
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
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>