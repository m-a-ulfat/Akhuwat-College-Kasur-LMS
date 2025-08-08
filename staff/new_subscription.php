<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

//generate random subcription issue
$length = 5;
$code = substr(str_shuffle("0123456789"), 1, $length);

//create a subscription
if (isset($_POST["add_subscribed_media"])) {
    $s_title = $_POST["s_title"];
    $s_code = $_POST["s_code"];
    $s_category = $_POST["s_category"];
    $s_desc = $_POST["s_desc"];

    $s_cover_img = $_FILES["s_cover_img"]["name"];
    move_uploaded_file(
        $_FILES["s_cover_img"]["tmp_name"],
        "../admin/assets/magazines/" . $_FILES["s_cover_img"]["name"]
    );

    $s_file = $_FILES["s_file"]["name"];
    move_uploaded_file(
        $_FILES["s_file"]["tmp_name"],
        "../admin/assets/magazines/" . $_FILES["s_file"]["name"]
    );

    $s_publisher = $_POST["s_publisher"];
    $s_year = $_POST["s_year"];

    //Insert Captured information to a database table
    $query =
        "INSERT INTO iL_Subscriptions (s_title, s_code, s_category, s_desc, s_cover_img, s_file, s_publisher, s_year) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    //bind paramaters
    $rc = $stmt->bind_param(
        "ssssssss",
        $s_title,
        $s_code,
        $s_category,
        $s_desc,
        $s_cover_img,
        $s_file,
        $s_publisher,
        $s_year
    );
    $stmt->execute();

    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success = "Subscription Media Added";
    } else {
        $err = "Please Try Again Or Try Later";
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
    <!--Breadcrums-->
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="#">Subscribed Media</a></li>
                <li><span>New</span></li>
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
                                    <input type="text" required name="s_title" class="md-input" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Code</label>
                                    <input type="text" required readonly value="SUB-<?php echo $code; ?>" name="s_code" class="md-input label-fixed" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Publisher</label>
                                    <input type="text" required  name="s_publisher" class="md-input label-fixed" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Year Published</label>
                                    <input type="text" required  name="s_year" class="md-input label-fixed" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Book Category</label>
                                            <select required onChange="getBookId(this.value);" name="bc_name" class="md-input">
                                            <option>Select Book Category</option>
                                                <?php
                                                $ret =
                                                    "SELECT * FROM  iL_BookCategories";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while (
                                                    $row = $res->fetch_object()
                                                ) { ?>
                                                    <option value="<?php echo $row->bc_name; ?>"><?php echo $row->bc_name; ?></option>
                                                <?php }
                                                ?>
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
                                    <textarea cols="30" rows="4" class="md-input" name="s_desc"></textarea>
                                </div>
                            </div>

                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <input type="submit" class="md-btn md-btn-success" name="add_subscribed_media" value="Add Subscribed Media" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php require_once "assets/inc/footer.php"; ?>
    <!--Footer-->
</body>
</html>