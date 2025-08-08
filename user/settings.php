<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

if (isset($_POST["std_update"])) {
    $id = $_SESSION["s_id"];
    $s_name = $_POST["s_name"];
    $s_email = $_POST["s_email"];
    $s_sex = $_POST["s_sex"];
    $s_phone = $_POST["s_phone"];
    $s_bio = $_POST["s_bio"];
    $s_adr = $_POST["s_adr"];
    $s_dpic = $_FILES["s_dpic"]["name"];
    move_uploaded_file(
        $_FILES["s_dpic"]["tmp_name"],
        "../sudo/assets/img/avatars/students/" . $_FILES["s_dpic"]["name"]
    );
    $s_pwd = sha1(md5($_POST["s_pwd"]));
    $query =
        "UPDATE iL_Students SET s_name =?, s_email = ?, s_sex = ?, s_phone = ?, s_bio = ?, s_adr =?, s_dpic =?, s_pwd =? WHERE s_id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        "ssssssssi",
        $s_name,
        $s_email,
        $s_sex,
        $s_phone,
        $s_bio,
        $s_adr,
        $s_dpic,
        $s_pwd,
        $id
    );
    $stmt->execute();
    if ($stmt) {
        $success = "Profile Updated" && header("refresh:1;url=profile.php");
    } else {
        $err = "Please Try Again Or Try Later";
    }
}
?>    
<!doctype html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
        <?php include "assets/inc/nav.php"; ?>
        <?php
        include "assets/inc/sidebar.php";

        $ret = "SELECT * FROM  iL_Students  WHERE s_id = ? ";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param("i", $id);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) {
            if ($row->s_dpic == "") {
                $profile_picture = "

                        <img src='../sudo/assets/img/avatars/user_icon.png' alt='User Image'>
                        ";
            } else {
                $profile_picture = "
                        <img src='../sudo/assets/img/avatars/students/$row->s_dpic' alt='user avatar'/>
                    ";
            } ?>
        <div id="page_content">
            <div id="page_content_inner">
                <form method="post" enctype="multipart/form-data" class="uk-form-stacked" id="user_edit_form">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-large-10-10">
                            <div class="md-card">
                                <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                    <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <?php //profile picture

            echo $profile_picture; ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div class="user_avatar_controls">
                                            <span class="btn-file">
                                                <span class="fileinput-new"><i class="material-icons">&#xE2C6;</i></span>
                                                <span class="fileinput-exists"><i class="material-icons">&#xE86A;</i></span>
                                                <input type="file" name="s_dpic">
                                            </span>
                                            <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                        </div>
                                    </div>
                                    <div class="user_heading_content">
                                        <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"><?php echo $row->s_name; ?></span><span class="sub-heading" id="user_edit_position"><?php echo $row->s_number; ?></span></h2>
                                    </div>

                                </div>
                                <div class="user_content">
                                    <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                                        <li class="uk-active"><a href="#"><?php echo $row->s_name; ?> Update Your Profile</a></li>
                                    </ul>
                                    <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                                        <li>
                                            <div class="uk-margin-top">
                                                <h3 class="full_width_in_card heading_c">
                                                    General info
                                                </h3>

                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_uname_control">Name</label>
                                                        <input class="md-input" required type="text" name="s_name" value="<?php echo $row->s_name; ?>" />
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_position_control">Email</label>
                                                        <input class="md-input" required type="email" value="<?php echo $row->s_email; ?>"  name="s_email" />
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_position_control">Phone Number</label>
                                                        <input type="text" required class="md-input" name="s_phone" value="<?php echo $row->s_phone; ?>" />
                                                    </div>
                                                    
                                                </div>
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_uname_control">Gender</label>
                                                        <select class="md-input" required type="text" name="s_sex" value="<?php echo $row->s_sex; ?>" />
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_position_control">Address</label>
                                                        <input class="md-input" required type="text" value="<?php echo $row->s_adr; ?>"  name="s_adr" />
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_position_control">Student Number</label>
                                                        <input type="text" required class="md-input" readonly name="s_number" value="<?php echo $row->s_number; ?>" />
                                                    </div>
                                                    
                                                </div>

                                                <div class="uk-grid" data-uk-grid-margin>   
                                                        <div class="uk-width-medium-1-3">
                                                            <label for="user_edit_uname_control">Old Password</label>
                                                            <input class="md-input" type="password" required  />
                                                        </div>
                                                        <div class="uk-width-medium-1-3">
                                                            <label for="user_edit_position_control">New Password</label>
                                                            <input class="md-input" type="password"  required  name="s_pwd" />
                                                        </div>
                                                        <div class="uk-width-medium-1-3">
                                                            <label for="user_edit_position_control">Confirm New Password</label>
                                                            <input type="password" class="md-input" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-1">
                                                        <label for="user_edit_personal_info_control">About | Bio</label>
                                                        <textarea class="md-input" name="s_bio"  cols="30" required rows="4"><?php echo $row->s_bio; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-1">
                                                        <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                                            <div>
                                                                <div class="uk-input-group">
                                                                    <input type="submit" class="md-btn md-btn-success" name="std_update" value="Update Profile" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
        }
        ?>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>