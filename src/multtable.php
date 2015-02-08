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

$input_params = array("min-multiplicand", "max-multiplicand", "min-multiplier", "max-multiplier");
foreach ($input_params as $parm){
    if(isset($_GET[$parm])){
        if (ctype_digit($_GET[$parm])){
            echo "<br> YOU DID IT! <br>";
        } else {
            echo "$parm must be an integer >= 0";
        }
    } else {
        echo "missing parameter: $parm<br>";
    }
}


?>
  </body>
</html>