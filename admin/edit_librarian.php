<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
$length = 5;
$Number = substr(str_shuffle("0123456789"), 1, $length);
if (isset($_POST["update_librarian"])) {
    $librarian_number = $_GET["librarian_number"];
    $l_name = $_POST["l_name"];
    $l_phone = $_POST["l_phone"];
    $l_email = $_POST["l_email"];
    $l_adr = $_POST["l_adr"];
    $l_pwd = sha1(md5($_POST["l_pwd"]));
    $l_bio = $_POST["l_bio"];
    $l_acc_status = $_POST["l_acc_status"];
    $query =
        "UPDATE  iL_Librarians SET l_name = ?, l_phone = ?, l_email = ?, l_adr = ?, l_pwd= ?, l_bio = ?, l_acc_status = ? WHERE l_number = ? ";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        "ssssssss",
        $l_name,
        $l_phone,
        $l_email,
        $l_adr,
        $l_pwd,
        $l_bio,
        $l_acc_status,
        $librarian_number
    );
    $stmt->execute();
    if ($stmt) {
        $success =
            "Librarian Account Updated" &&
            header("refresh:1;url=manage_librarians.php");
    } else {
        $err =
            "Please Try Again Or Try Later" &&
            header("refresh:1;url=manage_librarians.php");
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
    <?php
    $librarian_number = $_GET["librarian_number"];
    $ret = "SELECT * FROM  iL_Librarians WHERE l_number = ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("s", $librarian_number);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) { ?>
        <div id="page_content">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Librarians</a></li>
                    <li><a href="manage_librarians.php">Manage Librarians</a></li>
                    <li><span>Update <?php echo $row->l_name; ?> Account</span></li>
                </ul>
            </div>
            <div id="page_content_inner">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_a">Please Fill All Fields</h3>
                        <hr>
                        <form method="post">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <div class="uk-form-row">
                                        <label>Librarian Full Name</label>
                                        <input type="text" value="<?php echo $row->l_name; ?>" required name="l_name" class="md-input" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Librarian Number</label>
                                        <input type="text"  required readonly value="<?php echo $row->l_number; ?>" name="l_number" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Librarian Email</label>
                                        <input type="email" value="<?php echo $row->l_email; ?>" required name="l_email" class="md-input"  />
                                    </div>
                                    <div class="uk-form-row" style="display:none">
                                        <label>Librarian Account Status</label>
                                        <input type="text" required name="l_acc_status" value="Active" class="md-input"  />
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <div class="uk-form-row">
                                        <label>Librarian Phone Number</label>
                                        <input type="text" value="<?php echo $row->l_phone; ?>" required class="md-input" name="l_phone" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Librarian Address</label>
                                        <input type="text" value="<?php echo $row->l_adr; ?>" requied name="l_adr" class="md-input"  />
                                    </div>
                                    <div class="uk-form-row">
                                    <label>Librarian Passsword</label>
                                    <input type="password" required name="l_pwd" class="md-input"  />
                                </div>
                                    <div class="uk-form-row">
                                        <label>Librarian Account Status</label>
                                        <select required name="l_acc_status" class="md-input"  />
                                            <option>Active</option>
                                            <option>Pending</option>
                                            <option>Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Librarian Bio | About  </label>
                                        <textarea cols="30" rows="4" class="md-input" name="l_bio"><?php echo $row->l_bio; ?></textarea>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <input type="submit" class="md-btn md-btn-warning" name="update_librarian" value="Update Librarian Account" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>