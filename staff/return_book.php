<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

//generate libratu operation  number
$length = 6;
$Number = substr(str_shuffle("0123456789"), 1, $length);
$length = 20;
$checksum = substr(str_shuffle("qwertyuioplkjhgfdsazxcvbnm"), 1, $length);

//return_book
if (isset($_POST["return_book"])) {
    $lo_status = $_GET["lo_status"];
    $b_id = $_GET["b_id"];
    $lo_id = $_GET["lo_id"];
    $b_copies = $_POST["b_copies"];

    //---Post a notification that someone has returned a book--//
    $content = $_POST["content"];
    $user_id = $_SESSION["l_id"];

    //Insert Captured information to a database table -->insert to library operations table
    $query = "UPDATE  iL_LibraryOperations SET lo_status = ? WHERE lo_id = ? ";
    //update book table and add one book
    $book_borrow = "UPDATE iL_Books SET b_copies = ? WHERE  b_id = ?";
    //give a notification that some one has borrowed a book
    $notif = "INSERT INTO iL_notifications (content,user_id) VALUES(?,?)";

    $stmt1 = $mysqli->prepare($book_borrow);
    $stmt = $mysqli->prepare($query);
    $stmt2 = $mysqli->prepare($notif);

    //bind paramaters
    $rc = $stmt->bind_param("si", $lo_status, $lo_id);
    $rc = $stmt1->bind_param("si", $b_copies, $b_id);
    $rc = $stmt2->bind_param("si", $content, $user_id);

    $stmt->execute();
    $stmt1->execute();
    $stmt2->execute();

    //declare a varible which will be passed to alert function
    if ($stmt && $stmt1 && $stmt2) {
        $success =
            "Book Returned" &&
            header("refresh:1;url=new_library_book_return_operation.php");
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
        <?php include "assets/inc/sidebar.php"; ?>
    <div id="page_content">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="new_library_book_return_operation.php">Library Operations</a></li>
                    <li><span>Return Book</span></li>
                </ul>
            </div>

        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Please Fill All Fields</h3>
                    <hr>
                    <?php
                    $b_id = $_GET["b_id"];
                    $ret = "SELECT * FROM  iL_Books WHERE b_id =?";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->bind_param("i", $b_id);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    while ($row = $res->fetch_object()) {

                        //decrement book count by one
                        $initialBookCount = $row->b_copies;
                        $newBookCount = $initialBookCount + 1;
                        ?>

                        <form method="post">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Book Title</label>
                                        <input type="text" value="<?php echo $row->b_title; ?>" required name="b_title" class="md-input" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Book ISBN No</label>
                                        <input type="text" required value="<?php echo $row->b_isbn_no; ?>" name="b_isbn_no" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Book Category</label>
                                        <input type="text" required name="bc_name" value="<?php echo $row->bc_name; ?>" class="md-input"  />
                                    </div>
                                    <!--Notification Content-->
                                    <div class="uk-form-row" style="display:none">
                                        <label>Content</label>
                                        <input type="text" required name="content" value="<?php echo $row->b_title; ?>, ISBN NO: <?php echo $row->b_isbn_no; ?> Has been returned" class="md-input"  />
                                    </div>
                                    
                                </div>

                                <?php
                                $lo_id = $_GET["lo_id"];
                                $ret =
                                    "SELECT * FROM  iL_LibraryOperations WHERE lo_id =?";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->bind_param("i", $lo_id);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($row = $res->fetch_object()) {
                                    //trim borrowed date timestamp to DD/MM/YYYY
                                    $borrowed_date = $row->created_at; ?>

                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Library Operation Number</label>
                                        <input type="text" required class="md-input" readonly name="lo_number" value=<?php echo $row->lo_number; ?> />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Library Operation Checksum</label>
                                        <input type="text" required class="md-input" readonly name="lo_checksum" value=<?php echo $row->lo_checksum; ?> />
                                    </div>
                                    
                                    <div class="uk-form-row" style="display:none">
                                        <label>Remaining Book Copies</label>
                                        <input type="text" value="<?php echo $newBookCount; ?>" required name="b_copies" class="md-input"  />
                                    </div>
                                    
                                    <div class="uk-form-row" style="display:non">
                                        <label>Student Name</label>
                                        <input type="text" value="<?php echo $row->s_name; ?>" required name="s_name" class="md-input"  />
                                    </div>

                                    <div class="uk-form-row" style="display:non">
                                        <label>Student Number</label>
                                        <input type="text" value="<?php echo $row->s_number; ?>" required name="s_number" class="md-input"  />
                                    </div>

                                    <div class="uk-form-row" style="display:non">
                                        <label>Date Borowed</label>
                                        <input type="text" value="<?php echo date(
                                            "d-M-Y",
                                            strtotime($borrowed_date)
                                        ); ?>" required name="s_number" class="md-input"  />
                                    </div>


                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <input type="submit" class="md-btn md-btn-success" name="return_book" value="Return Book" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                                }

                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <!--Footer-->
    <?php require_once "assets/inc/footer.php"; ?>
</body>
</html>