<?php

session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

//1.3 : Number of all Borrowed Books no matter what category but aint returned
$id = $_SESSION["s_id"];
$result =
    "SELECT count(*) FROM iL_LibraryOperations WHERE lo_type = 'Borrow' AND lo_status = '' AND s_id = ? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($borrowed_books);
$stmt->fetch();
$stmt->close();

//1.1 : Number of all Lost Books no matter what category
$result =
    "SELECT count(*) FROM iL_LibraryOperations WHERE lo_status = 'Lost' AND s_id = ?  ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($lost_books);
$stmt->fetch();
$stmt->close();

//1.2 : Number of all Damanged no matter what category
$result =
    "SELECT count(*) FROM iL_LibraryOperations WHERE  lo_status = 'Damanged' AND s_id =? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($damanged_books);
$stmt->fetch();
$stmt->close();

//1.0 : Number of all Borrowed Books no matter what category and returned
$result =
    "SELECT count(*) FROM iL_LibraryOperations WHERE lo_status = 'Returned' AND s_id =? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($Returned);
$stmt->fetch();
$stmt->close();

//1.0.1 : Number Of Books which have returned successfully
$result =
    "SELECT COUNT(*) FROM iL_LibraryOperations WHERE lo_status = 'Returned' AND s_id =? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($returned_successfully);
$stmt->fetch();
$stmt->close();

//1.0.2 : Number Of Books which have returned but are damanged
$result =
    "SELECT COUNT(*) FROM iL_LibraryOperations WHERE lo_status = 'Damanged' AND s_id =? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($returned_damanged);
$stmt->fetch();
$stmt->close();

//1.0.3 : Number Of Books which are lost
$result =
    "SELECT COUNT(*) FROM iL_LibraryOperations WHERE lo_status = 'Lost' AND s_id =? ";
$stmt = $mysqli->prepare($result);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($lost);
$stmt->fetch();
$stmt->close();
?>
<!doctype html>
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
                            <span class="uk-text-muted uk-text-small">Borrowed Books</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $borrowed_books; ?> </span></h2>
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
                            <span class="uk-text-muted uk-text-small">Lost Books</span>
                            <h2 class="uk-margin-remove"><span class="countUpMe"> <?php echo $lost_books; ?> </span></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-small">Damaged Books</span>
                            <h2 class="uk-margin-remove"><?php echo $damanged_books; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid">
                <div class="uk-width-1-1">
                    <h4 class="heading_a uk-margin-bottom">Books</h4>
                    <div class="md-card">
                        <div class="md-card-content">
                            <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Available Copies</th>
                                </thead>    
                                <tbody>
                                    <?php
                                    $ret = "SELECT * FROM  iL_Books";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                        //use .success, .warning, . danger on book copies
                                        if ($row->b_copies >= "200") {
                                            $copies = "<td class='uk-text-success'>$row->b_copies Copies</td>";
                                        } elseif (
                                            $row->b_copies > "100" &&
                                            $row->b_copies < "200"
                                        ) {
                                            $copies = "<td class='uk-text-primary'>$row->b_copies Copies</td>";
                                        } elseif (
                                            $row->b_copies > "45" &&
                                            $row->b_copies < "100"
                                        ) {
                                            $copies = "<td class='uk-text-warning'>$row->b_copies Copies</td>";
                                        } else {
                                            $copies = "<td class='uk-text-danger'>$row->b_copies Copies</td>";
                                        } ?>
                                        <tr>
                                            <td class="uk-text-truncate"><?php echo $row->b_title; ?></td>
                                            <td class="uk-text-primary"><?php echo $row->b_author; ?></td>
                                            <td><?php echo $row->bc_name; ?></td>
                                            <?php echo $copies; ?>
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