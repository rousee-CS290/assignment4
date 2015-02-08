<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <title>multtable PHP</title>
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
        echo "KEY $key, VALUE $value <br>";
    }
}
//sanitize the inputs from the GET
//if all the inputs exist and are integers, fill the output array with them
//otherwise let the user know about their sucky input
$input_parms = array("min-multiplicand", "max-multiplicand", "min-multiplier", "max-multiplier");
$output_parms = array();
$errorIn_parms = False;
foreach ($input_parms as $parm){
    if(isset($_GET[$parm])){
        if (ctype_digit($_GET[$parm])){
            $output_parms[$parm] = intval($_GET[$parm]);
        } else {
            echo "$parm must be an integer >= 0<br>";
            $errorIn_parms = True;
        }
    } else {
        echo "missing parameter: $parm<br>";
        $errorIn_parms = True;
    }
}

//if data passed in correctly, act on it
if (!$errorIn_parms){
    echo "YOU DID IT!<br>";
    //check that min is <= max
    if ($output_parms['min-multiplicand'] > $output_parms['max-multiplicand']) {
        echo "minimum multiplicand is larger than maximum<br>";
        $errorIn_parms = True;
    }

    if ($output_parms['min-multiplier'] > $output_parms['max-multiplier']) {
        echo "minimum multiplier is larger than maximum<br>";
        $errorIn_parms = True;
    }
}

//if still no error, process table
//set the width and height
$tbl_height = $output_parms["max-multiplicand"] - $output_parms["min-multiplicand"] + 2;
$tbl_width = $output_parms["max-multiplier"] - $output_parms["min-multiplier"] + 2;

//build the table
if (!$errorIn_parms){
    echo "<table>
          <caption>Multiplication Table</caption>
          <tbody>";

    for ($row = 0; $row < $tbl_height; $row++){
        echo "<tr>";
        if ($row == 0){
            $row_val = " ";
        } else {
            $row_val = $output_parms["min-multiplicand"] + $row - 1;
        }
        for ($col = 0; $col < $tbl_width; $col++){
            $col_val = $output_parms["min-multiplier"] + $col - 1;
            if ($col == 0){
                echo "<th> $row_val";
            } else if ($row == 0) {
                echo "<th> $col_val";
            } else {
                echo "<th>".$row_val * $col_val;
            }
        }
    }
    echo "</table>";
}

?>
  </body>
</html>