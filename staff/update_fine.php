<?php
session_start();
include "assets/inc/config.php";
include "assets/inc/checklogin.php";
check_login();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id) {
    $status = $_POST['status'];
    $stmt = $mysqli->prepare("UPDATE iL_Fines SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        $success = "Fine updated successfully!";
    } else {
        $err = "Failed to update fine.";
    }
}

$fine = $mysqli->query("SELECT * FROM iL_Fines WHERE id = $id")->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<?php include "assets/inc/head.php"; ?>
<body>
    <?php include "assets/inc/nav.php"; ?>
    <?php include "assets/inc/sidebar.php"; ?>

    <div id="page_content">
        <div id="page_content_inner">
            <h2>Update Fine</h2>
            <?php if (isset($success)) { echo "<div class='uk-alert uk-alert-success'>$success</div>"; } ?>
            <?php if (isset($err)) { echo "<div class='uk-alert uk-alert-danger'>$err</div>"; } ?>

            <form method="post" action="">
                <div class="uk-margin">
                    <label for="status">Fine Status:</label>
                    <select name="status" id="status" required>
                        <option value="Paid" <?php if ($fine['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                        <option value="Unpaid" <?php if ($fine['status'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                    </select>
                </div>
                <button type="submit" class="uk-button uk-button-primary">Update Fine</button>
            </form>
        </div>
    </div>

    <?php include "assets/inc/footer.php"; ?>
</body>
</html>