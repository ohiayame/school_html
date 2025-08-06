<?php
session_start();

$_SESSION = [];

if(ini_get("session.use_cookies")){
    $param = session_get_cookie_params();
    setcookie(session_name(), '', time() -3600,
        $param['path'], $param['domain'],
        $param['secure'], $param['httponly']
    );
}

session_destroy();

header("Location: login.php");
exit;

?>