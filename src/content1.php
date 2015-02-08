<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <title>multtable PHP example</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

<?php
// turn on error reporting
foreach($_POST as $key => $value){
        echo "KEY $key, VALUE $value <br>";
}
?>
  </body>
</html>