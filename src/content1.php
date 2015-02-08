<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <title>multtable PHP example</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

<?php
if($_POST['username'] != null){
    echo "Hello $_POST[username], you have visited this page # times.";
} else {
    echo "A username must be entered. Click <a href=".'"./login.php">'."here</a> to return to login screen.";
}
?>
  </body>
</html>