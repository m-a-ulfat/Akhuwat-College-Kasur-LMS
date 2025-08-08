<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
if (isset($_GET["deleteAccount"])) {
    $id = intval($_GET["deleteAccount"]);
    $adn = "DELETE FROM  iL_Librarians  WHERE l_id = ?";
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
                <li><a href="#">Librarians</a></li>
                <li><span>Manage Librarians</span></li>
            </ul>
        </div>
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">iLibrary Librarian Accounts</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>iLib Number</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Acc Status</th>
                            <th>Actions</th>
                        </tr>
                        <tbody>
                            <?php
                            $ret = "SELECT * FROM  iL_Librarians";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {
                                //use .danger, .warning, .success according to account status
                                if ($row->l_acc_status == "Active") {
                                    $account_status = "<td class='uk-text-success'>$row->l_acc_status</td>";
                                } elseif ($row->l_acc_status == "Pending") {
                                    $account_status = "<td class='uk-text-warning'>$row->l_acc_status</td>";
                                } else {
                                    $account_status = "<td class='uk-text-danger'>$row->l_acc_status</td>";
                                } ?>
                                <tr>
                                    <td><?php echo $row->l_name; ?></td>
                                    <td><?php echo $row->l_number; ?></td>
                                    <td><?php echo $row->l_phone; ?></td>
                                    <td><?php echo $row->l_email; ?></td>
                                    <td><?php echo $row->l_adr; ?></td>
                                    <?php echo $account_status; ?>
                                    <td>
                                        <a href="view_librarian.php?librarian_number=<?php echo $row->l_number; ?>">
                                            <span class='uk-badge uk-badge-success'>View</span>
                                        </a>
                                        <a href="edit_librarian.php?librarian_number=<?php echo $row->l_number; ?>">
                                           <span class='uk-badge uk-badge-primary'>Update</span>
                                        </a>
                                        <a href="manage_librarians.php?deleteAccount=<?php echo $row->l_id; ?>">
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

    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>