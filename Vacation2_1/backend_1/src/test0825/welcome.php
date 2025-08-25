
<?php
session_start();

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
    <h1>환영합니다! <?= htmlspecialchars($_SESSION['name'])?>님!</h1>

    <a href="logout.php">로그아웃</a>
</body>
</html>