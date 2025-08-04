<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>

    <!-- error, success -->
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }else if(isset($_SESSION['success'])){
            echo "<p style='color:green'>". htmlspecialchars($_SESSION['success'])."</p>";
            unset($_SESSION['success']);
        }
    ?>

    <!-- input form -->
    <form action="login_p.php">
        <fieldset>
            <legend>Login Form</legend>

            <label for="username">아이디:</label>
            <input type="text" name="username" required >
            <br>
            <label for="password">비밀번호:</label>
            <input type="password" name="password" required >
            <br>

            <input type="submit" value="로그인">
        </fieldset>
    </form>
    
</body>
</html>