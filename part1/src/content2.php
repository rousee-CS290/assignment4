<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();
function help_redirect($url)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true);
    }
}

function killsession(){
    $_SESSION = array();
    session_destroy();
    $path = explode('/', $_SERVER['PHP_SELF'], -1);
    $path = implode('/', $path);
    $path = "http://$_SERVER[HTTP_HOST]$path/login.php";
    help_redirect($path);
    die();
}

$hdr = '<!DOCTYPE html>
        <html lang = "en">
          <head>
            <meta charset="UTF-8">
            <title>content 1 PHP</title>
          </head>
          <body>';

//session stuff...
if(isset($_SESSION['active']) && $_SESSION['active']){
    echo "$hdr Hello $_SESSION[username], you have visited this page $_SESSION[c2visits] times.<br>";
    echo "Click <a href=".'"./content1.php">'."here</a> for content1.";
    $_SESSION['c2visits']++;
} else {
    killsession();
}
?>
  <form action="./content1.php"
      method = "post">
      <p><input type="submit" value="Logout" name="logout"></p>
    </form>
  </body>
</html>