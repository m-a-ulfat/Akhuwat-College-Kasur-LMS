<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
//generate random student number
$length = 5;
$Number = substr(str_shuffle("0123456789"), 1, $length);

//create a student account
if (isset($_POST["add_student"])) {
    $error = 0;
    if (isset($_POST["s_name"]) && !empty($_POST["s_name"])) {
        $s_name = mysqli_real_escape_string($mysqli, trim($_POST["s_name"]));
    } else {
        $error = 1;
        $err = "Student name cannot be empty";
    }
    if (isset($_POST["s_email"]) && !empty($_POST["s_email"])) {
        $s_email = mysqli_real_escape_string($mysqli, trim($_POST["s_email"]));
    } else {
        $error = 1;
        $err = "Student email cannot be empty";
    }
    if (isset($_POST["s_number"]) && !empty($_POST["s_number"])) {
        $s_number = mysqli_real_escape_string(
            $mysqli,
            trim($_POST["s_number"])
        );
    } else {
        $error = 1;
        $err = "Student email cannot be empty";
    }
    if (!$error) {
        $sql = "SELECT * FROM  iL_Students WHERE  s_number='$s_number' || s_email ='$s_email' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($s_number == $row["s_number"]) {
                $err = "Student number already exists";
            } else {
                $err = "Student email already exists";
            }
        } else {
            $s_name = $_POST["s_name"];
            $s_number = $_POST["s_number"];
            $s_email = $_POST["s_email"];
            $s_pwd = sha1(md5($_POST["s_pwd"]));
            $s_sex = $_POST["s_sex"];
            $s_phone = $_POST["s_phone"];
            $s_bio = $_POST["s_bio"];
            $s_adr = $_POST["s_adr"];
            $s_acc_status = $_POST["s_acc_status"];

            //Insert Captured information to a database table
            $query =
                "INSERT INTO iL_Students (s_name, s_number, s_email, s_pwd, s_sex, s_phone, s_bio, s_adr, s_acc_status) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            //bind paramaters
            $rc = $stmt->bind_param(
                "sssssssss",
                $s_name,
                $s_number,
                $s_email,
                $s_pwd,
                $s_sex,
                $s_phone,
                $s_bio,
                $s_adr,
                $s_acc_status
            );
            $stmt->execute();

            //declare a varible which will be passed to alert function
            if ($stmt) {
                $success = "Student Account Created";
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
                <li><a href="#">Students</a></li>
                <li><span>New Student Account</span></li>
            </ul>
        </div>
        <div id="page_content_inner">
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Please Fill All Fields</h3>
                    <hr>
                    <form method="post" onsubmit="return validateForm()">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>Student Full Name</label>
                                    <input type="text" id="s_name" name="s_name" class="md-input" required oninput="validateName()" />
                                    <span id="s_name_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Student Number</label>
                                    <input type="text" id="s_number" name="s_number" class="md-input" oninput="validateNumber()" />
                                    <span id="s_number_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Student Email</label>
                                    <input type="email" id="s_email" name="s_email" class="md-input" required oninput="validateEmail()" />
                                    <span id="s_email_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row" style="display:none">
                                    <label>Student Account Status</label>
                                    <input type="text" name="s_acc_status" value="Active" class="md-input" required />
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>Student Phone Number</label>
                                    <input type="text" id="s_phone" name="s_phone" class="md-input" required oninput="validatePhone()" />
                                    <span id="s_phone_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Student Address</label>
                                    <input type="text" id="s_adr" name="s_adr" class="md-input" required oninput="validateAddress()" />
                                    <span id="s_adr_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Student Password</label>
                                    <input type="password" id="s_pwd" name="s_pwd" class="md-input" required oninput="validatePassword()" />
                                    <span id="s_pwd_error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <label>Student Gender</label>
                                    <select id="s_sex" name="s_sex" class="md-input" required oninput="validateGender()">
                                        <option>Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <span id="s_sex_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Student Bio | About</label>
                                    <textarea cols="30" rows="4" id="s_bio" class="md-input" name="s_bio"></textarea>
                                    <span id="s_bio_error" class="error-message"></span>
                                </div>
                            </div>
                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <input type="submit" class="md-btn md-btn-success" name="add_student" value="Create Student Account" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Inline Error Styling -->
                    <style>
                        .error-message {
                            color: red;
                            font-size: 12px;
                        }

                        .md-input.invalid {
                            border-color: red;
                        }

                        .md-input.valid {
                            border-color: green;
                        }
                    </style>

                    <script>
                        // Validate Name (min 3 characters)
                        function validateName() {
                            const name = document.getElementById('s_name').value;
                            const nameError = document.getElementById('s_name_error');
                            const nameInput = document.getElementById('s_name');
                            if (name.trim().length < 3) {
                                nameError.textContent = "Name must be at least 3 characters.";
                                nameInput.classList.add('invalid');
                                nameInput.classList.remove('valid');
                            } else {
                                nameError.textContent = "";
                                nameInput.classList.remove('invalid');
                                nameInput.classList.add('valid');
                            }
                        }

                        // Validate Email
                        function validateEmail() {
                            const email = document.getElementById('s_email').value;
                            const emailError = document.getElementById('s_email_error');
                            const emailInput = document.getElementById('s_email');
                            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!regex.test(email)) {
                                emailError.textContent = "Please enter a valid email address.";
                                emailInput.classList.add('invalid');
                                emailInput.classList.remove('valid');
                            } else {
                                emailError.textContent = "";
                                emailInput.classList.remove('invalid');
                                emailInput.classList.add('valid');
                            }
                        }

                        // Validate Phone Number (11 digits)
                        function validatePhone() {
                            const phone = document.getElementById('s_phone').value;
                            const phoneError = document.getElementById('s_phone_error');
                            const phoneInput = document.getElementById('s_phone');
                            const regex = /^[0-9]{11}$/; // Validates numbers 11 digits
                            if (!regex.test(phone)) {
                                phoneError.textContent = "Please enter a valid phone number (11 digits).";
                                phoneInput.classList.add('invalid');
                                phoneInput.classList.remove('valid');
                            } else {
                                phoneError.textContent = "";
                                phoneInput.classList.remove('invalid');
                                phoneInput.classList.add('valid');
                            }
                        }

                        // Validate Student Number (optional, but could be used for a specific length check)
                        function validateNumber() {
                            const number = document.getElementById('s_number').value;
                            const numberError = document.getElementById('s_number_error');
                            const numberInput = document.getElementById('s_number');
                            if (number.length < 5) { // Example validation (min 5 characters)
                                numberError.textContent = "Student number should be at least 5 characters long.";
                                numberInput.classList.add('invalid');
                                numberInput.classList.remove('valid');
                            } else {
                                numberError.textContent = "";
                                numberInput.classList.remove('invalid');
                                numberInput.classList.add('valid');
                            }
                        }

                        // Validate Address (min 5 characters)
                        function validateAddress() {
                            const address = document.getElementById('s_adr').value;
                            const addressError = document.getElementById('s_adr_error');
                            const addressInput = document.getElementById('s_adr');
                            if (address.trim().length < 5) {
                                addressError.textContent = "Address should be at least 5 characters long.";
                                addressInput.classList.add('invalid');
                                addressInput.classList.remove('valid');
                            } else {
                                addressError.textContent = "";
                                addressInput.classList.remove('invalid');
                                addressInput.classList.add('valid');
                            }
                        }

                        // Validate Password (min 6 characters)
                        function validatePassword() {
                            const password = document.getElementById('s_pwd').value;
                            const passwordError = document.getElementById('s_pwd_error');
                            const passwordInput = document.getElementById('s_pwd');
                            if (password.length < 6) {
                                passwordError.textContent = "Password should be at least 6 characters long.";
                                passwordInput.classList.add('invalid');
                                passwordInput.classList.remove('valid');
                            } else {
                                passwordError.textContent = "";
                                passwordInput.classList.remove('invalid');
                                passwordInput.classList.add('valid');
                            }
                        }

                        // Validate Gender Selection
                        function validateGender() {
                            const gender = document.getElementById('s_sex').value;
                            const genderError = document.getElementById('s_sex_error');
                            const genderInput = document.getElementById('s_sex');
                            if (gender === 'Select Gender') {
                                genderError.textContent = "Please select a gender.";
                                genderInput.classList.add('invalid');
                                genderInput.classList.remove('valid');
                            } else {
                                genderError.textContent = "";
                                genderInput.classList.remove('invalid');
                                genderInput.classList.add('valid');
                            }
                        }

                        // Overall form validation before submit
                        function validateForm() {
                            // Ensure all fields are valid
                            validateName();
                            validateEmail();
                            validatePhone();
                            validateNumber();
                            validateAddress();
                            validatePassword();
                            validateGender();

                            // Check if there are any error messages
                            const errors = document.querySelectorAll('.error-message');
                            for (const error of errors) {
                                if (error.textContent.trim() !== '') {
                                    return false; // If any error exists, prevent form submission
                                }
                            }
                            return true; // Allow form submission if no errors
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>