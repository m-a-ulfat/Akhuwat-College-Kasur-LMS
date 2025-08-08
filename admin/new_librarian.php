<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();
$length = 5;
$Number = substr(str_shuffle("0123456789"), 1, $length);
if (isset($_POST["add_librarian"])) {
    $error = 0;
    if (isset($_POST["l_name"]) && !empty($_POST["l_name"])) {
        $l_name = mysqli_real_escape_string($mysqli, trim($_POST["l_name"]));
    } else {
        $error = 1;
        $err = "Librarian name cannot be empty";
    }
    if (isset($_POST["l_email"]) && !empty($_POST["l_email"])) {
        $l_email = mysqli_real_escape_string($mysqli, trim($_POST["l_email"]));
    } else {
        $error = 1;
        $err = "Librarian email cannot be empty";
    }
    if (isset($_POST["l_number"]) && !empty($_POST["l_number"])) {
        $l_number = mysqli_real_escape_string(
            $mysqli,
            trim($_POST["l_number"])
        );
    } else {
        $error = 1;
        $err = "Librarian email cannot be empty";
    }
    if (!$error) {
        $sql = "SELECT * FROM  iL_Librarians WHERE  l_number='$l_number' || l_email ='$l_email' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($l_number == $row["l_number"]) {
                $err = "Librarian number already exists";
            } else {
                $err = "Librarian email already exists";
            }
        } else {
            $l_number = $_POST["l_number"];
            $l_name = $_POST["l_name"];
            $l_phone = $_POST["l_phone"];
            $l_email = $_POST["l_email"];
            $l_pwd = sha1(md5($_POST["l_pwd"]));
            $l_adr = $_POST["l_adr"];
            $l_bio = $_POST["l_bio"];
            $l_acc_status = $_POST["l_acc_status"];
            $query =
                "INSERT INTO iL_Librarians (l_number, l_name, l_phone, l_email, l_pwd, l_adr, l_bio, l_acc_status) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                "ssssssss",
                $l_number,
                $l_name,
                $l_phone,
                $l_email,
                $l_pwd,
                $l_adr,
                $l_bio,
                $l_acc_status
            );
            $stmt->execute();
            if ($stmt) {
                $success = "Librarian Account Created";
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
                <li><a href="#">Librarians</a></li>
                <li><span>New Librarian Account</span></li>
            </ul>
        </div>

        <div id="page_content_inner">
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Please Fill All Fields</h3>
                    <hr>
                    <form id="librarianForm" method="post" onsubmit="return validateForm()">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>Librarian Full Name</label>
                                    <input type="text" id="l_name" name="l_name" class="md-input" required oninput="validateName()" />
                                    <span id="l_name_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Librarian Number</label>
                                    <input type="number" id="l_number" name="l_number" class="md-input" required oninput="validateNumber()" />
                                    <span id="l_number_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Librarian Email</label>
                                    <input type="email" id="l_email" name="l_email" class="md-input" required oninput="validateEmail()" />
                                    <span id="l_email_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row" style="display:none">
                                    <label>Librarian Account Status</label>
                                    <input type="text" required name="l_acc_status" value="Active" class="md-input" />
                                </div>
                            </div>

                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <label>Librarian Phone Number</label>
                                    <input type="text" id="l_phone" name="l_phone" class="md-input" required oninput="validatePhone()" />
                                    <span id="l_phone_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Librarian Address</label>
                                    <input type="text" id="l_adr" name="l_adr" class="md-input" required oninput="validateAddress()" />
                                    <span id="l_adr_error" class="error-message"></span>
                                </div>
                                <div class="uk-form-row">
                                    <label>Librarian Password</label>
                                    <input type="password" id="l_pwd" name="l_pwd" class="md-input" required oninput="validatePassword()" />
                                    <span id="l_pwd_error" class="error-message"></span>
                                </div>
                            </div>

                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <label>Librarian Bio | About</label>
                                    <textarea cols="30" rows="4" id="l_bio" class="md-input" name="l_bio"></textarea>
                                    <span id="l_bio_error" class="error-message"></span>
                                </div>
                            </div>

                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <input type="submit" class="md-btn md-btn-success" name="add_librarian" value="Create Librarian Account" />
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
                            display: block;
                            margin-top: 5px;
                        }

                        .md-input {
                            border: 1px solid #ccc;
                            padding: 10px;
                            width: 100%;
                            border-radius: 5px;
                            margin-bottom: 10px;
                        }

                        .md-input.invalid {
                            border-color: red;
                        }

                        .md-input.valid {
                            border-color: green;
                        }

                        label {
                            font-weight: bold;
                        }

                        .md-btn {
                            padding: 10px 20px;
                            background-color: #28a745;
                            color: white;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }

                        .md-btn:hover {
                            background-color: #218838;
                        }
                    </style>

                    <script>
                        // Validate Name
                        function validateName() {
                            const name = document.getElementById('l_name').value;
                            const nameError = document.getElementById('l_name_error');
                            const nameInput = document.getElementById('l_name');
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
                            const email = document.getElementById('l_email').value;
                            const emailError = document.getElementById('l_email_error');
                            const emailInput = document.getElementById('l_email');
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

                        // Validate Phone Number
                        function validatePhone() {
                            const phone = document.getElementById('l_phone').value;
                            const phoneError = document.getElementById('l_phone_error');
                            const phoneInput = document.getElementById('l_phone');
                            const regex = /^[0-9]{11}$/;
                            if (!regex.test(phone)) {
                                phoneError.textContent = "Please enter a valid phone number (11 digits) e.g 03017319619.";
                                phoneInput.classList.add('invalid');
                                phoneInput.classList.remove('valid');
                            } else {
                                phoneError.textContent = "";
                                phoneInput.classList.remove('invalid');
                                phoneInput.classList.add('valid');
                            }
                        }

                        // Validate Number (Librarian Number)
                        function validateNumber() {
                            const number = document.getElementById('l_number').value;
                            const numberError = document.getElementById('l_number_error');
                            const numberInput = document.getElementById('l_number');
                            if (number.length < 5) {
                                numberError.textContent = "Librarian number should be at least 5 digits.";
                                numberInput.classList.add('invalid');
                                numberInput.classList.remove('valid');
                            } else {
                                numberError.textContent = "";
                                numberInput.classList.remove('invalid');
                                numberInput.classList.add('valid');
                            }
                        }

                        // Validate Address
                        function validateAddress() {
                            const address = document.getElementById('l_adr').value;
                            const addressError = document.getElementById('l_adr_error');
                            const addressInput = document.getElementById('l_adr');
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

                        // Validate Password
                        function validatePassword() {
                            const password = document.getElementById('l_pwd').value;
                            const passwordError = document.getElementById('l_pwd_error');
                            const passwordInput = document.getElementById('l_pwd');
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

                        // Overall form validation before submit
                        function validateForm() {
                            // Ensure all fields are valid
                            validateName();
                            validateEmail();
                            validatePhone();
                            validateNumber();
                            validateAddress();
                            validatePassword();

                            // Check if there are any error messages or invalid fields
                            const invalidFields = document.querySelectorAll('.invalid');
                            if (invalidFields.length > 0) {
                                return false; // Prevent form submission
                            }

                            return true; // Allow form submission
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>
