<?php
session_start();

$_SESSION = [];

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), "", time() - 36000,
        $params["domain"], $params["httponly"], $params["path"], $params["secure"]
    );
}

session_destroy();

header("Location: login.php");
exit;

?>