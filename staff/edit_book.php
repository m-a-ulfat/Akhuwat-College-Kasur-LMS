<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

//generate random isbn number
$length = 6;
$Number = substr(str_shuffle("0123456789"), 1, $length);

//edit book
if (isset($_POST["update_book"])) {
    $book_id = $_GET["book_id"];
    $b_title = $_POST["b_title"];
    $b_author = $_POST["b_author"];
    $b_isbn_no = $_POST["b_isbn_no"];
    $b_publisher = $_POST["b_publisher"];
    $bc_id = $_POST["bc_id"];
    $bc_name = $_POST["bc_name"];
    $b_status = $_POST["b_status"];
    $b_summary = $_POST["b_summary"];
    $b_copies = $_POST["b_copies"];

    $b_coverimage = $_FILES["b_coverimage"]["name"];
    move_uploaded_file(
        $_FILES["b_coverimage"]["tmp_name"],
        "../admin/assets/img/books/" . $_FILES["b_coverimage"]["name"]
    );

    //Insert Captured information to a database table
    $query =
        "UPDATE  iL_Books  SET b_title=?, b_author=?, b_isbn_no=?, b_publisher=?, bc_id=?, bc_name=?, b_status=?, b_summary=?, b_copies =?, b_coverimage=? WHERE b_id =?";
    $stmt = $mysqli->prepare($query);
    //bind paramaters
    $rc = $stmt->bind_param(
        "ssssssssssi",
        $b_title,
        $b_author,
        $b_isbn_no,
        $b_publisher,
        $bc_id,
        $bc_name,
        $b_status,
        $b_summary,
        $b_copies,
        $b_coverimage,
        $book_id
    );
    $stmt->execute();

    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success =
            "Book Record Updated" && header("refresh:1;url=manage_books.php");
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
    <?php
    $book_id = $_GET["book_id"];
    $ret = "SELECT * FROM  iL_Books WHERE b_id = ?";
    $stmt = $mysqli->prepare($ret);
    $stmt->bind_param("i", $book_id);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) { ?>
        <div id="page_content">
            <!--Breadcrums-->
                <div id="top_bar">
                    <ul id="breadcrumbs">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="manage_books.php">Book Inventory</a></li>
                        <li><span>Update Book</span></li>
                    </ul>
                </div>

            <div id="page_content_inner">

                <div class="md-card">
                    <div class="md-card-content">
                        <h3 class="heading_a">Please Fill All Fields</h3>
                        <hr>
                        <form method="post" enctype="multipart/form-data">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <div class="uk-form-row">
                                        <label>Book Title</label>
                                        <input type="text" value="<?php echo $row->b_title; ?>" required name="b_title" class="md-input" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Book ISBN No</label>
                                        <input type="text" required value="<?php echo $row->b_isbn_no; ?>" name="b_isbn_no" class="md-input label-fixed" />
                                    </div>
                                    <div class="uk-form-row">
                                        <label>Book Author</label>
                                        <input type="text" value="<?php echo $row->b_author; ?>" required name="b_author" class="md-input"  />
                                    </div>
                                    <div class="uk-form-row" style="display:none">
                                        <label>Book Status</label>
                                        <input type="text" required name="b_status" value="Available" class="md-input"  />
                                    </div>
                                </div>

                                <div class="uk-width-medium-1-2">
                                    <div class="uk-form-row">
                                        <label>Book Publisher</label>
                                        <input type="text" value="<?php echo $row->b_publisher; ?>" required class="md-input" name="b_publisher" />
                                    </div>

                                    <div class="uk-form-row">
                                        <label>Number Of Copies</label>
                                        <input type="text" value="<?php echo $row->b_copies; ?>" required name="b_copies" class="md-input"  />
                                    </div>
                                    
                                    <div class="uk-form-row">
                                        <label>Book Category</label>
                                                <select required onChange="getBookId(this.value);" name="bc_name" class="md-input"  />
                                                <option>Select Book Category</option>
                                                    <?php
                                                    $ret =
                                                        "SELECT * FROM  iL_BookCategories";
                                                    $stmt = $mysqli->prepare(
                                                        $ret
                                                    );
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

                                    <div class="uk-form-row" style="display:none">
                                        <label>Book Category ID</label>
                                        <input type="text" id="BookCategoryID" required name="bc_id" class="md-input"  />
                                    </div>
                                    

                                </div>

                                <div class="uk-width-medium-2-2">
                                    <div id="file_upload-drop" class="uk-file-upload">
                                        <p class="uk-text">Drop Book Cover Image</p>
                                        <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                        <a class="uk-form-file md-btn">Choose File<input id="file_upload-select" name="b_coverimage" type="file"></a>
                                    </div>
                                </div>

                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <label>Book Cover Page Summary</label>
                                        <?php
                                        $book_id = $_GET["book_id"];
                                        $ret =
                                            "SELECT * FROM  iL_Books WHERE b_id = ?";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->bind_param("i", $book_id);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_object()) { ?>
                                            <textarea cols="30" rows="10" class="md-input" name="b_summary"><?php echo $row->b_summary; ?></textarea>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                                <div class="uk-width-medium-2-2">
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <input type="submit" class="md-btn md-btn-success" name="update_book" value="Update Book" />
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