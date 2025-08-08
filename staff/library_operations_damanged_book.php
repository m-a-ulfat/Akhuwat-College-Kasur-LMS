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
                <li><span>Return Damanged Book</span></li>
            </ul>
        </div>
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">iLibrary Borrowed Books</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Borrowed By</th>
                            <th>Student No.</th>
                            <th>Date Borrowed</th>
                            <th>Return Date</th>
                            <th>Action</th>
                        </thead>    
                      
                        <tbody>
                            <?php
                            $ret =
                                "SELECT * FROM  iL_LibraryOperations WHERE lo_status = '' ";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {

                                //trim timestamp to DD/MM/YYY
                                $borrowed_date = $row->created_at;
                                $return_date = $row->lo_return_date;

                                //limit user to return one book multimple times
                                if ($row->lo_status == "") {
                                    $damanged_book = "
                                            <a href='return_damanged_book.php?lo_id=$row->lo_id&b_id=$row->b_id&lo_status=Damanged'>
                                                <span class='uk-badge uk-badge-danger'>Return Damanged </span>
                                            </a>
                                        ";
                                }
                                ?>
                                <tr>
                                    <td><?php echo $row->b_title; ?></td>
                                    <td><?php echo $row->bc_name; ?></td>
                                    <td class="uk-text-success"><?php echo $row->s_name; ?></td>
                                    <td class="uk-text-success"><?php echo $row->s_number; ?></td>
                                    <td><?php echo date(
                                        "d-M-Y",
                                        strtotime($borrowed_date)
                                    ); ?></td> 
                                    <td><?php echo date(
                                        "d-M-Y",
                                        strtotime($return_date)
                                    ); ?></td> 
                                    <td>
                                        <?php echo $damanged_book; ?>                                        
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
</body>
</html>