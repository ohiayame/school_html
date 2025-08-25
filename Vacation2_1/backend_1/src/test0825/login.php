<?php
session_start();

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
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
        if(isset($_SESSION["error"])){
            echo "<p style='color:red'>".htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }
    ?>
    <form action="login_p.php">
        <fieldset>
            <legend>로그인 폼</legend>
            <label for="username">아이디: </label>
            <input type="text" name="username" required>
            <br>
            <label for="password">비밀번호: </label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="로그인">
        </fieldset>
    </form>
    <p><a href="register.php">회원가입</a></p>
</body>
</html>