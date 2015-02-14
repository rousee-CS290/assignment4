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

<form action="./video.php"
    method = "post">
    <p><input type="submit" name="Delete" value="delete"></p>
</form>

<?php

//check request method
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($_POST) && $_POST['Delete'] == 'delete'){
        if(!($stmt = $mysqli->prepare("DELETE
                FROM videos
                "))) {
            echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: " .$stmt->errno." ".$stmt->error;
        }

        $stmt->close();
    }
}

?>
  </body>
</html>