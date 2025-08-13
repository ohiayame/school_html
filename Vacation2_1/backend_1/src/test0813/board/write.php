<?php
session_start();

if(!isset($_SESSION['user_id'])){
    $_SESSION['error'] = '로그인 해주세요.';
    header("Location: list.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <h1>글쓰기</h1>
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }
    ?>
    <form action="write_p.php" method="post">
        <fieldset>
            <legend>게시글 작성</legend>
            <label for="title">제목: </label>
            <input type="text" name="title" required>
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