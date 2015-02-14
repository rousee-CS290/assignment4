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
$filter_val = 0;
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
    //delete a video section
    if (!empty($_POST['DeleteRow']) && $_POST['DeleteRow'] == 'delete'){


        if(!($stmt = $mysqli->prepare("DELETE FROM videos WHERE id=?
                "))) {
            echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
        }
        if(!$stmt->bind_param("i", $_POST['DeleteRowID'])){
            echo "Bind failed: " .$stmt->errno." ".$stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: " .$stmt->errno." ".$stmt->error;
        }

        $stmt->close();
    }
    //check in/out a video section
    if (!empty($_POST['CheckInOut']) && $_POST['CheckInOut'] == 'update'){


        if(!($stmt = $mysqli->prepare("UPDATE videos
                SET rented = !rented
                WHERE id = ?
                "))) {
            echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
        }
        if(!$stmt->bind_param("i", $_POST['CheckInOutID'])){
            echo "Bind failed: " .$stmt->errno." ".$stmt->error;
        }
        if(!$stmt->execute()){
            echo "Execute failed: " .$stmt->errno." ".$stmt->error;
        }

        $stmt->close();
    }
    //filter the video section
    if (!empty($_POST['filter'])){

        if ($_POST['filter'] === '_allmovies_') {
            $filter_val = 0;
        }
        else {
            $filter_val = $_POST['filter'];
        }
    }
}

echo '<form action="./video.php"
        method = "post">
        <fieldset>
        <legend>Filter the Videos</legend>
        <select name="filter">
            <option value="_allmovies_">All Movies</option>';
            if(!($stmt = $mysqli->prepare("SELECT DISTINCT category FROM videos ORDER BY category"))){
                echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
            }
            if(!$stmt->execute()){
                echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
            }
            if(!$stmt->bind_result($category)){
                echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
            }
            while($stmt->fetch()){
             echo '<option value="'. $category .'"> ' . $category . '</option>\n';
            }
            $stmt->close();
        
echo '</select>
        <input type="submit" name="FilterVideo" value="apply filter">
    </fieldset>
    </form>';

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
            
            if ($filter_val === 0){
                echo "showing all movies";
                if(!($stmt = $mysqli->prepare("SELECT v.id, v.name, v.category, v.length, v.rented
                        FROM videos AS v
                        "))){
                    echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
                }
            } else {
                echo "showing only $filter_val type movies";
                if(!($stmt = $mysqli->prepare("SELECT v.id, v.name, v.category, v.length, v.rented
                        FROM videos AS v
                        WHERE category = ?
                        "))){
                    echo "Prepare failed: :".$stmt->errno." ".$stmt->error;
                }
                if(!$stmt->bind_param("s", $filter_val)){
                    echo "Bind failed: " .$stmt->errno." ".$stmt->error;
                }
            }
            if(!$stmt->execute()){
                echo "Execute failed: " .$stmt->errno." ".$stmt->error;
            }
            if(!$stmt->bind_result($id, $name, $category, $length, $rented)){
                echo "Bind failed: " .$stmt->errno." ".$stmt->error;
            }

            while($stmt->fetch()){
                echo "<tr>\n<td>\n".$id."\n<td>".$name."\n<td>".$category."\n<td>".$length."\n<td>";
                if($rented == '1' ){
                    $rented = 'checked out';
                } else {
                    $rented = 'available';
                }
                echo $rented;
                echo '<td><form action="./video.php"
                          method = "post">
                          <input type="submit" name="DeleteRow" value="delete">
                          <input type="hidden" name="DeleteRowID" value="'.$id.'">
                        </form>';
                echo '<td><form action="./video.php"
                          method = "post">
                          <input type="submit" name="CheckInOut" value="update">
                          <input type="hidden" name="CheckInOutID" value="'.$id.'">
                        </form>';
                echo "</tr>";
            }
            $stmt->close();
    echo "</table>
    </fieldset>";

?>
  </body>
</html>