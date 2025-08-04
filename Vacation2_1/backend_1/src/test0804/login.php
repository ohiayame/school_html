<?php
session_start();
// session 유효면 welcome로 이동
if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h1>로그인</h1>
    <!-- error, success -->
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>".htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }else if (isset($_SESSION['success'])){
            echo "<p style='color:green'>".htmlspecialchars($_SESSION['success'])."</p>";
            unset($_SESSION['success']);
        }
    ?>

    <form action="login_p.php" method="post">
        <fieldset>
            <legend>로그인</legend>
            <label for="username">아이디:</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">비밀번호:</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="로그인">
        </fieldset>
    </form>
</body>
</html>