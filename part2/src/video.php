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
    echo "Database connection succeeded!<br>";
}
?>

<form action="./video.php"
    method = "post">
    <p><input type="submit" name="Delete" value="delete all videos"></p>
    <fieldset>
        <legend>Add a video</legend>
        <p>Name: <input type="text" name="name">
            Category: <input type="text" name="category">
            Length: <input type="text" name="length">
                    <input type="submit" name="AddVideo" value="add a video"></p>
    </fieldset>
</form>

<?php

//check request method
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($_POST['Delete']) && $_POST['Delete'] == 'delete all videos'){
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

    if (!empty($_POST['AddVideo']) && $_POST['AddVideo'] == 'add a video'){
        foreach($_POST as $key => $value){
            echo "KEY $key, VALUE $value <br>";
        }
        if(!($stmt = $mysqli->prepare("INSERT INTO videos(name, category, length)
                VALUES (?, ?, ?)
                "))) {
            echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
        }
        if(!$stmt->bind_param("ssi", $_POST['name'], $_POST['category'], $_POST['length'])){
            echo "Bind failed: " .$stmt->errno." ".$stmt->error;
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