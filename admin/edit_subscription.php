<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
$length = 5;
$code = substr(str_shuffle("0123456789"), 1, $length);
if (isset($_POST["update_subscribed_media"])) {
    $s_id = $_GET["s_id"];
    $s_title = $_POST["s_title"];
    $s_code = $_POST["s_code"];
    $s_category = $_POST["s_category"];
    $s_desc = $_POST["s_desc"];
    $s_cover_img = $_FILES["s_cover_img"]["name"];
    move_uploaded_file(
        $_FILES["s_cover_img"]["tmp_name"],
        "assets/magazines/" . $_FILES["s_cover_img"]["name"]
    );
    $s_file = $_FILES["s_file"]["name"];
    move_uploaded_file(
        $_FILES["s_file"]["tmp_name"],
        "assets/magazines/" . $_FILES["s_file"]["name"]
    );
    $s_publisher = $_POST["s_publisher"];
    $s_year = $_POST["s_year"];
    $query =
        "UPDATE iL_Subscriptions SET s_title=?, s_code=?, s_category=?, s_desc=?, s_cover_img=?, s_file=?, s_publisher=?, s_year=? WHERE s_id = ?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        "ssssssssi",
        $s_title,
        $s_code,
        $s_category,
        $s_desc,
        $s_cover_img,
        $s_file,
        $s_publisher,
        $s_year,
        $s_id
    );
    $stmt->execute();
    if ($stmt) {
        $success =
            "Subscription Media Updated" &&
            header("refresh:1;url=manage_subscriptions.php");
    } else {
        $err = "Please Try Again Or Try Later";
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
    $s_id = $_GET["s_id"];
    $ret = "SELECT * FROM  iL_Subscriptions WHERE s_id = ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("i", $s_id);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) { ?>
        <div id="page_content">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Subscribed Media</a></li>
                    <li><a href="manage_subscriptions.php">Manage Subscribed Media</a></li>
                    <li><span>Update <?php echo $row->s_title; ?></span></li>
                </ul>
            </div>
            <div id="page_content_inner">
                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_a">Please Fill All Fields</h3>
                        <hr>
                        <form method="post" enctype="multipart/form-data">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Title</label>
                                        <input type="text" value="<?php echo $row->s_title; ?>" required name="s_title" class="md-input" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Code</label>
                                        <input type="text" required readonly value="SUB-<?php echo $code; ?>" name="s_code" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Publisher</label>
                                        <input type="text" required  value="<?php echo $row->s_publisher; ?>" name="s_publisher" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Year Published</label>
                                        <input type="text" required value="<?php echo $row->s_year; ?>"  name="s_year" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Category</label>
                                        <select name="s_category"class="md-input">
                                            <option>Art & Architecture</option>
                                            <option>Boating & Aviation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div id="file_upload-drop" class="uk-file-upload">
                                        <p class="uk-text">Drop Media (Subscribed Magazine) Image</p>
                                        <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                        <a class="uk-form-file md-btn">Choose File<input id="file_upload-select" name="s_cover_img" type="file"></a>
                                    </div>
                                    <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                        <div class="uk-progress-bar" style="width:0">0%</div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div id="file_upload-drop" class="uk-file-upload">
                                        <p class="uk-text">Drop Media File (Only In PDF Formart)</p>
                                        <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                        <a class="uk-form-file md-btn">Choose Pdf File<input id="file_upload-select" name="s_file" type="file"></a>
                                    </div>
                                    <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                        <div class="uk-progress-bar" style="width:0">0%</div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Description</label>
                                        <textarea cols="30" rows="4" class="md-input" name="s_desc"><?php echo $row->s_desc; ?></textarea>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <input type="submit" class="md-btn md-btn-success" name="update_subscribed_media" value="Upate Subscribed Media" />
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