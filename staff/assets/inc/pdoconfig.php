<?php
// Database host 
$DB_host = "localhost";

// Database user 
$DB_user = "root";

// Database password
$DB_pass = "";

// Database name 
$DB_name = "Library";

try
{
    // Attempt to establish a connection to the database using PDO (PHP Data Objects)
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
    
    // Set PDO to throw exceptions for any database errors
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    // If the connection fails, get the error message
    $e->getMessage();
}
?>
