<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
//delete student account.
if (isset($_GET["deleteAccount"])) {
    $id = intval($_GET["deleteAccount"]);
    $adn = "DELETE FROM  iL_Students  WHERE s_id = ?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        $info = "Account Deleted";
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
                <li><a href="#">Students</a></li>
                <li><span>Manage Students</span></li>
            </ul>
        </div>
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">iLibrary Students Accounts</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>iLib Student No</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Acc Status</th>
                            <th>Actions</th>
                        </tr>
                      
                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  iL_Students";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {
                                //use .danger, .warning, .success according to account status
                                if ($row->s_acc_status == "Active") {
                                    $account_status = "<td class='uk-text-success'>$row->s_acc_status</td>";
                                } elseif ($row->s_acc_status == "Pending") {
                                    $account_status = "<td class='uk-text-warning'>$row->s_acc_status</td>";
                                } else {
                                    $account_status = "<td class='uk-text-danger'>$row->s_acc_status</td>";
                                } ?>
                                <tr>
                                    <td><?php echo $row->s_name; ?></td>
                                    <td><?php echo $row->s_number; ?></td>
                                    <td><?php echo $row->s_phone; ?></td>
                                    <td><?php echo $row->s_email; ?></td>
                                    <td><?php echo $row->s_adr; ?></td>
                                    <td><?php echo $row->s_sex; ?></td>
                                    <?php echo $account_status; ?>
                                    <td>
                                        <a href="view_student.php?student_number=<?php echo $row->s_number; ?>">
                                            <span class='uk-badge uk-badge-success'>View</span>
                                        </a>
                                        <a href="edit_student.php?student_number=<?php echo $row->s_number; ?>">
                                            <span class='uk-badge uk-badge-primary'>Update</span>
                                        </a>
                                        <a href="manage_student.php?deleteAccount=<?php echo $row->s_id; ?>">
                                            <span class='uk-badge uk-badge-danger'>Delete</span>
                                        </a>
                                        
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