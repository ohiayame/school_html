<?php
// 세션 초기화
$_SESSION = [];

// 세션의 쿠키 제거
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// 세션 종료
session_destroy();
// 로그인으로 이동
header("Location: login.php");
exit;

?>