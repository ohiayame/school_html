<?php
session_start();
require_once("./db_conf.php");

if(isset($_SESSION["user_id"])){
    header("Location: welcome.php");
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
    <?php
        if(isset($_SESSION["error"])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION["error"]) . "</p>";
            unset($_SESSION["error"]);
        }elseif(isset($_SESSION["success"])){
            echo "<p style='color:green'>". htmlspecialchars($_SESSION["success"]) . "</p>";
            unset($_SESSION["success"]);
        }
    ?>
    <form action="login_p.php" method="post">
        <fieldset>
            <legend>로그인 폼</legend>
            <label for="user_id">아이디: </label>
            <input type="text" name="user_id" required>
            <br>
            <label for="password">비밀번호: </label>
            <input type="password" name="password" required>

            <input type="submit" value="로그인">
        </fieldset>
    </form>

    <p><a href="register.php">회원가입</a></p>
</body>
</html>