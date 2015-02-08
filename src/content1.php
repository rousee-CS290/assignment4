<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
echo '<!DOCTYPE html>
        <html lang = "en">
          <head>
            <meta charset="UTF-8">
            <title>content 1 PHP</title>
          </head>
          <body>';

//verify username 
if(isset($_POST['username']) && $_POST['username'] != null) {
    if(session_status() == PHP_SESSION_ACTIVE){
        $_SESSION['username'] = $_POST['username'];
        if(!isset($_SESSION['c1visits'])){
            $_SESSION['c1visits'] = 0;
        }
        if(!isset($_SESSION['c2visits'])){
            $_SESSION['c2visits'] = 0;
        }
        if(!isset($_SESSION['active'])){
            $_SESSION['active'] = True;
        }
    }

} elseif(isset($_POST['username']) && $_POST['username'] == null) {
    echo "A username must be entered. Click <a href=".'"./login.php">'."here</a> to return to login screen.";
    $_SESSION = array();
    session_destroy();
    die();
    
} elseif(isset($_POST['logout']) && $_POST['logout'] == "Logout"){
    echo "Logged Out. Click <a href=".'"./login.php">'."here</a> to return to login screen.";
    $_SESSION = array();
    session_destroy();
    die();
}
//session stuff...
if(isset($_SESSION['active']) && $_SESSION['active']) {
    echo "Hello $_SESSION[username], you have visited this page $_SESSION[c1visits] times.<br>";
    echo "Click <a href=".'"./content2.php">'."here</a> for content2.";
    $_SESSION['c1visits']++;
}
?>
    <form action="./content1.php"
      method = "post">
      <p><input type="submit" value="Logout" name="logout"></p>
    </form>
  </body>
</html>