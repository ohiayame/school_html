<?php
// 세션 제거
$_SESSION = [];

// 쿠키 제거
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}
// 세션 종료
session_destroy();

header("Location: login.php");
exit;