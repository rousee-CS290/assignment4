<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <title>Video Store</title>
  </head>
  <body>
<?php
// turn on error reporting
ini_set('display_errors', 'On');
include 'pass.php';
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "rousee-db", $db_pass, "rousee-db");

if ($mysqli->connect_errno){
    echo "Database connection failed: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
} else {
    echo "Databse connection succeeded!<br>";
}

?>
  </body>
</html>