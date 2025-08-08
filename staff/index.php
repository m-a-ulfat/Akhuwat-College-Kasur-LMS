<?php
session_start();
include "assets/inc/config.php";

//signin
if (isset($_POST["staff_login"])) {
    $l_email = $_POST["l_email"];
    $l_pwd = sha1(md5($_POST["l_pwd"])); //double encrypt to increase security
    $stmt = $mysqli->prepare(
        "SELECT l_email, l_number, l_pwd, l_id  FROM iL_Librarians  WHERE (l_email=? || l_number =?) AND l_pwd=?"
    ); //sql to log in user
    $stmt->bind_param("sss", $l_email, $l_email, $l_pwd); //bind fetched parameters
    $stmt->execute(); //execute bind
    $stmt->bind_result($l_email, $l_email, $l_pwd, $id); //bind result
    $rs = $stmt->fetch();
    $_SESSION["l_id"] = $id; //assaign session to sudo id

    if ($rs) {
        //if its sucessfull
        header("location:dashboard.php");
    } else {
        $err = "Access Denied Please Check Your Credentials";
    }
}
?>
<!doctype html>
<!DOCTYPE html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('assets/img/bg.jpg'); /* Replace with your background image */
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .login-container .md-input {
        width: calc(100% - 40px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .login-container .md-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .login-container .md-btn:hover {
        background-color: #45a049;
    }

    .login-container .message {
        color: red;
        margin-bottom: 10px;
    }
</style>
<body class="login_page">
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <h2>library Staff Login</h2>
                </div>
                <form method ="post">
                    <div class="uk-form-row">
                        <label for="login_username">Email or Staff Number</label>
                        <input class="md-input" required type="text" id="login_username" name="l_email" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" required type="password" id="login_password" name="l_pwd" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <input type="submit" name="staff_login" value="Sign In" class="md-btn md-btn-primary md-btn-block md-btn-large"/>
                    </div>
                    
                </form>
            </div>
            <div class="uk-margin-top uk-text-center">
            <a  href="https://mail.google.com/mail/?view=cm&fs=1&to=kashifjilani131@gmail.com&su=i&&need&&reset&&passsword&&kindly&&reset&&it&body=dear&&sir " target="_blank" id="signup_form_show">Forgot Password</a>
        </div>
        <div class="uk-margin-top uk-text-center">
            <a href="../" >Home</a>
        </div>
        </div>
    </div>
</body>
</html>