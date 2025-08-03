<?php
    // 세션에 아이디가 존재하는지 확인
    // 없으면 로그인으로 돌아가기
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>환영하니다. <?= $_SESSION['user_name'] ?>님!</h2>

    <a href="logout.php">Logout</a>
</body>
</html>