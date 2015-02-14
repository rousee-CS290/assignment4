<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <title>Video Store</title>
    <link rel='stylesheet' href='./style.css' type='text/css' media='all' />
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
        <legend>Add a Video</legend>
        <p>Name: <input type="text" name="name">
            Category: <input type="text" name="category">
            Length: <input type="text" name="length">
                    <input type="submit" name="AddVideo" value="add a video"></p>
    </fieldset>
</form>
<?php
    echo "<fieldset>
        <legend>Video List</legend>
        <table>
            
            <tr>
                <th>id#
                <th>Name
                <th>Category
                <th>Length
                <th>Checked out
                <th>Delete
                <th>Check-In/Check-Out
            </tr>";
            if(!($stmt = $mysqli->prepare("SELECT v.id, v.name, v.category, v.length, v.rented
                    FROM videos AS v
                    "))){
                echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
            }
            if(!$stmt->execute()){
                echo "Execute failed: " .$stmt->errno." ".$stmt->error;
            }
            if(!$stmt->bind_result($id, $name, $category, $length, $rented)){
                echo "Bind failed: " .$stmt->errno." ".$stmt->error;
            }
            while($stmt->fetch()){
                echo "<tr>\n<td>\n".$id."\n<td>".$name."\n<td>".$category."\n<td>".$length."\n<td>".$rented;
                echo '<form action="./video.php"
                          method = "post">
                          <td><input type="submit" value="Delete" name="'.$id.'">
                        </form>';
                echo '<form action="./video.php"
                          method = "post">
                          <td><input type="submit" value="CheckIn/Out" name="'.$id.'">
                        </form>';
                echo "</tr>";
            }
            $stmt->close();
    echo "</table>
    </fieldset>";
?>


<?php

//check request method
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //delete all videos button
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
    //add a video section
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