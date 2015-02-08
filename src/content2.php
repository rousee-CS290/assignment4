<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
//verify username 
if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    echo '<!DOCTYPE html>
            <html lang = "en">
              <head>
                <meta charset="UTF-8">
                <title>multtable PHP example</title>
                <link rel="stylesheet" href="style.css">
              </head>
              <body>';
    echo "Hello $_SESSION[username], you have visited this page $_SESSION[visits] times.<br>";
    echo "Click <a href=".'"./content1.php">'."here</a> for content1.";
    $_SESSION['c2visits']++;
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