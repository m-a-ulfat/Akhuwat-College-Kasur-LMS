<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

//update student account
if (isset($_POST["update_student"])) {
    $s_name = $_POST["s_name"];
    $student_number = $_GET["student_number"];
    $s_email = $_POST["s_email"];
    //$s_pwd = sha1(md5($_POST['s_pwd']));
    $s_sex = $_POST["s_sex"];
    $s_phone = $_POST["s_phone"];
    $s_bio = $_POST["s_bio"];
    $s_adr = $_POST["s_adr"];
    $s_acc_status = $_POST["s_acc_status"];

    //Insert Captured information to a database table
    $query =
        "UPDATE iL_Students SET s_name =?, s_email = ?, s_sex = ?, s_phone = ?, s_bio = ?, s_adr =?, s_acc_status =? WHERE s_number =?";
    $stmt = $mysqli->prepare($query);
    //bind paramaters
    $rc = $stmt->bind_param(
        "ssssssss",
        $s_name,
        $s_email,
        $s_sex,
        $s_phone,
        $s_bio,
        $s_adr,
        $s_acc_status,
        $student_number
    );
    $stmt->execute();

    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success =
            "Student Account Updated" &&
            header("refresh:1;url=manage_student.php");
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
        <?php
        include "assets/inc/sidebar.php";

        $student_number = $_GET["student_number"];
        $ret = "SELECT * FROM  iL_Students WHERE s_number = ?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param("s", $student_number);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) { ?>

        <div id="page_content">
            <!--Breadcrums-->
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="#">Students</a></li>
                    <li><a href="manage_student.php">Manage Student Account</a></li>
                    <li><span>Update <?php echo $row->s_name; ?></span></li>
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
                                        <label>Student Full Name</label>
                                        <input type="text" value="<?php echo $row->s_name; ?>" required name="s_name" class="md-input" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Student Number</label>
                                        <input type="text" required readonly value="<?php echo $row->s_number; ?>" name="s_number" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Student Email</label>
                                        <input type="email" value="<?php echo $row->s_email; ?>" required name="s_email" class="md-input"  />
                                    </div>
                                    
                                    
                                </div>

                                <div class="uk-width-medium-1-2">
                                    <div class="uk-form-row">
                                        <label>Student Phone Number</label>
                                        <input type="text" value="<?php echo $row->s_phone; ?>" required class="md-input" name="s_phone" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Student Address</label>
                                        <input type="text" value="<?php echo $row->s_adr; ?>" requied name="s_adr" class="md-input"  />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Student Gender</label>
                                            <select required name="s_sex" class="md-input"  />
                                                <option>Select Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Student Account Status</label>
                                            <select required name="s_acc_status" class="md-input"  />
                                                <option>Active</option>
                                                <option>Pending</option>
                                                <option>Suspended</option>
                                            </select>
                                    </div>

                                    <div class="uk-form-row">
                                        <label>Student Bio | About  </label>
                                        <textarea cols="30" rows="4" class="md-input" name="s_bio"><?php echo $row->s_bio; ?></textarea>
                                    </div>
                                </div>

                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <input type="submit" class="md-btn md-btn-success" name="update_student" value="Update <?php echo $row->s_name; ?> Account" />
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
    <!--Footer-->
    <?php require_once "assets/inc/footer.php"; ?>
    <!--Footer-->
</body>
</html>