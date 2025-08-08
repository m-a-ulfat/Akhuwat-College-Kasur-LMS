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
                <li><a href="#">Library Operations</a></li>
                <li><span>Add Operation</span></li>
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
                            <th>ISBN No.</th>
                            <th>Available Copies</th>
                            <th>Action</th>
                        </thead>    
                      
                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  iL_Books";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {
                                //limit user to not borrow when number of books fall to 0
                                if ($row->b_copies > 0) {
                                    $borrow = "<a href='borrow_book.php?lo_type=Borrow&bc_id=$row->bc_id&bc_name=$row->bc_name&b_id=$row->b_id&b_title=$row->b_title&b_isbn_no=$row->b_isbn_no'>
                                                        <span class=' uk-badge uk-badge-success'>Borrow</span>
                                                    </a>
                                                  ";
                                } else {
                                    $borrow =
                                        "<span class=' uk-badge uk-badge-danger'>Not Available</span>";
                                } ?>
                                <tr>
                                    <td><?php echo $row->b_title; ?></td>
                                    <td><?php echo $row->b_author; ?></td>
                                    <td><?php echo $row->bc_name; ?></td>
                                    <td class="uk-text-success"><?php echo $row->b_isbn_no; ?></td>
                                    <td><?php echo $row->b_copies; ?> Copies</td>
                                    <td>                                
                                        <?php echo $borrow; ?>
                                    </td>
                                </tr>

                            <?php
                            }
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