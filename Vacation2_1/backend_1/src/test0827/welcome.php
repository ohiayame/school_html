<?php
session_start();
if(!isset($_SESSION["user_id"])){
    $_SESSION["error"] = "로그아웃 상테";
    header("Location: Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>환영합니다! <?= $_SESSION["name"]?>님!</h1>
    <p><a href="./board/list.php">게시판</a></p>
    <br>
    <p><a href="logout.php">로그아웃</a></p>
</body>
</html>