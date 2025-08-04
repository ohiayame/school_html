<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>
<body>
    <h1>회원가입</h1>

    <!-- 에러 -->
        <?php
            if(isset($_SESSION['error'])){
                echo "<p style='color:red'>". htmlspecialchars($_SESSION['error'])."</p>";
                unset($_SESSION['error']);
            }
        ?>

    <!-- input form -->
    <form action="register_p.php" method="post">
        <fieldset>
            <legend>회원가입</legend>

            <label for="username">아이디:</label>
            <input type="text" name="username" required >
            <br>
            <label for="password">비밀번호:</label>
            <input type="password" name="password" required >
            <br>
            <label for="name">이름:</label>
            <input type="text" name="name" required >
            <br>
            <input type="submit" value="등록">
        </fieldset>
    </form>
    
</body>
</html>