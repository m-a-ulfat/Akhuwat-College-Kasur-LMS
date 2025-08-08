<?php
session_start();
unset($_SESSION["l_id"]);
session_destroy();
header("Location: index.php");
exit();
?>
