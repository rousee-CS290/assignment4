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
echo "This is a JSON! <br>";



//print all the keys and values if debug is on
$enc = json_encode($_GET);
echo "$enc";