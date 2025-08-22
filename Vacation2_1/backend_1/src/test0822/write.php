<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글작성</title>
</head>
<body>
    <h1>글 작성</h1>

    <?php
    if(isset($_SESSION['error'])){
        echo "<p style='color:red'>". htmlspecialchars($_SESSION['error']) ."</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="write_p.php" method="post">
        <fieldset>
            <legend>게시글 작성</legend>
            <label for="title">제목: </label>
            <input type="text" name="title" required>
            <br>
            <label for="name">작성자: </label>
            <input type="text" name="name" required>
            <br>
            <label for="password">비밀번호: </label>
            <input type="password" name="password" required>
            <br>
            <label for="content">내용: </label>
            <textarea name="content" required></textarea>
            <br>

            <input type="submit" value="등록">
        </fieldset>
    </form>
    <p><a href="list.php">돌아가기</a></p>
</body>
</html>
