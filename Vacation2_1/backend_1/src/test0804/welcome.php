
<?php
session_start();

// session 없으면 로그인으로 이동 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
</head>
<body>
    <h1>Welcome to <?= htmlspecialchars($_SESSION['name'])?>!</h1>

    <a href="logout.php">로그아웃</a>
</body>
</html>