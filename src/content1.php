<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
echo '<!DOCTYPE html>
        <html lang = "en">
          <head>
            <meta charset="UTF-8">
            <title>multtable PHP example</title>
            <link rel="stylesheet" href="style.css">
          </head>
          <body>';
//verify username 
if(isset($_POST['username']) && $_POST['username'] != null){
    if(session_status() == PHP_SESSION_ACTIVE){
        $_SESSION['username'] = $_POST['username'];
        if(!isset($_SESSION['c1visits'])){
            $_SESSION['c1visits'] = 0;
        }
        if(!isset($_SESSION['c2visits'])){
            $_SESSION['c2visits'] = 0;
        }
    }
    echo "Hello $_SESSION[username], you have visited this page $_SESSION[visits] times.<br>";
    echo "Click <a href=".'"./content1.php">'."here</a> for content1.";
    $_SESSION['c1visits']++;
} else {
    echo '<!DOCTYPE html>
        <html lang = "en">
          <head>
            <meta charset="UTF-8">
            <title>multtable PHP example</title>
            <link rel="stylesheet" href="style.css">
          </head>
          <body>';
    echo "A username must be entered. Click <a href=".'"./login.php">'."here</a> to return to login screen.";
}
//session stuff...
?>
  </body>
</html>