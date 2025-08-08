<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

// $result = "SELECT SUM(b_copies) FROM iL_Books";
// $stmt = $mysqli->prepare($result);
// $stmt->execute();
// $stmt->bind_result($books);
// $stmt->fetch();
// $stmt->close();

$result = "SELECT count(*) FROM iL_LibraryOperations WHERE lo_type = 'Borrow' AND lo_status = '' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($borrowed_books);
$stmt->fetch();
$stmt->close();

$result = "SELECT count(*) FROM iL_LibraryOperations WHERE lo_status = 'Lost'  ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($lost_books);
$stmt->fetch();
$stmt->close();
$result = "SELECT count(*) FROM iL_LibraryOperations WHERE  lo_status = 'Damanged' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($damanged_books);
$stmt->fetch();
$stmt->close();
$result = "SELECT count(*) FROM iL_LibraryOperations WHERE lo_status = 'Returned'  ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($Returned);
$stmt->fetch();
$stmt->close();
$damanged_and_lost_books = $lost_books + $damanged_books;
$result = "SELECT count(*) FROM iL_Librarians WHERE l_acc_status = 'Active' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($librarians);
$stmt->fetch();
$stmt->close();
$result = "SELECT count(*) FROM iL_Students WHERE s_acc_status = 'Active' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($students);
$stmt->fetch();
$stmt->close();
$result = "SELECT count(*) FROM iL_Students WHERE s_acc_status = 'Pending' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($pending_students);
$stmt->fetch();
$stmt->close();

$result = "SELECT count(*) FROM iL_Librarians WHERE l_acc_status = 'Pending' ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($pending_librarians);
$stmt->fetch();
$stmt->close();

$result = "SELECT count(*) FROM iL_Subscriptions ";
$stmt = $mysqli->prepare($result);
$stmt->execute();
$stmt->bind_result($subscriptions);
$stmt->fetch();
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <?php include "assets/inc/nav.php"; ?>
    <?php include "assets/inc/sidebar.php"; ?>
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
               
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Books</span>
                            <!-- <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $books; ?> </span></h2> -->
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Returned Books</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $Returned; ?> </span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Lost | Damaged Books</span>
                            <h2 class="uk-margin-remove"><?php echo $damanged_and_lost_books; ?></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Librarians</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $librarians; ?> </span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
              
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Enrolled Students</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $students; ?> </span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Pending Librarians Accounts</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $pending_librarians; ?> </span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Pending Students Accounts</span>
                            <h2 class="uk-margin-remove"><?php echo $pending_students; ?></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Subscribed Media</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $subscriptions; ?> </span></h2>
                        </div>
                    </div>
                </div>
            </div>
             
            
              <!-- Library Staffs Table -->
              <div class="uk-width-1-1"><br>
                    <h4 class="heading_a uk-margin-bottom">Library Staffs</h4>
                    <div class="md-card">
                        <div class="md-card-content">
                            <table id="staffs_table" class="uk-table uk-table-striped uk-table-hover uk-table-condensed uk-table-middle" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Staff Number</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  iL_Librarians";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                        if ($row->l_acc_status == "Active") {
                                            $account_status = "<td class='uk-text-success'>$row->l_acc_status</td>";
                                        } elseif ($row->l_acc_status == "Pending") {
                                            $account_status = "<td class='uk-text-warning'>$row->l_acc_status</td>";
                                        } else {
                                            $account_status = "<td class='uk-text-danger'>$row->l_acc_status</td>";
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $row->l_name; ?></td>
                                            <td><?php echo $row->l_number; ?></td>
                                            <td><?php echo $row->l_phone; ?></td>
                                            <td><?php echo $row->l_email; ?></td>
                                            <td><?php echo $row->l_adr; ?></td>
                                            <?php echo $account_status; ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Students Table -->
                <div class="uk-width-1-1"><br>
                    <h4 class="heading_a uk-margin-bottom">Library Enrolled Students</h4>
                    <div class="md-card">
                        <div class="md-card-content">
                            <table id="students_table" class="uk-table uk-table-striped uk-table-hover uk-table-condensed uk-table-middle" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>iLib Student No</th>
                                        <th>Phone No.</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Gender</th>
                                        <th>Acc Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  iL_Students";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                        if ($row->s_acc_status == "Active") {
                                            $account_status = "<td class='uk-text-success'>$row->s_acc_status</td>";
                                        } elseif ($row->s_acc_status == "Pending") {
                                            $account_status = "<td class='uk-text-warning'>$row->s_acc_status</td>";
                                        } else {
                                            $account_status = "<td class='uk-text-danger'>$row->s_acc_status</td>";
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $row->s_name; ?></td>
                                            <td><?php echo $row->s_number; ?></td>
                                            <td><?php echo $row->s_phone; ?></td>
                                            <td><?php echo $row->s_email; ?></td>
                                            <td><?php echo $row->s_adr; ?></td>
                                            <td><?php echo $row->s_sex; ?></td>
                                            <?php echo $account_status; ?>
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
        </div>
    </div>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>