<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성</title>
</head>
<body>
    <h1>게시글 작성</h1>
    <hr>
    <!-- error -->
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
    ?>

    <form action="b_write_p.php" method="post">
        <label for="name">작성자 이름</label>
        <input type="text" name="name" id="name" required>
        <br>

        <label for="password">비밀번호</label>
        <input type="password" name="password" id="password" required>
        <br>

        <label for="title">제목</label>
        <input type="text" name="title" id="title" required>
        <br>

        <label for="content">내용</label>
        <input type="content" name="content" id="content" required>
        <br>

        <input type="submit" value="등록">
    </form>
</body>
</html>