<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
</head>
<body>
    <h1>환영합니다 <?= htmlspecialchars($_SESSION['name'])?>님!</h1>

    <ul>
        <li>사용자 ID: <?=htmlspecialchars($_SESSION['user_id'])?></li>
        <li>아이디: <?=htmlspecialchars($_SESSION['username'])?></li>
    </ul>

    <p><a href="../board/list.php">게시판</a></p>
    <p><a href="./logout.php">로그아웃</a></p>
</body>
</html>