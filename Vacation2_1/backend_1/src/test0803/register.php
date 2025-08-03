<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    
    <!-- error -->
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>".htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }
    ?>

    <form action="register_p.php" method="post">
        <fieldset>
            <legend>정보 입력</legend>
            <label for="username">아이디:</label>
                <input type="text" id="username" name="username" required>
            <br>
            <label for="password">비밀번호:</label>
                <input type="password" id="password" name="password" required>
            <br>
            <label for="nicname">이름:</label>
                <input type="text" id="nicname" name="nicname" required>
            <br>
            <input type="submit" value="회원가입">
        </fieldset>
    </form>
</body>
</html>