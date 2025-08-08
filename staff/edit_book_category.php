<?php 
    session_start();
    include('assets/inc/config.php');
    include('assets/inc/checklogin.php');
    check_login();

    //update a book category
    if(isset($_POST['update_book_category']))
    {
        $category_code = $_GET['category_code'];
        $bc_name = $_POST['bc_name'];
        $bc_desc = $_POST['bc_desc'];
        
        //Insert Captured information to a database table
        $query="UPDATE iL_BookCategories SET bc_name=?, bc_desc=? WHERE bc_code =?";
        $stmt = $mysqli->prepare($query);
        //bind paramaters
        $rc=$stmt->bind_param('sss',  $bc_name, $bc_desc, $category_code);
        $stmt->execute();
  
        //declare a varible which will be passed to alert function
        if($stmt)
        {
            $success = "Book Category Updated" && header("refresh:1;url=manage_categories.php");
        }
        else 
        {
            $err = "Please Try Again Or Try Later";
        }      
    }
?>

<!doctype html>
<html lang="en">
<?php
    include("assets/inc/head.php");
?>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
        <?php 
            include("assets/inc/nav.php");
        ?>
        <?php
            include("assets/inc/sidebar.php");
        ?>
    <?php 
        $category_code = $_GET['category_code'];
        $ret="SELECT * FROM  iL_BookCategories WHERE bc_code = ?"; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->bind_param('s', $category_code);
        $stmt->execute() ;//ok
        $res=$stmt->get_result();
        while($row=$res->fetch_object())
    {
    ?>
    <div id="page_content">
        <!--Breadcrums-->
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_categories.php">Books Inventory</a></li>
                <li><span>Update <?php echo $row->bc_name;?></span></li>
            </ul>
        </div>

        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a">Please Fill All Fields</h3>
                    <hr>
                    <form method="post">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <label>Book Category Name</label>
                                    <input type="text" required name="bc_name" value="<?php echo $row->bc_name;?>" class="md-input" />
                                </div>
                                <div class="uk-form-row">
                                    <label>Book Category Code</label>
                                    <input type="text" required readonly value="<?php echo $row->bc_code;?> " name="bc_code" class="md-input label-fixed" />
                                </div>
                               
                            </div>

                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <label>Book Category Description</label>
                                    <textarea cols="30" rows="4" class="md-input" name="bc_desc"><?php echo $row->bc_desc;?></textarea>
                                </div>
                            </div>
                            <div class="uk-width-medium-2-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <input type="submit" class="md-btn md-btn-success" name="update_book_category" value="Update  Book Category" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <?php require_once('assets/inc/footer.php');?>
</body>
</html>