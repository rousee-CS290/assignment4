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
error_reporting(E_ALL);
ini_set('display_errors', 'On');
echo "This is PHP! <br>
We require four integer parameters passed via HTTP GET
<ul><li>min-multiplicand
    <li>max-multiplicand
    <li>min-multiplier
    <li>max-multiplier
</ul>";

//print all the keys and values if debug is on
if(isset($_GET['debug'])){
    foreach($_GET as $key => $value){
        echo "KEY $key, VALUE $value" . "<br>";
    }
}
//take an input and convert to an integer, if possible

if(isset($_GET['min-multiplicand'])){
    if (ctype_digit($_GET['min-multiplicand'])){
        echo "<br> YOU DID IT! <br>";
    } else {
        echo "min-multiplicand must be an integer";
    }
} else {
    echo "missing parameter: min-multiplicand<br>";
}

if(isset($_GET['max-multiplicand'])){
    echo "<br> YOU DID IT! <br>";
} else {
    echo "missing parameter: max-multiplicand<br>";
}

if(isset($_GET['min-multiplier'])){
    echo "<br> YOU DID IT! <br>";
} else {
    echo "missing parameter: min-multiplier<br>";
}

if(isset($_GET['max-multiplier'])){
    echo "<br> YOU DID IT! <br>";
} else {
    echo "missing parameter: max-multiplier<br>";
}


?>
  </body>
</html>