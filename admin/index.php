<?php
session_start();
include "assets/inc/config.php";
if (isset($_POST["sudo_login"])) {
    $email = $_POST["email"];
    $password = sha1(md5($_POST["password"]));
    $stmt = $mysqli->prepare(
        "SELECT email, password, id  FROM iL_sudo  WHERE email=? AND password=?"
    );
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($email, $password, $id);
    $rs = $stmt->fetch();
    $_SESSION["id"] = $id;
    if ($rs) {
        header("location:dashboard.php");
    } else {
        $err = "Access Denied Please Check Your Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<head>
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
    <script>
        // Function to validate the login form
        function validateLoginForm() {
            var email = document.getElementById("login_username").value;
            var password = document.getElementById("login_password").value;
            var errorMessage = "";

            // Check if the email is empty or invalid
            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (email === "") {
                errorMessage = "Email is required.";
            } else if (!emailRegex.test(email)) {
                errorMessage = "Please enter a valid email address.";
            }

            // Check if the password is empty
            if (password === "") {
                if (errorMessage) errorMessage += "<br>";
                errorMessage += "Password is required.";
            }

            // If there is an error, display the error message and prevent form submission
            if (errorMessage) {
                document.getElementById("error-message").innerHTML = errorMessage;
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
</head>
<body class="login_page">
    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <h2>Library Admin Login</h2>
                </div>
                
                <!-- Error message container -->
                <div id="error-message" class="message"></div>

                <form method="post" onsubmit="return validateLoginForm()">
                    <div class="uk-form-row">
                        <label for="login_username">Email</label>
                        <input class="md-input" type="email" id="login_username" name="email" required />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="password" required />
                    </div>
                    <div class="uk-margin-medium-top">
                        <input type="submit" name="sudo_login" value="Sign In" class="md-btn md-btn-primary md-btn-block md-btn-large"/>
                    </div>
                </form>
            </div>
            <div class="uk-margin-top uk-text-center">
                <a href="../">Home</a>
            </div>
        </div>
    </div>
</body>
</html>
