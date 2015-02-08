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



//check request method
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (empty($_POST)){
      $_POST["parameters"] = null;
    } 
    $_POST["Type"] = "POST";
    $enc = json_encode($_POST);
} else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (empty($_GET)){
      $_GET["parameters"] = null;
    }
    $_GET["Type"] = "GET";
    $enc = json_encode($_GET);
}

echo "$enc";

?>