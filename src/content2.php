<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
function killsession(){
    $_SESSION = array();
    session_destroy();
    die();
}
echo '<!DOCTYPE html>
        <html lang = "en">
          <head>
            <meta charset="UTF-8">
            <title>content 2 PHP</title>
          </head>
          <body>';
//session stuff...
if(isset($_SESSION['username']) && $_SESSION['username'] != null){
    echo "Hello $_SESSION[username], you have visited this page $_SESSION[c2visits] times.<br>";
    echo "Click <a href=".'"./content1.php">'."here</a> for content1.";
    $_SESSION['c2visits']++;
} else {
    echo "A username must be entered. Click <a href=".'"./login.php">'."here</a> to return to login screen.";
    killsession();
}
?>
    <form action="./content1.php"
      method = "post">
      <p><input type="submit" value="Logout" name="logout"></p>
    </form>
  </body>
</html>