<?php
session_start();
require_once('./db_conf.php');

try{
    $id = (int)$_GET['id'];

    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $sql = "
        SELECT id, title, content, name FROM posts WHERE id = '$id'
    ";
    $result = $conn->query($sql);
    if(!$result){
        throw new Exception("게시글이 존재하디 않습니다.");
    } 
    $post = $result->fetch_assoc();

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수정하기</title>
</head>
<body>
    <h1>수정하기</h1>

    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }
    ?>

    <form action="edit_p.php?id=<?=$post['id']?>" method="post">
        <fieldset>
            <legend><?=$post['id']?> 게시글 수정</legend>
            <label for="title">제목: </label>
            <input type="text" name="title" value="<?=$post['title']?>">
            <br>
            <label for="name">이름: </label>
            <input type="text" name="name" value="<?=$post['name']?>" readonly>
            <br>
            <label for="content">내용: </label>
            <input type="content" name="content" value="<?=$post['content']?>">
            <br>

            <label for="password">비밀번호:</label>
            <input type="password" name="password" >
            <br>

            <input type="submit" value="등록">
        </fieldset>
    </form>
<a href="view.php?id=<?= $post['id'] ?>">돌아가기</a>
</body>
</html>