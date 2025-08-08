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
    <?php include "assets/inc/nav.php"; ?>
    <?php include "assets/inc/sidebar.php"; ?>
    <div id="page_content">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Audits</a></li>
                <li><span>My Library Operations</span></li>
            </ul>
        </div>
        <div id="page_content_inner">
            <h4 class="heading_a uk-margin-bottom">My iLibrary Operations Records</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="dt_colVis_buttons"></div>
                    <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                            <th>Operation Type</th>
                            <th>Operation Times</th>
                            <th>Action</th>
                        </thead>    
                        <tbody>
                            <?php
                            $id = $_SESSION["s_id"];
                            $ret =
                                "SELECT * FROM  iL_LibraryOperations WHERE s_id = ?  ";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->bind_param("i", $id);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {

                                $tsamp = $row->created_at;
                                if ($row->lo_status == "Returned") {
                                    $opsType = "<td class='uk-text-success'>$row->lo_status</td>";
                                } elseif ($row->lo_status == "Damanged") {
                                    $opsType = "<td class='uk-text-warning'>$row->lo_status</td>";
                                } elseif ($row->lo_status == "Lost") {
                                    $opsType = "<td class='uk-text-danger'>$row->lo_status</td>";
                                } else {
                                    $opsType =
                                        "<td class='uk-text-primary'>Return Pending</td>";
                                }
                                ?>
                                <tr>
                                    <?php echo $opsType; ?>
                                    <td><?php echo date(
                                        "d-M-Y",
                                        strtotime($tsamp)
                                    ); ?></td> 
                                    <td>
                                        <a href='books.php?operationChecksum=<?php echo $row->lo_checksum; ?>'>
                                                <span class='uk-badge uk-badge-success'>View</span>
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