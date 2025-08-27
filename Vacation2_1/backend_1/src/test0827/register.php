<?php
session_start();
require_once("./db_conf.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h1>회원가입</h1>

    <?php
        if(isset($_SESSION["error"])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION["error"]) . "</p>";
            unset($_SESSION["error"]);
        }
    ?>

    <form action="register_p.php" method="post">
        <fieldset>
            <legend>회원가입 폼</legend>
            <label for="user_id">아이디: </label>
            <input type="text" name="user_id" required>
            <br>
            학년:
            <select name="grade"> 
                <option value="1">1학년</option>
                <option value="2">2학년</option>
                <option value="3">3학년</option>
            </select>
            <br>

            <label for="email">이메일: </label>
            <input type="email" name="email" required>
            <br>

            <label for="password">비밀번호: </label>
            <input type="password" name="password" required>
            <br>

            <label for="name">이름: </label>
            <input type="text" name="name" required>
            <br>

            <input type="submit" value="회원가입">
        </fieldset>
    </form>

    <p><a href="login.php">로그인</a></p>
    
</body>
</html>