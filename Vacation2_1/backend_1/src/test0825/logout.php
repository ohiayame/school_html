<?php
$_SESSION = [];

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600,
        $params['path'], $params['domain'],
        $params['secure'], $params['httpOnly']
    );
}

session_destroy();

header("Location: login.php");
exit;