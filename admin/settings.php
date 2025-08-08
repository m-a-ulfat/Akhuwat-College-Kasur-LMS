<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
if (isset($_POST["sudo_update"])) {
    $id = $_SESSION["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $profile_pic = $_FILES["profile_pic"]["name"];
    move_uploaded_file(
        $_FILES["profile_pic"]["tmp_name"],
        "assets/img/avatars/admin/" . $_FILES["profile_pic"]["name"]
    );
    $password = sha1(md5($_POST["password"]));
    $query =
        "UPDATE iL_sudo SET username=?, email=?, profile_pic=?, phone =?, password=?  WHERE id =?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        "sssssi",
        $username,
        $email,
        $profile_pic,
        $phone,
        $password,
        $id
    );
    $stmt->execute();
    if ($stmt) {
        $success =
            "Super User Account Updated" && header("refresh:1;url=profile.php");
    } else {
        $err =
            "Please Try Again Or Try Later" &&
            header("refresh:1;url=profile.php");
    }
}
?>    
<!doctype html>
<!DOCTYPE html>
<html lang="en">

<?php include "assets/inc/head.php"; ?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
        <?php include "assets/inc/nav.php"; ?>
        <?php
        include "assets/inc/sidebar.php";
        $id = $_SESSION["id"];
        $ret = "SELECT * FROM  iL_sudo  WHERE id = ? ";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) {
            if ($row->profile_pic == "") {
                $profile_picture = "

                        <img src='assets/img/avatars/user_icon.png' alt='User Image'>
                        ";
            } else {
                $profile_picture = "
                        <img src='assets/img/avatars/admin/$row->profile_pic' alt='user avatar'/>
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
                                        
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div class="user_avatar_controls">
                                           
                                            <a href="#" class="btn-file fileinput-exists" data-dismiss="fileinput"><i class="material-icons">&#xE5CD;</i></a>
                                        </div>
                                    </div>
                                    <div class="user_heading_content">
                                        <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"><?php echo $row->username; ?></span><span class="sub-heading" id="user_edit_position">Admin</span></h2>
                                    </div>

                                </div>
                                <div class="user_content">
                                    <ul id="user_edit_tabs" class="uk-tab" data-uk-tab="{connect:'#user_edit_tabs_content'}">
                                        <li class="uk-active"><a href="#"><?php echo $row->username; ?> Update Your Sudo Account</a></li>
                                    </ul>
                                    <ul id="user_edit_tabs_content" class="uk-switcher uk-margin">
                                        <li>
                                            <div class="uk-margin-top">
                                                <h3 class="full_width_in_card heading_c">
                                                    Profile info
                                                </h3>

                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_uname_control">User name</label>
                                                        <input class="md-input" required type="text" name="username" value="<?php echo $row->username; ?>" />
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_position_control">Email</label>
                                                        <input class="md-input" required type="email" value="<?php echo $row->email; ?>"  name="email" />
                                                    </div>
                                                    <div class="uk-width-medium-1-3">
                                                        <label for="user_edit_position_control">Phone Number</label>
                                                        <input type="text" required class="md-input" name="phone" value="<?php echo $row->phone; ?>" />
                                                    </div>
                                                </div>
                                                <div class="uk-grid" data-uk-grid-margin>   
                                                        <div class="uk-width-medium-1-3">
                                                            <label for="user_edit_uname_control">Old Password</label>
                                                            <input class="md-input" type="password" required  />
                                                        </div>
                                                        <div class="uk-width-medium-1-3">
                                                            <label for="user_edit_position_control">New Password</label>
                                                            <input class="md-input" type="password"  required  name="password" />
                                                        </div>
                                                        <div class="uk-width-medium-1-3">
                                                            <label for="user_edit_position_control">Confirm New Password</label>
                                                            <input type="password" class="md-input" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="uk-grid">
                                                   
                                                </div>
                                                <div class="uk-grid">
                                                    <div class="uk-width-1-1">
                                                        <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                                            <div>
                                                                <div class="uk-input-group">
                                                                    <input type="submit" class="md-btn md-btn-success" name="sudo_update" value="Update Profile" />
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