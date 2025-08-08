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
    $error = 0;
    if (isset($_POST["s_title"]) && !empty($_POST["s_title"])) {
        $s_title = mysqli_real_escape_string($mysqli, trim($_POST["s_title"]));
    } else {
        $error = 1;
        $err = "Subscription title cannot be empty";
    }

    if (isset($_POST["s_code"]) && !empty($_POST["s_code"])) {
        $s_code = mysqli_real_escape_string($mysqli, trim($_POST["s_code"]));
    } else {
        $error = 1;
        $err = "Subscription code cannot be empty";
    }
    if (!$error) {
        $sql = "SELECT * FROM  iL_Subscriptions WHERE  s_code='$s_code'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($s_code == $row["s_code"]) {
                $err = "Subscription Code already exists";
            } else {
                $err = "Subscription Name already exists";
            }
        } else {
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
                <li><a href="#">Subscribed Media</a></li>
                <li><span>New</span></li>
            </ul>
        </div>

        <div id="page_content_inner">
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Please Fill All Fields</h3>
                    <hr>

                    <!-- Display messages -->
                    <?php if (isset($error_msg)) { echo "<div class='uk-alert uk-alert-danger' data-uk-alert><p>$error_msg</p></div>"; } ?>
                    <?php if (isset($success_msg)) { echo "<div class='uk-alert uk-alert-success' data-uk-alert><p>$success_msg</p></div>"; } ?>

                    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                    <label>Title</label>
                                    <input type="text" required name="s_title" class="md-input" id="s_title" />
                                </div>

                                <div class="uk-form-row">
                                    <label>Code</label>
                                    <input type="text" required readonly value="SUB-<?php echo $code; ?>" name="s_code" class="md-input label-fixed" />
                                </div>

                                <div class="uk-form-row">
                                    <label>Publisher</label>
                                    <input type="text" required name="s_publisher" class="md-input label-fixed" id="s_publisher" />
                                </div>

                                <div class="uk-form-row">
                                    <label>Year Published</label>
                                    <input type="number" required name="s_year" class="md-input label-fixed" id="s_year" />
                                </div>

                                
                            <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                    <label>Description</label>
                                    <textarea cols="30" rows="4" class="md-input" name="s_desc" id="s_desc" required></textarea>
                                </div>
                            </div>

                            
                                <div class="uk-form-row"><br>
                                    <label>Category</label><br>
                                    <select name="s_category" class="md-input" id="s_category">
                                        <option value="">Select Category</option>
                                        <option>Art & Architecture</option>
                                        <option>Boating & Aviation</option>
                                        <option>Business & Finance</option>
                                        <option>Cars & Motorcycles</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uk-width-1-1">
                                <div id="file_upload-drop" class="uk-file-upload">
                                    <p class="uk-text">Drop Media (Subscribed Magazine) Image</p>
                                    <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                    <a class="uk-form-file md-btn">Choose File<input id="file_upload-select" name="s_cover_img" type="file" required /></a>
                                </div>
                            </div>

                            <div class="uk-width-1-1">
                                <br>
                                <div id="file_upload-drop" class="uk-file-upload">
                                    
                                    <p class="uk-text">Drop Media File (Only In PDF Format)</p>
                                    <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                    <a class="uk-form-file md-btn">Choose Pdf File<input id="file_upload-select" name="s_file" type="file" accept=".pdf" required /></a>
                                </div>
                            </div>

                            <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                    <br>
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

    <?php require_once "assets/inc/footer.php"; ?>

    <script>
        // JavaScript form validation function
        function validateForm() {
            let title = document.getElementById("s_title").value;
            let publisher = document.getElementById("s_publisher").value;
            let year = document.getElementById("s_year").value;
            let category = document.getElementById("s_category").value;
            let description = document.getElementById("s_desc").value;

            if (title === "" || publisher === "" || year === "" || category === "" || description === "") {
                alert("All fields must be filled!");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
